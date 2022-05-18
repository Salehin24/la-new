<link
    href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css'); ?>"
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
</style>
<!--Start Student Profile Header-->
<?php  $this->load->view('dashboard_coverpage'); ?>
<!--End Student Profile Header-->
<div class="bg-dark-cerulean sticky-nav">
    <div class="container-lg">
        <?php $this->load->view('dashboard_topmenu'); ?>
    </div>
</div>
<?php 
$assignmentid = $this->uri->segment(3);
$assignment_courseid = '';
$assignment_chapterid = '';
$get_asseignmenteditdata = $this->Frontend_model->get_asseignmenteditdata($assignmentid);

if($get_asseignmenteditdata){
    $assignment_courseid = $get_asseignmenteditdata->course_id;
    $assignment_chapterid = $get_asseignmenteditdata->chapter_id;
    $get_sectionbycourse = $this->Frontend_model->get_sectionbycourse($assignment_courseid, $enterprise_id);
}
?>
<!-- <div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-xl-12 d-flex flex-column">
                <div class="card border-0 rounded-0 shadow-sm flex-fill w-100">
                    <div class="card-body p-4">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            
                            <div class="section-header mb-3 mb-sm-0">
                                <h4 class="mb-0">Delete this project</h4>
                            </div>
                            <button type="button" class="btn btn-transparent border py-2">
                                <i data-feather="trash-2"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="bg-alice-blue py-3 pt-md-0 pb-md-5">
    <div class="container-xxl custom-content">
        <br>
        <div class="">
            <?php
                $error = $this->session->flashdata('error');
                $success = $this->session->flashdata('success');
                if ($error != '') {
                    echo $error;
                }
                if ($success != '') {
                    echo $success;
                }
                ?>
        </div>
        <?php echo form_open_multipart($enterprise_shortname .'/student-project-save', 'class="row g-3" id=""'); ?>
        <div class="col-md-8 sticky-content">
            <!--Start card-->
            <div class="card border-0 rounded-0 shadow-sm mb-3">
                <div class="card-body p-4 p-xl-5">
                    <div class="mb-3">
                        <label for="projectTitle" class="form-label mb-1 fw-medium">Project Title *</label>
                        <input type="text" class="form-control form-control-lg" id="projectTitle" name="title"
                            placeholder="Project Title" required>
                    </div>
                    <div class="mb-3">
                        <label for="projectType" class="form-label mb-2 fw-medium">Project Type</label>
                        <select class="form-select form-select-lg" aria-label="Default select example" id="projectType"
                            name="projecttype" onchange="projecttypecourseareaload(this.value)" required>
                            <option value="">-- select one -- </option>
                            <option value="1" <?php echo (($assignmentid) ? 'selected' : ''); ?>>Course Project</option>
                            <option value="2">Own Original Project</option>
                            <option value="3">Practice Project</option>
                            <option value="4">Client Project</option>
                        </select>
                    </div>
                </div>
            </div>
            <!--End card-->

            <!--Start card-->
            <div class="card border-0 rounded-0 shadow-sm">
                <div class="card-body p-4 p-xl-5">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-text" role="tabpanel"
                            aria-labelledby="pills-text-tab">
                            <div class="card border-0 rounded-0" id="text_editor_div0">
                                <div class="card-body px-0">
                                    <div class="text-end">
                                        <button type="button" class="btn btn-transparent border py-2 mb-3"
                                            onclick="remove_editor(0)">
                                            <i data-feather="trash-2"></i>
                                        </button>
                                    </div>
                                    <textarea id="editor" name="content[]"></textarea>
                                    <input type="hidden" name="content_sl[]" value="1">
                                </div>
                            </div>
                        </div>

                        <!-- <div class="tab-pane fade" id="pills-video" role="tabpanel" aria-labelledby="pills-contact-tab">

                        </div>
                        <div class="tab-pane fade" id="pills-file" role="tabpanel" aria-labelledby="pills-file-tab">

                        </div> -->
                    </div>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-text-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-text" type="button" role="tab" aria-controls="pills-text"
                                aria-selected="true">Text</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-image-tab" type="button" role="tab" aria-selected="false"
                                onclick="image_content_add()">Image</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-video-tab" type="button"
                                onclick="video_content()">Video</button>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-file-tab" onclick="file_content()"
                                type="button">File</button>
                        </li> -->
                    </ul>
                </div>
            </div>
            <!--End card-->
        </div>
        <div class="col-md-4 sticky-content">
            <!--Start card-->
            <div class="card border-0 rounded-0 shadow-sm mb-4">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <div class="card-body p-4">
                        <!--Start Section Header-->
                        <div class="section-header mb-3">
                            <h5>Publishing Options</h5>
                            <div class="section-header_divider"></div>
                        </div>
                        <div class="mb-3">
                            <label for="publish_status" class="form-label mb-2 fw-medium">Publish Status</label>
                            <select class="form-select form-select-lg" aria-label="Default select example"
                                id="publish_status" name="publish_status"
                                onchange="get_publicnotpublicstatus(this.value)">
                                <option value="">-- select one -- </option>
                                <option value="0">Not Published</option>
                                <option value="1">Published</option>
                            </select>
                        </div>

                        <input type="submit" name="projectsave" id="projectsave"
                            class="btn btn-lg btn-success border d-block w-100 mb-2" value="Save">
                        <input type="submit" name="projectpublish" id="projectpublish"
                            class="btn btn-lg btn-dark-cerulean border d-block w-100 mb-3" value="Publish">

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" value="" id="visibilityOnPort"
                                name="visibilityonportfolio">
                            <label class="form-check-label" for="visibilityOnPort">Visibility on
                                Portfolio</label>
                        </div>

                        <div class="mb-3">
                            <h6 class="mb-2">Thumbnail</h6>
                            <div class="zone text-center">
                                <div id="dropZ3">
                                    <i class="fas fa-cloud-upload-alt mt-4 mb-3"></i>
                                    <div>Select or drop an image</div>
                                    <div class="selectFile">
                                        <label for="coverpic">Select file</label>
                                        <input type="file" name="coverpic" id="coverpic"
                                            onchange="fileValueOneCourse(this,'thumnailImage')">
                                    </div>
                                    <p class="text-danger">File size : 280*192</p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="" id="img-preview-thumnailImage"></div>
                        <br>
                        <div class="row mb-4">
                            <input type="date" id="publishdate" name="publishdate">
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h6>Area &amp; Skills </h6>
                                <div class="mb-3">
                                    <label for="skills" class="form-label mb-2 fw-medium">How would you
                                        categorize this project? (Choose upto 3)</label>
                                    <input type="text" name="skills" id="skills" class="form-control"
                                        data-role="tagsinput">
                                </div>

                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h6>Software Used</h6>
                                <div class="mb-3">
                                    <label for="software_used" class="form-label mb-2 fw-medium">Add the software
                                        used on this project</label>
                                    <input type="text" name="software_used" id="software_used" class="form-control"
                                        data-role="tagsinput">
                                </div>

                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h6>Tags</h6>
                                <div class="mb-3">
                                    <label for="tags" class="form-label mb-2 fw-medium">Use tags to add
                                        more details subject matter</label>
                                    <input type="text" name="tags" id="tags" class="form-control" data-role="tagsinput">
                                </div>
                            </div>
                        </div>

                        <!-- <div class="row">
                            <div class="col-md-12">
                                <h6>Course Project Status</h6>
                                <div class="alert alert-warning d-flex align-items-center mb-0" role="alert">
                                    <i data-feather="alert-triangle" class="me-3"></i>
                                    <div class="d-flex align-items-center justify-content-between w-100">
                                        <span class="fs-6">Project Not Submitted</span>
                                    </div>
                                </div>
                                <p class="mt-3">This course project has been submitted</p>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <!--End card-->

            <div class="card border-0 rounded-0 shadow-sm mb-0">
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div id="coursearea<?php echo (($assignmentid) ? 't' : ''); ?>">
                                <div class="mb-3">
                                    <label for="course_id" class="form-label mb-2 fw-medium">Select Your
                                        Course</label>
                                    <select class="form-select form-select-lg" aria-label="Default select example"
                                        id="course_id" name="course_id" onchange="get_sectionbycourse(this.value)">
                                        <option value="">-- select one --</option>
                                        <?php foreach($get_courses as $course){ ?>
                                        <option value="<?php echo $course->course_id; ?>"
                                            <?php echo (($assignment_courseid == $course->course_id) ? 'selected' : ''); ?>>
                                            <?php echo $course->name; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="section_id" class="form-label mb-2 fw-medium">Chapter/Section</label>
                                    <select class="form-select form-select-lg" aria-label="Default select example"
                                        id="section_id" name="section_id"
                                        onchange="get_lessonbycoursesection(this.value)">
                                        <option value="">-- select one -- </option>
                                        <?php foreach($get_sectionbycourse as $section){ ?>
                                        <option value="<?php echo $section->section_id; ?>"
                                            <?php //echo (($assignment_courseid == $course->course_id) ? 'selected' : ''); ?>>
                                            <?php echo $section->section_name; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="lesson_id" class="form-label mb-2 fw-medium">Lesson</label>
                                    <select class="form-select form-select-lg" aria-label="Default select example"
                                        id="lesson_id" name="lesson_id">
                                        <option value="">-- select one --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" checked value="1" id="getfeatured"
                                        name="getfeatured">
                                    <label class="form-check-label" for="getfeatured">Get Featured</label>
                                </div>
                            </div>

                            <input type="submit" name="projectsubmit"
                                class="btn btn-lg btn-success border d-block w-100 me-2 mb-2" value="Submit">
                            <!-- <input type="submit" name="projectresubmit"
                                class="btn btn-lg btn-dark-cerulean border d-block w-100" value="Update &amp; Resubmit"> -->

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
    $("#coursearea").hide();
});
var click_count = 1;
var click_image = click_count + 1;
var video_link_count = click_image + click_count + 1;
var file_link_count = video_link_count + click_image + click_count + 1;
var content_sl = 2;
$('#pills-text-tab').on('click', function() {
    var html = '<div class="card border-0 rounded-0" id="text_editor_div' + click_count +
        '"><div class="card-body px-0"><div class="text-end"><button type="button" class="btn btn-transparent border py-2 mb-3" onclick="remove_editor(' +
        click_count + ')"><i class="fas fa-trash-alt"></i></button></div><textarea id="editor' + click_count +
        '" name="content[]"></textarea><input type="hidden" name="content_sl[]" value="' + content_sl +
        '"></div></div>';

    $('#pills-text').append(html);

    ClassicEditor
        .create(document.querySelector('#editor' + click_count), {
            toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList'],
        })
        .catch(error => {
            console.error(error);
        });

    click_count = click_image + click_count + 1;
    content_sl += 1;
});



