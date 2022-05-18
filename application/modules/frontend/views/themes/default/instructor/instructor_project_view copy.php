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

<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-xl-12 d-flex flex-column">
                <!--Start Section Header-->
                <div class="section-header mb-3 mb-sm-0">
                    <a href="<?php echo base_url($enterprise_shortname .'/instructor-project-add'); ?>"
                        class="btn btn-transparent border py-2">
                        Add New Project
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

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
                    <h5>2 comments (Beta)</h5>
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
                                    <img src="<?php echo base_url(!empty(get_picturebyid($get_instructorinfo->faculty_id)->picture) ? get_picturebyid($get_instructorinfo->faculty_id)->picture : default_image()); ?>"
                                        alt="">
                                </div>
                                <h5 class="stydent-name">
                                    <?php echo (!empty($get_instructorinfo->name) ? $get_instructorinfo->name : ''); ?>
                                </h5>
                                <div>
                                    <?php echo (!empty($get_instructorinfo->designation) ? $get_instructorinfo->designation : ''); ?>
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
});
</script>