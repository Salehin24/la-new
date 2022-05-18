<link
    href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css'); ?>"
    rel="stylesheet">
<link
    href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/css/new.css'); ?>"
    rel="stylesheet">
<style>
.bootstrap-tagsinput .tag {
    background: #07477d;
    padding: 0 5px 0 10px;
    border-radius: 4px;
    line-height: 30px;
    display: inline-block;
}

.bootstrap-tagsinput {
    width: 100%;
}

.project-previewimg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: block;
}
</style>

<div class="bg-alice-blue py-3">
    <div class="container-lg custom-content">        
        
        <?php echo form_open_multipart($enterprise_shortname .'/instructor-project-submit', 'class="row g-3" id="myform"'); ?>
        <div class="row">
            <div class="col-md-12">

                <div class="mt-3 mb-3">
                    <?php
                $error = $this->session->flashdata('error');
                $success = $this->session->flashdata('success');
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

                <!--Start card-->
                <div class="card border-0 rounded-0 shadow-sm mb-5">
                    <div class="card-body p-4 p-xl-5">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-5 position-relative">

                                    <div class="project-previewimg" id="img-preview-thumnailImage"></div>
                                    <div class="bg-alice-blue text-center zone bordered-zone">
                                        <div id="dropZ3" class="py-3">
                                            <i class="fas fa-cloud-upload-alt mt-4 mb-3"></i>
                                            <div class="fs-11 fw-bold lh-15 text-capitalize font-open text-black">Upload
                                                <br> project thumbnail image
                                            </div>
                                            <div class="rec_text mt-2 text-black font-open">Recommended: <br> 280*192,
                                                JPG, JPEG,PNG, SVG</div>
                                            <div class="selectFile">
                                                <label for="coverpic">Select file</label>
                                                <input type="file" name="coverpic" id="coverpic"
                                                    onchange="fileValueOneCourse(this,'thumnailImage')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 ps-xl-5">
                                <div class="form_inner pro_add_form">
                                    <div class="mb-3">
                                        <div class="title-label mb-2 font-open">Project Date <span>(Completed on or
                                                Published on)</span></div>
                                        <div class="d-block d-md-flex align-items-center">
                                            <input type="date" class="date-box input-box mb-3 mb-md-0 me-4 px-2"
                                                id="publishdate" name="publishdate" required>
                                            <!-- <button type="button" class="btn btn-del">Delete</button> -->
                                            <div class="sticky">

                                                <input type="submit" class="btn btn-draft " name="projectsave"  value="Save Draft"  id="savedraf">
                                                <input type="submit" class="btn btn-publish"  name="projectpublish" value="Publish" id="savepublish">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="title-label mb-2 font-open">Project / Assignment Title <span>(Write
                                                the title of this project)</span></div>
                                        <div class="d-flex align-items-center">
                                            <input type="text" class="input-box" name="title" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="title-label mb-2 font-open">Project Category <span>(Select the
                                                category of this project)</span></div>
                                        <div class="d-flex align-items-center">
                                            <select class="input-box px-2" aria-label="Default select example"
                                                id="projectType" name="projecttype"
                                                onchange="projecttypecourseareaload(this.value)" required>
                                                <option value="">-- select one --</option>
                                                <option value="1">Course Project</option>
                                                <option value="4">Client Project</option>
                                                <option value="2">Personal Project</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="title-label mb-2 font-open">Areas & Skills <span>(Add areas & skills
                                                you used in this project)</span></div>
                                        <div class="d-flex align-items-center">
                                            <input type="text" class="input-box" name="skills" id="skills"
                                                data-role="tagsinput">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="title-label mb-2 font-open">Softwares / Tools Used <span>(Add
                                                Softwares or tools you used in this project)</span></div>
                                        <div class="d-flex align-items-center">
                                            <input type="text" class="input-box" name="software_used" id="software_used"
                                                data-role="tagsinput">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="title-label mb-2 font-open">Tags <span>(Add tags that clearify the
                                                Project subject matter)</span></div>
                                        <div class="d-flex align-items-center">
                                            <input type="text" class="input-box" name="tags" id="tags"
                                                data-role="tagsinput">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg_blue_pro p-4 p-xl-5 course-project-area">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="bg-alice-blue text-center zone bordered-zone mb-3 p-4">
                                    <div class="loadcoursethumbnail">
                                        <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/img-icon.png'); ?>"
                                            class="img-fluid">
                                    </div>
                                    <div class="mt-1 title-thumba">Course Thumbnail</div>
                                </div>
                                <!-- <input type="submit" class="btn btn-subcourse font-open w-100" name="projectsubmit"
                                    value="Submit Course Project for Instructor Review"> -->
                            </div>
                            <div class="col-lg-8 ps-xl-5">
                                <div class="mt-4 mt-lg-0 pro_add_form">
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center">
                                            <select class="input-box px-2 courseTypeselect"
                                                aria-label="Default select example" id="course_id" name="course_id"
                                                onchange="get_sectionbycourse(this.value)">
                                                <option value=''>Select Course name</option>
                                                <?php foreach($get_courses as $course){ ?>
                                                <option value="<?php echo $course->course_id; ?>">
                                                    <?php echo $course->name; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center">
                                            <select class="input-box px-2 courseTypeselect" onchange="projecttypechange(this.value)"
                                                aria-label="Default select example" id="CourseType" name="coursetype">
                                                <option selected>Select Project Type</option>
                                                <option value="1">Chapter Project</option>
                                                <option value="2">Final Project</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 chapter-div">
                                        <div class="d-flex align-items-center">
                                            <select class="input-box px-2" aria-label="Default select example"
                                                id="section_id" name="section_id">
                                                <option value="">Select Chapter</option>
                                                
                                                <?php foreach(@$get_sectionbycourse as $section){ ?>
                                                <option value="<?php echo $section->section_id; ?>">
                                                    <?php echo $section->section_name; ?>
                                                </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg_blue_pro p-4 p-xl-5 client-project-area">
                        <div class="pro_add_form">
                            <div class="mb-3">
                                <div class="d-flex align-items-center">
                                    <input type="text" class="input-box px-3 place_black" placeholder="Client Name"
                                        name="client_name">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex align-items-center">
                                    <input type="text" class="input-box px-3 place_black" placeholder="Project Year"
                                        name="clientproject_year">
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-center">
                                    <input type="text" class="input-box px-3 place_black"
                                        placeholder="Client Website Url" name="clientwebsite_url">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg_blue_pro p-4 p-xl-5 personal-project-area">
                        <div class="pro_add_form">
                            <div class="mb-3">
                                <div class="d-flex align-items-center">
                                    <input type="text" class="input-box px-3 place_black"
                                        placeholder="Project Subject/topic" name="project_topic">
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex align-items-center">
                                    <input type="text" class="input-box px-3 place_black" placeholder="Project Year"
                                        name="personal_projectyear">
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-center">
                                    <input type="text" class="input-box px-3 place_black"
                                        placeholder="Personal Website Url" name="personal_websiteurl">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4 p-xl-5">
                        <div class="pa_title font_open mb-3">Add Project / Assignment Content</div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-text" role="tabpanel"
                                aria-labelledby="pills-text-tab">
                                <!--<div class="card border-0 rounded-0" id="text_editor_div0">
                                    <<div class="card-body px-0">
                                        <div class="text-end">
                                            <button type="button" class="btn btn-transparent border py-2 mb-3"
                                                onclick="remove_editor(0)">
                                                <i data-feather="trash-2"></i>
                                            </button>
                                        </div>
                                        <textarea id="editor" name="content[]"></textarea>
                                        <input type="text" name="content_sl[]" value="1">
                                    </div> 
                                </div>-->
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="d-block d-md-flex align-items-center">
                                <button type="button" id="pills-text-tab"
                                    class="btn btn-publish my-1 ms-0">Text</button>
                                <button type="button" class="btn btn-publish my-1"
                                    onclick="image_content_add()">Image</button>
                                <button type="button" class="btn btn-publish my-1"
                                    onclick="video_content()">Video</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js'); ?>">
</script>

<script>
$(document).ready(function() {

    $(".course-project-area").hide();
    $(".client-project-area").hide();
    $(".personal-project-area").hide();

    //    ============ its for is visibilityOnPort value add ============
    // $("body").on("click", "#visibilityOnPort", function() {
    //     if ($("#visibilityOnPort").is(":checked")) {
    //         $("#visibilityOnPort").attr("value", "1");
    //     } else {
    //         $("#visibilityOnPort").attr("value", "0");
    //     }
    // });
    // //    ============ its for is getFeatured value add ============
    // $("body").on("click", "#getfeatured", function() {
    //     if ($("#getfeatured").is(":checked")) {
    //         $("#getfeatured").attr("value", "1");
    //     } else {
    //         $("#getfeatured").attr("value", "0");
    //     }
    // });

    $(document).on("keypress", "input,select,select2", function(e) {
        if (e.which == 13) {
            e.preventDefault();
        }
    });
    //Editor
    // ClassicEditor
    //     .create(document.querySelector('#editor'))
    //     .catch(error => {
    //         console.error(error);
    //     });


});

var click_count = 1;
var click_image = click_count + 1;
var video_link_count = click_image + click_count + 1;
var file_link_count = video_link_count + click_image + click_count + 1;
var content_sl = 2;
let theEditor;
$('#pills-text-tab').on('click', function() {
    var html = '<div class="card border-0 rounded-0" id="text_editor_div' + click_count + '">\n\
                    <div class="card-body px-0">\n\
                        <div class="d-flex justify-content-between">\n\
                                <div class="d-block w-100">\n\
                                    <textarea id="editor_' + click_count +
        '" name="content[]" class="editor"></textarea><input type="hidden" name="content_sl[]" value="' + content_sl + '">\n\
                                    <input type="hidden" name="content_sl[]" value="' + content_sl +
        '">\n\
                                </div>\n\
                            <div class="ms-4 text-end">\n\
                                <button type="button" class="btn btn-transparent border py-2 mb-3" onclick="remove_editor(' + click_count + ')">\n\
                                    <i class="fas fa-trash-alt"></i>\n\
                                </button>\n\
                            </div>\n\
                        </div>\n\
                    </div>\n\
                </div>';

    $('#pills-text').append(html);
    
    ClassicEditor
        .create(document.querySelector('#editor_' + click_count), {
            toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList'],
        })
        .then(editor => {
            theEditor = editor;
           
        })
        .catch(error => {
            console.error(error);
        });
    $()
    

    click_count = click_image + click_count + 1;
    content_sl += 1;
});




var base_url = $("#base_url").val();
var enterprise_shortname = $("#enterprise_shortname").val();
var CSRF_TOKEN = $('#CSRF_TOKEN').val();
var enterprise_id = $("#enterprise_id").val();


function remove_editor(sl) {
    var div = document.getElementById("text_editor_div" + sl);
    div.parentNode.removeChild(div);
}


function image_content_add() {
    var previewImage = "'previewImage_" + content_sl + "'";
    var showpreviewImage = "previewImage_" + content_sl + "";

    var image_content = '<div class="card border-0 rounded-0" id="image_content' + click_image + '">\n\
                            <div class="card-body px-0">\n\
                                <div class="d-flex justify-content-between">\n\
                                <div id="img-preview-' + showpreviewImage + '"></div>\n\
                                    <div class="imgarea-' + showpreviewImage + ' d-block w-100">\n\
                                        <div class="zone text-center">\n\
                                            <div id="dropZ2"><i class="fas fa-cloud-upload-alt mt-4 mb-3"></i>\n\
                                                <div>Select or drop an image</div>\n\
                                                <div class="selectFile">\n\
                                                    <label for="content_img">Select file</label>\n\
                                                    <input type="file" name="content_img[]" id="content_img_'+content_sl+'" onchange="fileValueOneCourse(this,' + previewImage + ')">\n\
                                                </div>\n\
                                                <p class="text-danger">File size : 1050*656</p><input type="hidden" name="contentimg_sl[]" value="' + content_sl + '">\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="ms-4 text-end">\n\
                                        <button type="button" class="btn btn-danger btn-transparent border py-2 mb-3" onclick="remove_image(' +click_image +')">\n\
                                            <i class="fas fa-trash-alt"></i>\n\
                                        </button>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                        </div>';

    $('#pills-text').append(image_content);


    click_image = click_image + click_count + 1;
    content_sl += 1;
    $("#pills-image-tab").addClass("active");
    $("#pills-text-tab").removeClass("active");
    $("#pills-video-tab").removeClass("active");
    $("#pills-file-tab").removeClass("active");

}

function fileValueOneCourse(value, sectionval) {
    // all old preview image hide
    var path = value.value;
    var extenstion = path.split('.').pop();
    if (extenstion == "jpg" || extenstion == "svg" || extenstion == "jpeg" || extenstion == "png" || extenstion ==
        "gif" || extenstion == "webp") {
            $(".imgarea-"+sectionval).addClass("d-none");
            $("#img-preview-"+sectionval).addClass("w-100");
        //   document.getElementById('image-preview-'+sectionval).src = window.URL.createObjectURL(value.files[0]);
        var img = '<img src="' + window.URL.createObjectURL(value.files[0]) + '" width="100%" class="h-100">'
        var filename = path.replace(/^.*[\\\/]/, '').split('.').slice(0, -1).join('.');
        $("#img-preview-" + sectionval).html(img);
        // document.getElementById("filename").innerHTML = filename;
    } else {
        alert("File not supported. Kindly Upload the Image of below given extension ")
    }
}

function video_content() {
    var video_content = '<div class="card border-0 rounded-0" id="video_link' + video_link_count + '">\n\
                            <div class="card-body px-0">\n\
                                <div class="d-flex justify-content-between">\n\
                                    <div class="d-block w-100">\n\
                                        <div class="mb-3">\n\
                                            <label for="content_video" class="form-label mb-1 fw-medium">Embed Video(Vimeo, YouTube)*</label>\n\
                                            <input type="text" class="form-control form-control-lg" id="content_video_'+video_link_count+'" name="content_video[]" value="" onkeyup="getVideoIframeload(this.value,' +  content_sl + ')">\n\
                                            <p class="mt-2 text-muted mb-0 d-flex align-items-center">\n\
                                                <span>Embed files from vimeo, YouTube, </span>\n\
                                            </p>\n\
                                            <input type="hidden" name="contentvideo_sl[]" value="' + content_sl + '">\n\
                                            <div class="videoload_' + content_sl +        '"></div>\n\
                                        </div>\n\
                                    </div>\n\
                                    <div class="ms-4 mt-4 text-end">\n\
                                        <button type="button" class="btn btn-danger btn-transparent border py-2 mb-3" onclick="remove_link_content(' + video_link_count + ')">\n\
                                            <i class="fas fa-trash-alt"></i>\n\
                                        </button>\n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                        </div>';
    $('#pills-text').append(video_content);

    video_link_count++;
    content_sl += 1;
    $("#pills-video-tab").addClass("active");
    $("#pills-text-tab").removeClass("active");
    $("#pills-image-tab").removeClass("active");
    $("#pills-file-tab").removeClass("active");
};

function getVideoIframeload(link, sl) {
    
$.ajax({
    url: base_url + enterprise_shortname + "/getvideoiframe-load",
    type: "post",
    data: {
        csrf_test_name: CSRF_TOKEN,
        link: link
    },
    success: function(data) {
       if(data==1){
           toastr.error('Please Enter Valid Url');
       }else{

        $(".videoload_" + sl).html(data);
       }
    },
});

// $(".videoload_").html('<iframe width="560" height="315" src="https://www.youtube.com/embed/ZByhs9mDtDg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
}
// function file_content() {
//     var file_content = '<div class="card border-0 rounded-0" id="file_link' + file_link_count +
//         '"><div class="card-body px-0"><div class="text-end"><button type="button" class="btn btn-transparent border py-2 mb-3" onclick="remove_filelink_content(' +
//         file_link_count +
//         ')"><i class="fas fa-trash-alt"></i></button></div><div class="mb-3"> <label for="content_file" class="form-label mb-1 fw-medium">File Download Link *</label><input type="text" class="form-control form-control-lg" id="content_file" name="content_file[]" value=""><p class="mt-2 text-muted mb-0 d-flex align-items-center"><i data-feather="info" class="me-2 width-20"></i><span>File download link of your zip, rar, pdf, docx, ppt,xlsx, html, ai, psd, id, js, php,css, tiff, png, exe etc.</span></p></div></div></div>';
//     $('#pills-text').append(file_content);

//     file_link_count++;
//     $("#pills-file-tab").addClass("active");
//     $("#pills-text-tab").removeClass("active");
//     $("#pills-image-tab").removeClass("active");
//     $("#pills-video-tab").removeClass("active");
// }

function remove_image(sl) {
    var div = document.getElementById("image_content" + sl);
    div.parentNode.removeChild(div);
}

function remove_link_content(sl) {
    var div = document.getElementById("video_link" + sl);
    div.parentNode.removeChild(div);
}

function remove_filelink_content(sl) {
    var div = document.getElementById("file_link" + sl);
    div.parentNode.removeChild(div);
}


// "use strict";
// function get_publicnotpublicstatus(status) {
//     if (status == 0) {
//         $('#projectpublish').prop('disabled', true);
//         $('#projectsave').prop('disabled', false);
//     } else if (status == 1) {
//         $('#projectsave').prop('disabled', true);
//         $('#projectpublish').prop('disabled', false);
//     }
// }

// ("use strict");
// function get_sectionbycourse(course_id) {
//     $.ajax({
//         url: base_url + enterprise_shortname + "/get-sectionbycourse",
//         type: "POST",
//         data: {
//             csrf_test_name: CSRF_TOKEN,
//             course_id: course_id,
//             enterprise_id: enterprise_id,
//         },
//         success: function(r) {
//             $("#section_id").html(r);
//         },
//     });
// }

("use strict");
function get_sectionbycourse(course_id) {
  var enterprise_id = $("#enterprise_id").val();

  $.ajax({
    url: base_url + enterprise_shortname + "/get-sectionbycourse",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      course_id: course_id,
      enterprise_id: enterprise_id,
    },
    success: function (r) {
      $("#section_id").html(r);
      get_coursepicture(course_id);
    }
  });
}

function get_coursepicture(course_id){
  $.ajax({
    url: base_url + enterprise_shortname + "/get-coursepicture",
    type: "POST",
    data: {
      csrf_test_name: CSRF_TOKEN,
      course_id: course_id,
      enterprise_id: enterprise_id,
    },
    success: function (r) {
      console.log(r);
      $(".loadcoursethumbnail").html(r);
    }
  });
}

("use strict");

function get_lessonbycoursesection(section_id) {
    var enterprise_shortname = $("#enterprise_shortname").val();
    var enterprise_id = $("#enterprise_id").val();
    var course_id = $("#course_id").val();

    $.ajax({
        url: base_url + enterprise_shortname + "/get-lessonbycoursesection",
        type: "POST",
        data: {
            csrf_test_name: CSRF_TOKEN,
            course_id: course_id,
            section_id: section_id,
            enterprise_id: enterprise_id,
        },
        success: function(r) {
            $("#lesson_id").html(r);
        },
    });
}

$("#coursearea").hide();
// "use strict";

function projecttypecourseareaload(type) {
    if (type == 1) {
        $(".course-project-area").show();
        $(".client-project-area").hide();
        $(".personal-project-area").hide();
    } else if (type == 4) {
        $(".client-project-area").show();
        $(".course-project-area").hide();
        $(".personal-project-area").hide();
    } else if (type == 2) {
        $(".personal-project-area").show();
        $(".course-project-area").hide();
        $(".client-project-area").hide();
    }
}

$(window).scroll(function(e){ 
  var $el = $('.sticky'); 
  var isPositionFixed = ($el.css('position') == 'fixed');
  if ($(this).scrollTop() > 300 && !isPositionFixed){ 
    $el.css({'position': 'fixed', 'top': '90px','z-index':'1','right':'112px'}); 
  }
  if ($(this).scrollTop() < 300 && isPositionFixed){
    $el.css({'position': 'static', 'top': '0px'}); 
  } 
});


// =========== its for project type =============
function projecttypechange(type){

    if(type == 2){
        $(".chapter-div").hide();
    }else{
        $(".chapter-div").show();
    }
}

$("#savedraf").on('click',function(){

    var error=0;
    var totaleditor=document.getElementsByName("content[]").length;
    var dfile= document.getElementsByName("content[]");
    var error = 0;
    var id_num = 0;
    for (var index = 0; index < dfile.length; index++) {
        var qid = dfile[index].getAttribute("id");
        
        var hash=qid;
        var ids = hash.split('_');
        var id_num = ids[1];
        var test = $("#text_editor_div"+id_num+" div.ck-content").html();
        if(test == '<p><br data-cke-filler="true"></p>'){
            toastr.error('Your text box is empty !');
            $("#text_editor_div"+id_num+" div.ck-content").focus();
            error += 1;
        }
    }
    var totalefile=document.getElementsByName("content_img[]");
     for(var findex = 0; findex < totalefile.length; findex++){
        var imgid = totalefile[findex].getAttribute("id");
        var img= $('#'+imgid)[0].files[0];
         if($('#'+imgid)[0].files.length ==""){
            toastr.error('Your image is empty !');
         }
     }
     var totalvideo=document.getElementsByName("content_video[]");
     for(var vindex = 0; vindex < totalvideo.length; vindex++){
        var vid = totalvideo[vindex].getAttribute("id");
         var vdata=  $("#"+vid).val();
         //   console.log(vdata);
         if( vdata ==""){
            toastr.error('Your video is empty !');
         }
     }
});
$("#savepublish").on('click',function(){
    
    var error=0;
    var totaleditor=document.getElementsByName("content[]").length;
    var dfile= document.getElementsByName("content[]");
    var error = 0;
    var id_num = 0;
    for (var index = 0; index < dfile.length; index++) {
        var qid = dfile[index].getAttribute("id");
        var hash=qid;
        var ids = hash.split('_');
        var id_num = ids[1];
        var test = $("#text_editor_div"+id_num+" div.ck-content").html();
        if(test == '<p><br data-cke-filler="true"></p>'){
            toastr.error('Your text box is empty !');
            $("#text_editor_div"+id_num+" div.ck-content").focus();
            error += 1;
        }
    }
    var totalefile=document.getElementsByName("content_img[]");
     for(var findex = 0; findex < totalefile.length; findex++){
        var imgid = totalefile[findex].getAttribute("id");
        var img= $('#'+imgid)[0].files[0];
         if($('#'+imgid)[0].files.length ==""){
            toastr.error('Your image is empty !');
         }
     }
     var totalvideo=document.getElementsByName("content_video[]");
     for(var vindex = 0; vindex < totalvideo.length; vindex++){
        var vid = totalvideo[vindex].getAttribute("id");
         var vdata=  $("#"+vid).val();
         //   console.log(vdata);
         if( vdata ==""){
            toastr.error('Your video is empty !');
         }
     }
});




</script>