function remove_editor(sl) {
    var div = document.getElementById("text_editor_div" + sl);
    div.parentNode.removeChild(div);
}


function image_content_add() {
    var previewImage = "'previewImage_" + content_sl + "'";
    var showpreviewImage = "previewImage_" + content_sl + "";
    //    alert(previewImage);
    //    return false;
    var image_content = '<div class="card border-0 rounded-0" id="image_content' + click_image +
        '"><div class="card-body px-0"><div class="text-end"><button type="button" class="btn btn-transparent border py-2 mb-3" onclick="remove_image(' +
        click_image +
        ')"><i class="fas fa-trash-alt"></i></button></div><div class="zone text-center"><div id="dropZ2"><i class="fas fa-cloud-upload-alt mt-4 mb-3"></i><div>Select or drop an image</div><div class="selectFile"><label for="content_img">Select file</label><input type="file" name="content_img[]" id="content_img" onchange="fileValueOneCourse(this,' +
        previewImage +
        ')"></div><p class="text-danger">File size : 763*470</p><input type="hidden" name="contentimg_sl[]" value="' +
        content_sl + '"></div></div></div><div class="" id="img-preview-' + showpreviewImage + '"></div><br></div>';

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
        //   document.getElementById('image-preview-'+sectionval).src = window.URL.createObjectURL(value.files[0]);
        var img = '<img src="' + window.URL.createObjectURL(value.files[0]) + '" width="100%">'
        var filename = path.replace(/^.*[\\\/]/, '').split('.').slice(0, -1).join('.');
        $("#img-preview-" + sectionval).html(img);
        // document.getElementById("filename").innerHTML = filename;
    } else {
        alert("File not supported. Kindly Upload the Image of below given extension ")
    }
}

