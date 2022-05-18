<div class="panel panel-bd lobidrag">
    <div class="panel-heading">
        <div class="panel-title">
            <h6><?php echo display('slider') ?> </h6>
            <hr>
        </div>
    </div>
    <div class="panel-body">
        <form action="javascript:void(0)" method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <label for="slider_logo" class="col-sm-2">Slider Logo
                    <span class="text-danger f-s-10">( 285×120 ) Formats:(png,jpeg,jpeg)</span>
                </label>
                <div class="col-sm-9">
                    <!-- <input type="file" name="slider_logo" id="slider_logo" class=""
                        onchange="fileValueOne(this,'slider_logo')" /> -->
                <input type="file" name="slider_logo" id="slider_logo" class="custom-input-file" onchange="fileValueOne(this,'slider_logo')" />
                <label for="slider_logo">
                    <i class="fa fa-upload"></i>
                    <span class="slider-filename"><?php echo display('choose_file'). '...'; ?></span>
                </label>
                        
                    <input type="hidden" name="old_slider_logo" id="old_slider_logo" class=""
                        value="<?php if(!empty($get_sliderinfo->slider_logo)){ echo html_escape($get_sliderinfo->slider_logo); } ?>" />
                    <?php if (!empty($get_sliderinfo->slider_logo)) { ?>
                        <!-- img_border -->
                    <div class=" m-t-10">
                        <img src="<?php echo base_url(html_escape($get_sliderinfo->slider_logo)); ?>"
                            alt="" width="20%" id="image-preview-slider_logo">
                            
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- <div class="form-group row">
                <label for="" class="col-sm-2"></label>
                <div class="col-sm-9">
                    <img id="image-preview-slider_logo" src="" alt="" class="border border-2" width="200px">
                </div>
            </div> -->
            <div class="form-group row">
                <label for="title" class="col-sm-2"><?php echo display('title') ?> <i class="text-danger"> </i></label>
                <div class="col-sm-9">
                    <input name="title" class="form-control" type="text" placeholder="<?php echo display('title') ?>"
                        id="slider_title" value="<?php
                    if (!empty($get_sliderinfo->title)) {
                        echo html_escape($get_sliderinfo->title);
                    }
                    ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="subtitle" class="col-sm-2"><?php echo display('sub_title') ?> <i class="text-danger">
                    </i></label>
                <div class="col-sm-9">
                    <input name="subtitle" class="form-control" type="text"
                        placeholder="<?php echo display('sub_title') ?>" id="subtitle" value="<?php
                    if (!empty($get_sliderinfo->subtitle)) {
                        echo html_escape($get_sliderinfo->subtitle);
                    }
                    ?>">
                </div>
            </div>
            <!-- <div class="form-group row">
                <label for="tags" class="col-sm-2"><?php echo display('tags') ?> <i class="text-danger">  </i></label>
                <div class="col-sm-9">
                    <input name="tags" class="form-control" type="text" placeholder="<?php //echo display('tags') ?>" id="tags"  value="<?php
                    //if (!empty($get_sliderinfo->tags)) {
                       /// echo html_escape($get_sliderinfo->tags);
                    //}
                    ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-sm-2"><?php //echo display('description') ?> <i class="text-danger">  </i></label>
                <div class="col-sm-9">
                    <textarea name="description" class="form-control" placeholder="<?php //echo display('description') ?>" id="slider_description" rows="10" cols="80"><?php
                        //if (!empty($get_sliderinfo->description)) {
                          //  echo html_escape($get_sliderinfo->description);
                        //}
                        ?></textarea>
                </div>
            </div> -->
            <div class="form-group row">
                <label for="background_video_url" class="col-sm-2">Background Video <i class="text-danger"> </i></label>
                <div class="col-sm-9">
                    <!-- <input name="background_video_url" class="form-control" type="file" placeholder="Background Video"
                        id="background_video_url"> -->
                <input type="file" name="background_video_url" id="background_video_url" class="custom-input-file"/>
                <label for="background_video_url">
                    <i class="fa fa-upload"></i>
                    <span class="background-filename"><?php echo display('choose_file'). '...'; ?></span>
                </label>
                    <span class="text-danger">Formats:(MP4)</span>
                    <input name="old_background_video" class="form-control" type="hidden" id="old_background_video"
                        value="<?php 
                    if (!empty($get_sliderinfo->background_video_url)) {
                        echo html_escape($get_sliderinfo->background_video_url);
                    }?>">
                    <br>
                    <?php  if (!empty($get_sliderinfo->background_video_url)) { ?>
                    <video width="400" controls>
                        <source src="<?php echo base_url($get_sliderinfo->background_video_url); ?>" type="video/mp4">
                    </video>
                    <?php } ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="short_video_url" class="col-sm-2"><?php echo display('short_video_url') ?> <i
                        class="text-danger"> </i></label>
                <div class="col-sm-9">
                    <input name="short_video_url" class="form-control" type="text"
                        placeholder="<?php echo display('short_video_url') ?>" id="short_video_url" value="<?php
                    if (!empty($get_sliderinfo->short_video_url)) {
                        echo html_escape($get_sliderinfo->short_video_url);
                    }
                    ?>">
                </div>
            </div>
            <!--<div class="form-group row">
                <label for="slider_point_one" class="col-sm-2"><?php echo display('slider_point_one') ?> <i
                        class="text-danger"> </i></label>
                <div class="col-sm-9">
                    <input name="slider_point_one" class="form-control" type="text"
                        placeholder="<?php echo display('slider_point_one') ?>" id="slider_point_one" value="<?php
                    if (!empty($get_sliderinfo->slider_point_one)) {
                        echo html_escape($get_sliderinfo->slider_point_one);
                    }
                    ?>">
                </div>
            </div>
             <div class="form-group row">
                <label for="slider_point_two" class="col-sm-2"><?php echo display('slider_point_two') ?> <i
                        class="text-danger"> </i></label>
                <div class="col-sm-9">
                    <input name="slider_point_two" class="form-control" type="text"
                        placeholder="<?php echo display('slider_point_two') ?>" id="slider_point_two" value="<?php
                    if (!empty($get_sliderinfo->slider_point_two)) {
                        echo html_escape($get_sliderinfo->slider_point_two);
                    }
                    ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="slider_point_three" class="col-sm-2"><?php echo display('slider_point_three') ?> <i
                        class="text-danger"> </i></label>
                <div class="col-sm-9">
                    <input name="slider_point_three" class="form-control" type="text"
                        placeholder="<?php echo display('slider_point_three') ?>" id="slider_point_three" value="<?php
                    if (!empty($get_sliderinfo->slider_point_three)) {
                        echo html_escape($get_sliderinfo->slider_point_three);
                    }
                    ?>">
                </div>
            </div> -->
            <div class="form-group row">
                <label for="slider_pic" class="col-sm-2">Video <?php echo display('image') ?>
                    <span class="text-danger f-s-10">( 550×302 ) Formats:(png,jpeg,jpeg)</span>
                </label>
                <div class="col-sm-9">
                    <!-- <input type="file" name="slider_pic" id="slider_pic" class="" onchange="fileValueOne(this,'slider')" /> -->
                    <input type="file" name="slider_pic" id="slider_pic" class="custom-input-file" onchange="fileValueOne(this,'slider')"/>
                    <label for="slider_pic">
                        <i class="fa fa-upload"></i>
                        <span class="sliderpic-filename"><?php echo display('choose_file'). '...'; ?></span>
                    </label>
                        
                    <input type="hidden" name="old_image" id="old_image" class=""
                        value="<?php if(!empty($get_sliderinfo->picture)){ echo html_escape($get_sliderinfo->picture); } ?>" />
                    <?php if (!empty($get_sliderinfo->picture)) { ?>
                        <!-- img_border -->
                    <div class=" m-t-10">
                        <img src="<?php echo base_url(html_escape($get_sliderinfo->picture)); ?>"
                            alt="<?php echo html_escape($get_sliderinfo->title); ?>" width="20%" id="image-preview-slider">
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- <div class="form-group row">
                <label for="" class="col-sm-2"></label>
                <div class="col-sm-9">
                    <img id="image-preview-slider" src="" alt="" class="border border-2" width="200px">
                </div>
            </div> -->
            <div class="form-group row">
                <label for="subtitle_image" class="col-sm-2">Subtitle Image
                    <span class="text-danger f-s-10">( 1920×300 ) Formats:(png,jpeg,jpeg)</span>
                </label>
                <div class="col-sm-9">
                    <!-- <input type="file" name="subtitle_image" id="subtitle_image" class=""
                        onchange="fileValueOne(this,'subtitle_image')" /> -->
                        <input type="file" name="subtitle_image" id="subtitle_image" class="custom-input-file" onchange="fileValueOne(this,'subtitle_image')"/>
                    <label for="subtitle_image">
                        <i class="fa fa-upload"></i>
                        <span class="slidersubtitle-filename"><?php echo display('choose_file'). '...'; ?></span>
                    </label>
                        
                    <input type="hidden" name="old_subtitle_image" id="old_subtitle_image" class=""
                        value="<?php if(!empty($get_sliderinfo->subtitle_image)){ echo html_escape($get_sliderinfo->subtitle_image); } ?>" />
                    <?php if (!empty($get_sliderinfo->subtitle_image)) { ?>
                        <!-- img_border -->
                    <div class=" m-t-10">
                        <img src="<?php echo base_url(html_escape($get_sliderinfo->subtitle_image)); ?>"
                            alt="<?php echo html_escape($get_sliderinfo->title); ?>" width="20%" id="image-preview-subtitle_image">
                      
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- <div class="form-group row">
                <label for="" class="col-sm-2"></label>
                <div class="col-sm-9">
                    <img id="image-preview-subtitle_image" src="" alt="" class="border border-2" width="200px">
                </div>
            </div> -->

            <div class="offset-3 mb-3 group-end">
                <button type="button" onclick="slider_save()"
                    class="btn btn-info w-md m-b-5"><?php echo display('update') ?></button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    // all old preview image hide
  //   function fileValueOneCourse(value, sectionval) {

  //   var path = value.value;
  //   var extenstion = path.split('.').pop();
  //   if (extenstion == "jpg" || extenstion == "svg" || extenstion == "jpeg" || extenstion == "png" || extenstion ==
  //       "gif" || extenstion == "webp") {
  //       var img = '<img src="' + window.URL.createObjectURL(value.files[0]) + '" width="20%">'
  //       alert(img);
  //       var filename = path.replace(/^.*[\\\/]/, '').split('.').slice(0, -1).join('.');
  //       $("#img-preview-"+sectionval).html(img);

  //   } else {
  //       alert("File not supported. Kindly Upload the Image of below given extension ")
  //   }
  // }

  
$(document).ready(function() {
    $("body").on("change", "#slider_logo", function(e) {
        var filename = e.target.files[0].name;
        $(".slider-filename").text(filename);
    });

    $("body").on("change", "#background_video_url", function(e) {
        var filename = e.target.files[0].name;
        $(".background-filename").text(filename);
    });
    $("body").on("change", "#slider_pic", function(e) {
        var filename = e.target.files[0].name;
        $(".sliderpic-filename").text(filename);
    });
    $("body").on("change", "#subtitle_image", function(e) {
        var filename = e.target.files[0].name;
        $(".slidersubtitle-filename").text(filename);
    });
});
</script>