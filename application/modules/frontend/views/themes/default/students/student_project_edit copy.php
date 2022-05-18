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

.coverpic-img {
    width: 40%;
    margin-top: 10px;
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
        <?php echo form_open_multipart($enterprise_shortname .'/student-project-update', 'class="row g-3" id="myform"'); ?>
        <div class="col-md-8 sticky-content">
            <!--Start card-->
            <div class="card border-0 rounded-0 shadow-sm mb-3">
                <div class="card-body p-4 p-xl-5">
                    <div class="mb-3">
                        <label for="projectTitle" class="form-label mb-1 fw-medium">Project Title *</label>
                        <input type="text" class="form-control form-control-lg" id="projectTitle" name="title"
                            placeholder="Project Title"
                            value="<?php echo (!empty($get_projecteditdata->title) ? $get_projecteditdata->title : ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="projectType" class="form-label mb-2 fw-medium">Project Type</label>
                        <select class="form-select form-select-lg" aria-label="Default select example" id="projectType"
                            name="projecttype" onchange="projecttypecourseareaload(this.value)" required>
                            <option value="">-- select one -- </option>
                            <option value="1"
                                <?php echo (($get_projecteditdata->project_type == 1) ? 'selected' : ''); ?>>
                                Course Project</option>
                            <option value="2"
                                <?php echo (($get_projecteditdata->project_type == 2) ? 'selected' : ''); ?>>Own
                                Original Project</option>
                            <option value="3"
                                <?php echo (($get_projecteditdata->project_type == 3) ? 'selected' : ''); ?>>
                                Practice Project</option>
                            <option value="4"
                                <?php echo (($get_projecteditdata->project_type == 4) ? 'selected' : ''); ?>>
                                Client Project</option>
                        </select>
                    </div>
                </div>
            </div>
            <!--End card-->

            <!--Start card-->
            <div class="card border-0 rounded-0 shadow-sm">
                <div class="card-body p-4 p-xl-5">
                    <?php
                        //d($get_projectdetails);
                        $sl = 0;
                        foreach($get_projectdetails as $projectdetail){ ?>
                    <?php if($projectdetail->type == 1){ ?>
                    <div class="card border-0 rounded-0" id="image_content<?php echo $sl; ?>">
                        <div class="card-body px-0">
                            <div class="text-end">
                                <button type="button" class="btn btn-danger btn-transparent border py-2 mb-3"
                                    onclick="projectdetailsdelete('<?php echo $projectdetail->id; ?>')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                            <p>
                                <?php echo $projectdetail->value; ?>
                            </p>
                        </div>
                    </div>
                    <!-- <div class="card border-0 rounded-0" id="text_editor_div<?php echo $sl?>">
                                <div class="card-body px-0">
                                    <div class="text-end">
                                        <button type="button" class="btn btn-transparent border py-2 mb-3"
                                            onclick="remove_editor(<?php echo $sl?>)">
                                            <i data-feather="trash-2"></i>
                                        </button>
                                    </div>
                                    <textarea id="contenteditor<?php echo $sl?>" class="contenteditor"
                                        name="content[]"><?php echo $projectdetail->value; ?></textarea>
                                </div>
                            </div> -->
                    <?php $sl +=1;
                    } ?>
                    <?php if($projectdetail->type == 2){ ?>
                    <div class="card border-0 rounded-0" id="image_content<?php echo $sl; ?>">
                        <div class="card-body px-0">
                            <img src="<?php echo base_url($projectdetail->value); ?>" class="coverpic-img">
                            <button type="button" class="btn btn-danger btn-transparent border py-2 mb-3"
                                onclick="projectdetailsdelete('<?php echo $projectdetail->id; ?>')">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                    <!-- <div class="card border-0 rounded-0" id="image_content2">
                            <div class="card-body px-0">
                                <div class="text-end">
                                    <button type="button" class="btn btn-transparent border py-2 mb-3"
                                        onclick="remove_image(2)"><i class="fas fa-trash-alt"></i></button>
                                </div>
                                <div class="zone text-center">
                                    <div id="dropZ2"><i class="fas fa-cloud-upload-alt mt-4 mb-3"></i>
                                        <div>Select or drop an image</div>
                                        <div class="selectFile">
                                            <label for="content_img">Select file</label><input type="file"
                                                name="content_img[]" id="content_img">
                                        </div>
                                        <p>File size limit : 10 MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="text" name="old_content_img[]" value="<?php echo $projectdetail->value; ?>"> -->
                    <?php } ?>
                    <?php if($projectdetail->type == 3){ ?>
                    <div class="card border-0 rounded-0" id="image_content<?php echo $sl; ?>">
                        <div class="card-body px-0">
                            <div class="text-end">
                                <button type="button" class="btn btn-danger btn-transparent border py-2 mb-3"
                                    onclick="projectdetailsdelete('<?php echo $projectdetail->id; ?>')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                            <?php
                                    $youtubeid =  youtube_id($projectdetail->value);
                                    if($youtubeid){
                             ?>
                            <iframe width="700" height="400" src="https://www.youtube.com/embed/<?php echo $youtubeid; ?>"></iframe>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- <div class="card border-0 rounded-0" id="video_link4">
                            <div class="card-body px-0">
                                <div class="text-end">
                                    <button type="button" class="btn btn-transparent border py-2 mb-3"
                                        onclick="remove_link_content(4)"><i class="fas fa-trash-alt"></i></button>
                                </div>
                                <div class="mb-3">
                                    <label for="content_video" class="form-label mb-1 fw-medium">Embed Video or Audio
                                        *</label>
                                    <input type="text" class="form-control form-control-lg" id="content_video"
                                        name="content_video[]" value="<?php echo $projectdetail->value; ?>">
                                    <p class="mt-2 text-muted mb-0 d-flex align-items-center"><i data-feather="info"
                                            class="me-2 width-20"></i>
                                        <span>Embed files from vimeo, YouTube, Soundcloud, Flickr, Spotify, Dailymotion,
                                            Sketch and Wistia</span>
                                    </p>
                                </div>
                            </div>
                        </div> -->
                    <?php } ?>
                    <?php } ?>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-text" role="tabpanel"
                            aria-labelledby="pills-text-tab">
                            <div class="card border-0 rounded-0" id="text_editor_div0">

                            </div>
                        </div>

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
                                <option value="0"
                                    <?php echo (!empty($get_projecteditdata->publish_status == 0) ? 'selected' : ''); ?>>
                                    Not Published</option>
                                <option value="1"
                                    <?php echo (!empty($get_projecteditdata->publish_status == 1) ? 'selected' : ''); ?>>
                                    Published</option>
                            </select>
                        </div>

                        <input type="submit" name="projectsave" id="projectsave"
                            <?php if($get_projecteditdata->publish_status == 1){echo 'disabled'; } ?>
                            class="btn btn-lg btn-success border d-block w-100 mb-2" value="Save">
                        <input type="submit" name="projectpublish" id="projectpublish"
                            <?php if($get_projecteditdata->publish_status == 0){echo 'disabled'; } ?>
                            class="btn btn-lg btn-dark-cerulean border d-block w-100 mb-3" value="Publish">

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox"
                                value="<?php echo $get_projecteditdata->is_visibility; ?>"
                                <?php echo (($get_projecteditdata->is_visibility == 1) ? 'checked' : ''); ?>
                                id="visibilityOnPort" name="visibilityonportfolio">
                            <label class="form-check-label" for="visibilityOnPort">Visibility on
                                Portfolio</label>
                        </div>

                        <div class="mb-3">
                            <h6 class="mb-2">Cover Image</h6>
                            <div class="zone text-center">
                                <div id="dropZ3">
                                    <i class="fas fa-cloud-upload-alt mt-4 mb-3"></i>
                                    <div>Select or drop an image</div>
                                    <div class="selectFile">
                                        <label for="coverpic">Select file</label>
                                        <input type="file" name="coverpic" id="coverpic"
                                            onchange="fileValueOne(this,'project_cover')">
                                    </div>
                                    <p>File size limit : 10 MB</p>
                                </div>
                            </div>
                            <br>
                            <img id="image-preview-project_cover" src="" alt="" class="border border-2" width="200px">
                            <br>
                            <?php if($get_projecteditdata->coverpic){ ?>
                            <img src="<?php echo base_url($get_projecteditdata->coverpic); ?>" class="coverpic-img">
                            <?php } ?>
                            <input type="hidden" name="old_coverpic"
                                value="<?php echo $get_projecteditdata->coverpic; ?>">
                        </div>

                        <div class="row mb-4">
                            <input type="date" id="publishdate" name="publishdate"
                                value="<?php echo $get_projecteditdata->publishdate; ?>">
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h6>Area &amp; Skills </h6>
                                <div class="mb-3">
                                    <label for="skills" class="form-label mb-2 fw-medium">How would you
                                        categorize this project? (Choose upto 3)</label>
                                    <input type="text" name="skills" id="skills" class="form-control"
                                        data-role="tagsinput"
                                        value="<?php echo (!empty($get_projecteditdata->skills) ? $get_projecteditdata->skills : ''); ?>">
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
                                        data-role="tagsinput"
                                        value="<?php echo (!empty($get_projecteditdata->software_used) ? $get_projecteditdata->software_used : ''); ?>">
                                </div>

                            </div>
                        </div>


                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h6>Tags</h6>
                                <div class="mb-3">
                                    <label for="tags" class="form-label mb-2 fw-medium">Use tags to add
                                        more details subject matter</label>
                                    <input type="text" name="tags" id="tags" class="form-control" data-role="tagsinput"
                                        value="<?php echo (!empty($get_projecteditdata->tags) ? $get_projecteditdata->tags : ''); ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="mb-3">Course Project Status</h5>
                                <div class="alert alert-<?php echo (($get_projecteditdata->project_status == 1) ? 'success' : 'warning'); ?> d-flex align-items-center mb-0"
                                    role="alert">
                                    <div class="d-flex align-items-center justify-content-between w-100">
                                        <span class="fs-6">
                                            <?php if($get_projecteditdata->project_status == 0){
                                                        echo '<i class="fas fa-info-circle me-2"></i> Project in Review';
                                                        }elseif($get_projecteditdata->project_status == 1){
                                                            echo '<i class="fas fa-check-circle me-2"></i> Congratulations!<br> Project approved';
                                                        }elseif($get_projecteditdata->project_status == 2){
                                                            echo '<i class="far fa-times-circle"></i> Project not approved';
                                                        } ?>
                                        </span>
                                    </div>
                                </div>
                                <p class="mt-3">
                                    <?php if($get_projecteditdata->project_status == 2){ 
                                                echo $get_projecteditdata->comment; 
                                            }        
                                            ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End card-->

            <div class="card border-0 rounded-0 shadow-sm mb-0">
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div id="coursearea">
                                <div class="mb-3">
                                    <label for="course_id" class="form-label mb-2 fw-medium">Select Your
                                        Course</label>
                                    <select class="form-select form-select-lg" aria-label="Default select example"
                                        id="course_id" name="course_id" onchange="get_sectionbycourse(this.value)">
                                        <option value="">-- select one --</option>
                                        <?php foreach($get_courses as $course){ ?>
                                        <option value="<?php echo $course->course_id; ?>"
                                            <?php echo (($get_projecteditdata->course_id == $course->course_id) ? 'selected' : ''); ?>>
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
                                            <?php echo (($get_projecteditdata->section_id == $section->section_id) ? 'selected' : ''); ?>>
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
                                        <?php foreach($get_lessonbycoursesection as $lesson){ ?>
                                        <option value="<?php echo $lesson->lesson_id; ?>"
                                            <?php echo (($get_projecteditdata->lesson_id == $lesson->lesson_id) ? 'selected' : ''); ?>>
                                            <?php echo $lesson->lesson_name; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox"
                                        value="<?php echo $get_projecteditdata->getfeatured; ?>" id="getfeatured"
                                        <?php echo (($get_projecteditdata->getfeatured == 1) ? 'checked' : '');?>
                                        name="getfeatured">
                                    <label class="form-check-label" for="getfeatured">Get Featured</label>
                                </div>
                            </div>

                            <input type="hidden" name="project_id" value="<?php echo $get_projecteditdata->project_id; ?>">
                            <!-- <input type="submit" name="projectsubmit"
                                    class="btn btn-lg btn-success border d-block w-100 me-2 mb-2" value="Submit"> -->
                            <input type="submit" name="projectresubmit"
                                class="btn btn-lg btn-dark-cerulean border d-block w-100" value="Update &amp; Resubmit">

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
// image preview js 
function fileValueOne(value, sectionval) {
    // all old preview image hide
    $('.img_border').hide();
    var path = value.value;
    var extenstion = path.split('.').pop();
    if (extenstion == "jpg" || extenstion == "svg" || extenstion == "jpeg" || extenstion == "png" || extenstion ==
        "gif") {
        document.getElementById('image-preview-' + sectionval).src = window.URL.createObjectURL(value.files[0]);
        var filename = path.replace(/^.*[\\\/]/, '').split('.').slice(0, -1).join('.');
        // document.getElementById("filename").innerHTML = filename;
    } else {
        alert("File not supported. Kindly Upload the Image of below given extension ")
    }
}





var click_count = 1;
var click_image = click_count + 1;
var video_link_count = click_image + click_count + 1;
var file_link_count = video_link_count + click_image + click_count + 1;
var content_sl = "<?php echo $get_projectdetailsmax_sl->max_sl; ?>";
var content_sl = parseInt(content_sl) + 1;
// alert(content_sl);

$('#pills-text-tab').on('click', function() {
    var html = '<div class="card border-0 rounded-0" id="text_editor_div' + click_count +
        '"><div class="card-body px-0"><div class="text-end"><button type="button" class="btn btn-transparent border py-2 mb-3" onclick="remove_editor(' +
        click_count + ')"><i class="fas fa-trash-alt"></i></button></div><textarea id="editor' + click_count +
        '" name="content[]"></textarea><input type="hidden" name="content_sl[]" value="' + content_sl +
        '"></div></div>';

    $('#pills-text').append(html);

    ClassicEditor
        .create(document.querySelector('#editor' + click_count),{
    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ],
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
            ]
        }
    })
        .catch(error => {
            console.error(error);
        });
    $()

    click_count = click_image + click_count + 1;
    content_sl += 1;
});

$(document).ready(function() {
    //Editor

    var input = document.getElementsByName('content[]');
    for (var i = 0; i < input.length; i++) {
        ClassicEditor
            .create(document.querySelector('#contenteditor' + i))
            .catch(error => {
                console.error(error);
            });
    }


});





function remove_editor(sl) {
    var div = document.getElementById("text_editor_div" + sl);
    div.parentNode.removeChild(div);
}


function image_content_add() {
   var previewImage= "'previewImage_"+content_sl+"'";
   var showpreviewImage= "previewImage_"+content_sl+"";
//    alert(previewImage);
//    return false;

    var image_content = '<div class="card border-0 rounded-0" id="image_content' + click_image +
        '"><div class="card-body px-0"><div class="text-end"><button type="button" class="btn btn-transparent border py-2 mb-3" onclick="remove_image(' +
        click_image +
        ')"><i class="fas fa-trash-alt"></i></button></div><div class="zone text-center"><div id="dropZ2"><i class="fas fa-cloud-upload-alt mt-4 mb-3"></i><div>Select or drop an image</div><div class="selectFile"><label for="content_img">Select file</label><input type="file" name="content_img[]" id="content_img" onchange="fileValueOneCourse(this,'+previewImage+')"></div><p>File size limit : 10 MB</p><input type="hidden" name="contentimg_sl[]" value="' +
        content_sl + '"></div></div></div><div class="" id="img-preview-'+showpreviewImage+'"></div><br></div>';

    $('#pills-text').append(image_content);


    // click_image = click_image + click_count + 1;
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
        var img = '<img src="' + window.URL.createObjectURL(value.files[0]) + '" width="20%">'
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
        ')"><i class="fas fa-trash-alt"></i></button></div><div class="mb-3"><label for="content_video" class="form-label mb-1 fw-medium">Embed Video or Audio *</label><input type="text" class="form-control form-control-lg" id="content_video" name="content_video[]" value=""><p class="mt-2 text-muted mb-0 d-flex align-items-center"><i data-feather="info" class="me-2 width-20"></i><span>Embed files from vimeo, YouTube, Soundcloud, Flickr, Spotify, Dailymotion, Sketch and Wistia</span></p><input type="hidden" name="contentvideo_sl[]" value="' +
        content_sl + '"></div></div></div>';
    $('#pills-text').append(video_content);

    video_link_count++;
    content_sl += 1;
    $("#pills-video-tab").addClass("active");
    $("#pills-text-tab").removeClass("active");
    $("#pills-image-tab").removeClass("active");
    $("#pills-file-tab").removeClass("active");
};

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

$("#coursearea").hide();
"use strict";

function projecttypecourseareaload(type) {
    if (type == 1) {
        $("#coursearea").show();
    } else {
        $("#coursearea").hide();
    }
}

var edit_projectype = '<?php echo $get_projecteditdata->project_type; ?>';
if (edit_projectype == 1) {
    $("#coursearea").show();
} else {
    $("#coursearea").hide();
}
</script>