<?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
<input type="hidden" value="<?php echo $edit_data->subscription_id ?>" id="subscription_id">
<div class="form-group">
    <label for="name" class="col-md-3"><?php echo display('title') ?> <i class="text-danger"> *</i></label>
    <div class="col-md-12">
        <input name="title" class="form-control" type="text" placeholder="<?php echo display('title') ?>" id="edittitle"
            value="<?php echo html_escape($edit_data->title); ?>" required>
    </div>
</div>
<!-- <div class="form-group">
    <label for="start_date" class="col-md-3"><?php echo display('start_date') ?> <i class="text-danger"> *</i></label>
    <div class="col-md-12">
        <input name="start_date" class="form-control start_datas" type="text" id="editstart_datas" placeholder="<?php echo display('start_date') ?>" value="<?php echo (!empty(html_escape($edit_data->start_time)) ? html_escape($edit_data->start_time) : date('Y-m-d')); ?>" required>
    </div>
</div>
<div class="form-group">
    <label for="end_date" class="col-md-3"><?php echo display('end_date') ?> <i class="text-danger"> *</i></label>
    <div class="col-md-12">
        <input name="end_date" class="form-control end_dates" type="text" placeholder="<?php echo display('end_date') ?>" id="editend_dates" value="<?php echo (!empty(html_escape($edit_data->end_time)) ? html_escape($edit_data->end_time) : date('Y-m-d')); ?>" required>
    </div>
</div> -->

<div class="form-group">
    <label for="duration_id" class="col-md-3"><?php echo display('duration') ?><i class="text-danger"> *</i></label>
    <div class="col-md-12">
        <select name="duration" class="form-control placeholder-single" id="editduration"
            data-placeholder="<?php echo display('select_one'); ?>">
            <option value="1" <?php if ($edit_data->duration == 1) {
                                    echo "selected";
                                } ?>>Monthly</option>
            <option value="2" <?php if ($edit_data->duration == 2) {
                                    echo "selected";
                                } ?>>Yearly</option>
            <option value="3" <?php echo (($edit_data->duration == 3) ? 'selected' : ''); ?>>Free</option>
            <option value="4" <?php echo (($edit_data->duration == 4) ? 'selected' : ''); ?>>Enterprise Package</option>
        </select>

    </div>
</div>
<!-- <div class="form-group">
    <label for="" class="col-md-3">Course Select<i class="text-danger"> *</i></label>
    <div class="col-md-12">
        <select name="course_id[]"  id="edit_course_id" class="form-control placeholder-single"  data-placeholder="<?php echo display('select_one'); ?>" multiple>
            <?php if($course){
                foreach($course as $subscription){
                    $subscription_course =$this->db->select('*')->from('subscription_course_tbl')->where('subscription_id',$edit_data->subscription_id)->where('course_id',$subscription->course_id)->where('status',1)->get()->row();
            ?>
            <option value="<?php echo $subscription->course_id;?>" <?php if(trim($subscription->course_id) ==(!empty($subscription_course->course_id)?trim($subscription_course->course_id):null)){ echo 'selected';}?>><?php echo $subscription->name;?></option>
            <?php }}?>
        </select>

    </div>
</div> -->
<!-- <?php if($edit_data->is_free==1){?>
<div class="form-group">
<div class="col-md-12">
    <input id="is_frees" name="is_free" type="checkbox" value="<?php echo $edit_data->is_free;?>"  <?php if($edit_data->is_free==1){ echo "checked";}?>>
    <label for="is_frees"><?php echo display('free'); ?></label>
</div>
</div>
<?php }else{?>
    <div class="form-group">
    <div class="col-md-12">
    <input id="is_frees" name="is_free" type="checkbox" value="0">
    <label for="is_frees"><?php echo display('free'); ?></label>
   </div>
</div>  
<?php }?>

<?php if($edit_data->is_free==0){?>
<div class="form-group" id="pricehide">
    <label for="price" class="col-md-3"><?php echo display('price') ?> <i class="text-danger"> *</i></label>
    <div class="col-md-12">
        <input name="price" class="form-control" type="number" placeholder="<?php echo display('price') ?>" id="prices" value="<?php echo $edit_data->price; ?>">
    </div>
</div>
<?php }?> -->
<div class="form-group" id="pricehide">
    <label for="price" class="col-md-3"><?php echo display('price') ?> <i class="text-danger"> *</i></label>
    <div class="col-md-12">
        <input name="price" class="form-control" type="number" placeholder="<?php echo display('price') ?>" id="prices"
            value="<?php echo $edit_data->price; ?>">
    </div>
</div>

<div class="form-group" id="freesubscriptions">
    <label for="price" class="col-md-3"><?php echo display('price') ?> <i class="text-danger"> *</i></label>
    <div class="col-md-12">
        <input name="pricesa" class="form-control" type="number" placeholder="<?php echo display('price') ?>"
            id="prices" value="">
    </div>
</div>
<div class="form-group" id="freesubscription">
    <label for="end_date" class="col-md-3"><?php echo display('oldprice') ?></label>
    <div class="col-md-12">
        <input name="oldprices" class="form-control" type="number" placeholder="<?php echo display('oldprice') ?>"
            id="oldprices" value="<?php echo $edit_data->oldprice; ?>">
    </div>
</div>
<div class="form-group">
    <label for="content" class="col-md-3"><?php echo 'Content' ?></label>
    <div class="col-md-12">
        <div id="subscription_contents">
            <?php
        $r = 0;
        $course_sub_content = json_decode($edit_data->course_sub_content);
        foreach ($course_sub_content as $course_sub_contents) {
        
     ?>
            <div class="d-flex">
                <div class="flex-grow-1">
                    <div class="form-group">
                        <input type="text" class="form-control" name="course_sub_content[]"
                            id="course_sub_contents_<?php echo $r; ?>" placeholder=""
                            value="<?php echo html_escape($course_sub_contents); ?>">
                    </div>
                </div>
                <div class="col-sm-1">
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm custom_btn m-t-0"
                        onclick="removeContent(this)"><i class='fa fa-minus'></i> </a>
                </div>
            </div>
            <?php $r++;}?>

        </div>
        <a href="javascript:void(0)" class="btn btn-success text-white btn-sm custom_btn float-right"
            onclick="appendContentedit()"><i class="fa fa-plus"></i> </a><br>


    </div>
</div>
<div class="form-group">
    <label for="description" class="col-md-3"><?php echo display('description') ?></label>
    <div class="col-md-12">
        <textarea name="description" class="form-control" cols="5" rows="5" type="text"
            placeholder="<?php echo display('description') ?>" id="editdescription"
            required><?php echo html_escape($edit_data->description); ?></textarea>
    </div>
</div>
<div class="form-group text-right">
    <button type="button" onclick="subscription_update()"
        class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
</div>
<?php echo form_close(); ?>

<script>
$("#freesubscriptions").hide();
$("body").on("click", "#is_frees", function() {
    if ($("#is_frees").is(":checked")) {
        $("#is_frees").attr("value", "1");
        $('#freesubscriptions').hide();
        $('#pricehide').hide();
        $('#prices').val('');
    } else {
        $("#is_frees").attr("value", "0");
        $('#prices').val('');
        $('#freesubscriptions').show();
        $('#pricehide').hide();
    }
});
</script>