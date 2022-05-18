<?php echo form_open_multipart(enterpriseinfo()->shortname .'/about-service-save', 'class="myform" id="myform"'); ?>
<div class="form-group row">
    <label for="service_title" class="col-sm-2 col-form-label">Title
        <i class="text-danger">
            * </i></label>
    <div class="col-sm-9">
        <input name="service_title" class="form-control" placeholder="Title" rows="10" id="service_title"
            value="<?php echo (!empty($aboutservice_edit->service_title) ? $aboutservice_edit->service_title : ''); ?>"
            required>
    </div>
</div>
<?php 
    $subtitles = json_decode(@$aboutservice_edit->service_subtitle);
    ?>
<div class="form-group row m-r">
    <label class="col-sm-2 col-form-label" for="edit_subtitle">Subtitle</label>
    <div class="col-sm-8">
        <?php 
                                                                if($subtitles){
                                                                    foreach($subtitles as $sub){
                                                                ?>
        <div id="">
            <div class="d-flex mt-2">
                <div class="flex-grow-1 pr-3">
                    <div class="form-group">
                        <input type="text" class="form-control" name="edit_subtitle[]" id="edit_subtitle"
                            value="<?php echo (!empty($sub) ? $sub : ''); ?>" placeholder="<?php echo "Subtitle"; ?>">
                    </div>
                </div>
                <div class="col-sm-1">
                    <button type='button' class='btn btn-danger btn-sm custom_btn m-t-0' name='button'
                        onclick='removeService(this)'>
                        <i class='fa fa-minus'></i> </button>
                </div>
            </div>
        </div>
        <?php 
                                                                } 
                                                                }
                                                                ?>
        <div id="editservice_area"></div>
    </div>
    <div class="col-sm-1">
        <a href="javascript:void(0)" class="btn btn-success text-white btn-sm custom_btn mt-2"
            onclick="appendEditService()"><i class="fa fa-plus"></i>
        </a>
    </div>
</div>

<div class="form-group row">
    <label for="service_logo" class="col-sm-2 col-form-label">Logo <i class="text-danger"> </i></label>
    <div class="col-sm-6">
        <input type="file" name="service_logo" class="form-control" id="service_logo"
            onchange="fileValueOne(this,'editservice_logo')">
        <input type="hidden" id="old_service_logo" name="old_service_logo"
            value="<?php echo @$aboutservice_edit->service_logo; ?>">
        <span class="text-danger mt-5">File size 165*165 </span>
    </div>
    <div class="col-sm-2">
        <img id="image-preview-editservice_logo" src="<?php echo base_url(@$aboutservice_edit->service_logo); ?>" alt=""
            class="border border-2" width="165px">
    </div>
</div>

<div class="offset-2 mb-3 group-end">
<input type="hidden" name="about_id" id="about_id" value="<?php echo (!empty($aboutservice_edit->about_id) ? $aboutservice_edit->about_id : ''); ?>">
    <input type="hidden" name="id" id="about_id"
        value="<?php echo (!empty($aboutservice_edit->id) ? $aboutservice_edit->id : ''); ?>">
    <button type="submit" class="btn btn-info w-md m-b-5" onclick="">Update</button>
</div>
<?php echo form_close(); ?>