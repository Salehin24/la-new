<div class="container">
    <div class="row">
        <div class="col-12">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb my-3">
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Project</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <?php echo (!empty($get_projectsingledata->title) ? $get_projectsingledata->title : ''); ?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- <div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-xl-12 d-flex flex-column">
                <div class="section-header mb-3 mb-sm-0">
                    <a href="<?php echo base_url($enterprise_shortname .'/instructor-project-add'); ?>"
                        class="btn btn-transparent border py-2">
                        Add New Project
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="bg-alice-blue py-3 pt-md-0 pb-md-5">
    <div class="container-xxl custom-content">
        <div class="row g-3">
            <div class="col-md-8 sticky-content">
                <!--Start card-->
                <div class="card border-0 rounded-0 shadow-sm mb-3">
                    <div class="card-body p-4 p-xl-5">
                        <div class="mb-3">
                            <div class="flex-grow-1 pb-4 border-bottom">
                                <h5 class="text-capitalize mb-1">
                                    <?php echo (!empty($get_projectsingledata->title) ? $get_projectsingledata->title : ''); ?>
                                </h5>
                                <!-- <div class="fw-medium text-muted">By - Halima Begum</div> -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center mt-2 me-3">
                                            <i class="far fa-eye me-2"></i>
                                            <div class="d-block">
                                                <div>902</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mt-2">
                                            <i class="far fa-comment me-2"></i>
                                            <div class="d-block">
                                                <div>2</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="d-flex align-items-center">
                                            <button type="button" class="btn btn-dark-cerulean">Edit</button>
                                            <button type="button" class="btn btn-transparent">
                                                <i data-feather="trash"></i>
                                            </button>
                                        </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <img src="<?php echo base_url(!empty($get_projectsingledata->coverpic) ? $get_projectsingledata->coverpic : default_600_400()); ?>"
                                    class="img-fluid" alt="">
                            </div>
                        </div>

                        <?php if($get_singleprojectdetails){
                                foreach($get_singleprojectdetails as $single){
                                ?>
                        <?php if($single->type == 1){ ?>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="mt-3"><?php echo (!empty($single->value) ? $single->value : ''); ?></p>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($single->type == 2){ ?>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="<?php echo base_url(!empty($single->value) ? $single->value : default_600_400()); ?>"
                                    class="img-fluid" alt="">
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($single->type == 3) {?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="position-relative project_vdo">
                                    <!-- <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/12.jpg'); ?>"
                                        class="img-fluid" alt=""> -->
                                    <img src="<?php echo base_url(default_600_400()); ?>" class="img-fluid" alt=""
                                        style="width: 100%;">
                                    <div class="course-card__hover--content">
                                        <!--Start Video Icon With Popup Youtube-->
                                        <a class="course-card__hover--content___icon popup-youtube"
                                            href="<?php echo (!empty($single->value) ? $single->value : ''); ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="92" height="92"
                                                viewBox="0 0 92 92">
                                                <g id="Ellipse_2c" data-name="Ellipse 2" fill="none" stroke="#fff"
                                                    stroke-width="3">
                                                    <circle cx="46" cy="46" r="46" stroke="none" />
                                                    <circle cx="46" cy="46" r="44.5" fill="none" />
                                                </g>
                                                <g id="Polygon_1c" data-name="Polygon 1"
                                                    transform="translate(63 32) rotate(90)" fill="none">
                                                    <path d="M14.5,0,29,25H0Z" stroke="none" />
                                                    <path
                                                        d="M 14.5 5.979442596435547 L 5.208076477050781 22 L 23.79192352294922 22 L 14.5 5.979442596435547 M 14.5 0 L 29 25 L 0 25 L 14.5 0 Z"
                                                        stroke="none" fill="#fff" />
                                                </g>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <br>
                        <?php } }?>
                    </div>
                </div>
                <!--End card-->

                <div class="section-header mt-5 mb-4">
                    <h5>2 comments</h5>
                    <div class="section-header_divider"></div>
                </div>

                <div class="card border-0 rounded-0 shadow-sm mb-3">
                    <div class="card-body p-4 p-xl-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="img-user width_55p">
                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/avatar-02.jpg'); ?>"
                                    class="rounded-circle img-fluid" alt="">
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1">Shahabuddin Khan<span
                                        class="bg-dark-cerulean text-white px-3 ms-2 rounded">Instructor</span></h6>
                                <p class="mb-0">5 Days ago</p>
                            </div>
                        </div>
                        <p class="mb-0">It's very awesome and fascinating very much.</p>
                    </div>
                </div>

                <div class="card border-0 rounded-0 shadow-sm mb-3">
                    <div class="card-body p-4 p-xl-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="img-user width_55p">
                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/avatar-01.jpg'); ?>"
                                    class="rounded-circle img-fluid" alt="">
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1">Halima Khatun<span
                                        class="bg-dark-cerulean text-white px-3 ms-2 rounded">Instructor</span></h6>
                                <p class="mb-0">about 1 year ago</p>
                            </div>
                        </div>
                        <p class="mb-0">It's very awesome and fascinating very much.</p>
                    </div>
                </div>

                <div class="card border-0 rounded-0 shadow-sm mb-3">
                    <div class="card-body p-4 p-xl-5">
                        <div class="section-header mb-4">
                            <h5>Add a comment:</h5>
                            <div class="section-header_divider"></div>
                        </div>
                        <textarea name="" id="editor" cols="30" rows="10"></textarea>
                        <button type="button" class="btn btn-dark-cerulean mt-4">
                            Post a comment
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 sticky-content">
                <!--Start card-->
                <div class="card border-0 rounded-0 shadow-sm mb-4">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <div class="card-body p-4">
                            <!--Start Section Header-->
                            <div class="section-header mb-4">
                                <h5 class="border-bottom pb-3">A Project By</h5>
                            </div>
                            <!--End Section Header-->
                            <div class="text-center mb-4">
                                <div class="avatar-img mb-3 d-inline-block position-relative">
                                    <img src="<?php echo base_url(!empty(get_picturebyid($get_studentinfo->student_id)->picture) ? get_picturebyid($get_studentinfo->student_id)->picture : default_image()); ?>"
                                        alt="">
                                </div>
                                <h5 class="stydent-name">
                                    <?php echo (!empty($get_studentinfo->name) ? $get_studentinfo->name : ''); ?>
                                </h5>
                                <div>
                                    <?php echo (!empty($get_studentinfo->designation) ? $get_studentinfo->designation : ''); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End card-->
                <!--Start card-->
                <div class="card border-0 rounded-0 shadow-sm mb-4">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <div class="card-body p-4">
                            <div class="section-header mb-4">
                                <div class="section-header mb-4">
                                    <h5>Project Details:</h5>
                                    <div class="section-header_divider"></div>
                                </div>
                                <div class="d-block mb-4">
                                    <p>Published On :
                                        <?php echo date('F Y', strtotime($get_projectsingledata->publishdate)); ?></p>
                                    <!-- <p>Featured : About 1 Year ago</p> -->
                                </div>
                                <div class="section-header mb-4">
                                    <h5>Software:</h5>
                                    <div class="section-header_divider"></div>
                                </div>
                                <?php 
                                $softwares = array();
                                if($get_projectsingledata->software_used){
                                    $softwares = explode(',', $get_projectsingledata->software_used);
                                }
                                ?>
                                <div class="d-block mb-4">
                                    <?php 
                                    if($softwares){
                                        $count=1;
                                    foreach($softwares as $soft){ ?>
                                    <a href="javascript:void(0)"><?php echo $soft; ?></a>
                                    <?php if(count($softwares) > $count){ echo ',';} ?>
                                    <?php 
                                $count++;
                                } } ?>
                                </div>
                                <!--Start Section Header-->
                                <div class="section-header mb-4">
                                    <h5>Tags:</h5>
                                    <div class="section-header_divider"></div>
                                </div>
                                <!--End Section Header-->
                                <?php 
                                $tags = array();
                                if($get_projectsingledata->tags){
                                    $tags = explode(',', $get_projectsingledata->tags);
                                }
                                ?>
                                <!--Start Skills-->
                                <?php 
                                    if($tags){
                                    foreach($tags as $tag){ ?>
                                <span
                                    class="d-inline-block border fs-6 px-2 py-1 rounded me-2 mb-2"><?php echo $tag; ?></span>
                                <?php } } ?>
                                <!--End Skills-->

                                <!--Start Section Header-->

                                <!--End Section Header-->
                                <!--Start Course Card-->

                                <!--End Course Card-->

                            </div>
                        </div>
                    </div>
                </div>
                <!--End card-->

                <!--Start card-->
                <div class="card border-0 rounded-0 shadow-sm mb-4">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <div class="card-body p-4">
                            <!--Start Section Header-->
                            <div class="section-header mb-4">
                                <h5 class="border-bottom pb-3">Instructor Review</h5>
                            </div>
                            <!--End Section Header-->
                            <div class="d-block">
                                <h4>Course</h4>
                                <p>The complete digital marketing path for beginers</p>
                            </div>
                            <div class="d-flex">
                                <div class="mb-3 me-2">
                                    <label for="chapter_source"
                                        class="form-label mb-1 fw-medium">Chapter/Section</label>
                                    <input type="text" class="form-control form-control-lg" id="chapter_source"
                                        value="<?php echo (!empty($get_projectsingledata->chapter_source) ? $get_projectsingledata->chapter_source : ''); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="lesson_source" class="form-label mb-1 fw-medium">Lesson</label>
                                    <input type="text" class="form-control form-control-lg" id="lesson_source"
                                        value="<?php echo (!empty($get_projectsingledata->lesson_source) ? $get_projectsingledata->lesson_source : ''); ?>">
                                </div>
                            </div>
                            <!-- <div class="form-check mb-3">
									<input class="form-check-input" type="checkbox" value="" id="showTwo">
									<label class="form-check-label" for="showTwo">Get Featured</label>
								</div> -->
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input mt-3" type="radio" name="project_status"
                                        value="<?php echo $get_projectsingledata->project_status; ?>" id="review"
                                        <?php echo (($get_projectsingledata->project_status == 0) ? 'checked' : ''); ?>
                                        onchange="get_reasonarea()">
                                    <label class="form-check-label ms-3" for="review">
                                        <span class="check-info p-2 rounded d-inline-block mb-2">
                                            <i class="fas fa-info-circle me-2"></i>
                                            <span>Project in Review </span>
                                        </span>
                                        <span class="d-block">This course project is being reviewed</span>
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input mt-3" type="radio" name="project_status"
                                        value="<?php echo $get_projectsingledata->project_status; ?>" id="approved"
                                        <?php echo (($get_projectsingledata->project_status == 1) ? 'checked' : ''); ?>
                                        onchange="get_reasonarea()">
                                    <label class="form-check-label ms-3" for="approved">
                                        <span class="check-success p-2 rounded d-inline-block mb-2">
                                            <i class="fas fa-check-circle me-2"></i>
                                            <span>Congratulations! <br>&nbsp;&nbsp;&nbsp;Project approved</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input mt-3" type="radio" name="project_status"
                                        value="<?php echo $get_projectsingledata->project_status; ?>" id="not_approved"
                                        <?php echo (($get_projectsingledata->project_status == 2) ? 'checked' : ''); ?>
                                        onchange="get_reasonarea()">
                                    <label class="form-check-label ms-3" for="not_approved">
                                        <span class="check-danger p-2 rounded d-inline-block mb-2">
                                            <i class="fas fa-check-circle me-2"></i>
                                            <span>Project not approved</span>
                                        </span>
                                    </label>
                                    <div id="hidereason">
                                        <span class="d-block text-danger">Must state reason &amp; Requirements</span>
                                        <div class=" ms-3 mt-2">
                                            <textarea id="comment" class=""
                                                cols="45"><?php echo (!empty($get_projectsingledata->comment) ? $get_projectsingledata->comment : ''); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-block text-end">
                                <input type="hidden" id="project_id"
                                    value="<?php echo $get_projectsingledata->project_id; ?>">
                                <button class="btn btn-dark-cerulean" onclick="reviewsubmit()">Submit Review</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End card-->
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

    $("#hidereason").hide();

    if ($('#not_approved').is(":checked")) {
        $("#hidereason").show();
    } else {
        $("#hidereason").hide();
        $("#comment").val('');
    }
});


function get_reasonarea() {
    if ($('#not_approved').is(":checked")) {
        $("#hidereason").show();
    } else {
        $("#hidereason").hide();
        $("#comment").val('');
    }
}

function reviewsubmit() {
    var comment = '';
    var instructor_id = $("#user_id").val();
    var project_id = $("#project_id").val();
    var chapter_source = $("#chapter_source").val();
    var lesson_source = $("#lesson_source").val();
    var CSRF_TOKEN = $("#CSRF_TOKEN").val();
    var base_url = $("#base_url").val();
    var enterprise_shortname = $("#enterprise_shortname").val();

    if ($("#review").is(":checked")) {
        var project_status = 0;
    } else if ($("#approved").is(":checked")) {
        var project_status = 1;
    } else if ($("#not_approved").is(":checked")) {
        var project_status = 2;
        var comment = $("#comment").val();
        if (comment == '') {
            toastr["error"]("Comment must be required!");
            return false;
        }
    }
    var fd = new FormData();
    fd.append("user_id", instructor_id);
    fd.append("project_status", project_status);
    fd.append("comment", comment);
    fd.append("project_id", project_id);
    fd.append("chapter_source", chapter_source);
    fd.append("lesson_source", lesson_source);
    fd.append("csrf_test_name", CSRF_TOKEN);

    $.ajax({
        url: base_url + enterprise_shortname + "/instructor-project-review-submit",
        type: "POST",
        data: fd,
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        success: function(r) {
            toastr["success"](r);
        },
    });
}
</script>