function video_content() {
    var video_content = '<div class="card border-0 rounded-0" id="video_link' + video_link_count +
        '"><div class="card-body px-0"><div class="text-end"><button type="button" class="btn btn-transparent border py-2 mb-3" onclick="remove_link_content(' +
        video_link_count +
        ')"><i class="fas fa-trash-alt"></i></button></div><div class="mb-3">\n\
        <label for="content_video" class="form-label mb-1 fw-medium">Embed Video or Audio *</label><input type="text" class="form-control form-control-lg" id="content_video" name="content_video[]" value="" onkeyup="getVideoIframeload(this.value,'+content_sl+')"><p class="mt-2 text-muted mb-0 d-flex align-items-center">\n\
        <span>Embed files from vimeo, YouTube, Soundcloud, Flickr, Spotify, Dailymotion, Sketch and Wistia</span></p>\n\
        <input type="hidden" name="contentvideo_sl[]" value="' + content_sl + '">\n\
        <div class="videoload_' + content_sl + '"></div>\n\
        </div></div></div>';
    $('#pills-text').append(video_content);

    video_link_count++;
    content_sl += 1;
    $("#pills-video-tab").addClass("active");
    $("#pills-text-tab").removeClass("active");
    $("#pills-image-tab").removeClass("active");
    $("#pills-file-tab").removeClass("active");
};
 
function getVideoIframeload(link, sl){

    $.ajax({
    url: base_url + enterprise_shortname + "/getvideoiframe-load",
    type: "post",
    data: { csrf_test_name: CSRF_TOKEN, link: link},
    success: function (data) {
        $(".videoload_"+sl).html(data);
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


"use strict";
function projecttypecourseareaload(type) {
    $("#courseareat").attr("id", "coursearea");
    if (type == 1) {
        $("#coursearea").show();
    } else {
        $("#coursearea").hide();
    }
}

</script>