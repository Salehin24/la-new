<?php //d($get_projectlist); ?>
<!--Start Student Profile Header-->
<div class="student-profile-header hero-header blue text-white position-relative bg-img"
    data-image-src="<?php echo base_url(!empty(getappsettings($enterprise_id)->project_header_image) ? getappsettings($enterprise_id)->project_header_image : default_600_400()); ?>">
    <div class="container-lg hero-header_wrap position-relative py-5">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="text-center my-5">
                    <h1 class="stydent-name mb-4 text-uppercase">Your Tallent to the next level</h1>
                    <h5>We are proud of what we do and what our instructors &amp; learners do. It's their work. Projects
                        and feedback shared in real time.</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Student Profile Header-->
<div class="">
    <div class="custom-tabs bg-white border-bottom border-top">
        <div class="container-lg">
            <div class="align-items-center d-flex justify-content-between">
                <ul class="nav nav-custom border-0">
                    <li class="nav-item">
                        <a href="<?php echo 'javascript:void()' //base_url($enterprise_shortname.'/project-list'); ?>"
                            class="nav-link  all active" onclick="get_allprojectbytype('0', 'all')">All</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" onclick="get_allprojectbytype('1', 'courseproject')" class="nav-link courseproject">Courses
                            Project</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" onclick="get_allprojectbytype('4', 'clientproject')" class="nav-link clientproject">Client     Project</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:void(0)" onclick="get_allprojectbytype('2', 'ownoriginal')" class="nav-link ownoriginal">Personal  Project</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="javascript:void(0)" onclick="get_allprojectbytype('3', 'practiceproject')" class="nav-link practiceproject">Practice
                            Project</a>
                    </li> -->
                </ul>
                <!-- <div class="d-flex">
                    <select class="form-select form-select-sm" aria-label="Default select example">
                        <option selected>All time</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                    <select class="form-select form-select-sm ms-2" aria-label="Default select example">
                        <option selected>All Skills &amp; Areas</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div> -->
            </div>
        </div>
    </div>
</div>

<!--Start Featured Work-->
<div class="bg-alice-blue py-5">
    <div class="container-lg">
        <div class="load-projectlist">
            <div class="row g-3">
                <?php if($get_projectlist){ 
					foreach($get_projectlist as $project){
					?>
                <div class="col-lg-3 col-sm-6">
                    <div class="card border-0 rounded-0 shadow-sm">
                        <div class="card-body p-3">
                            <!--Start Project Card-->
                            <div class="project-card">
                                <div class="project-card_img position-relative overflow-hidden rounded">
                                    <img src="<?php echo base_url(!empty($project->coverpic) ? $project->coverpic : default_600_400()); ?>"
                                        alt="" class="img-fluid">
                                    <!-- <div
                                    class="align-content-between bottom-0 end-0 flex-wrap h-100 p-3 position-absolute project-card_overlay start-0 top-0">
                                    <div class="w-100">
                                        <div class="d-flex align-items-center text-white mb-1">
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="project-card_round--icon bg-primary d-flex align-items-center justify-content-center">
                                                    <i data-feather="anchor"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-2 fs-13">
                                                Featured
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center text-white">
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="project-card_round--icon bg-danger d-flex align-items-center justify-content-center">
                                                    <i data-feather="bookmark"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-2 fs-13">
                                                Course Project
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                </div>
                                <h3 class="course-card__course--title text-capitalize fs-6 mt-4">
                                    <a href="<?php echo base_url($enterprise_shortname .'/project-view/'.$project->project_id); ?>"
                                        class="text-dark fs-15 text-decoration-none"><?php echo (!empty($project->title) ? $project->title : ''); ?></a>
                                </h3>
                                <!--End Course Title-->
                                <!--Start Course instructor-->
                                <div class="course-card__instructor mb-3">
                                    <!-- <div class="course-card__instructor--name text-black-50 text-uppercase fw-medium fs-13">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div> -->
                                </div>
                                <div class="project-card_icon w-100 d-flex">
                                    <!-- <div class="mb-1 me-2 fs-13"><i data-feather="heart" class="me-1"></i>26</div>
                                <div class="mb-1 me-2 fs-13"><i data-feather="message-circle" class="me-1"></i>1</div>
                                <div class="mb-1 me-2 fs-13"><i data-feather="eye" class="me-1"></i>225</div> -->
                                </div>
                            </div>
                            <!--End Project Card-->
                        </div>
                    </div>
                </div>
                <?php 
				}
				}
				 ?>
            </div>
        <br>
        <div class="">
            <?php echo htmlspecialchars_decode($links); ?>
        </div>
        </div>
    </div>
</div>

<script>
"use sctrict";

function get_allprojectbytype(type, cls) {
    $(".nav-link").removeClass("active");
    $("."+cls).addClass("active");  
    $.ajax({
        url: base_url + enterprise_shortname + "/get-allprojectbytype",
        type: "POST",
        data: {
            csrf_test_name: CSRF_TOKEN,
            type: type,
            // mode: mode,
            enterprise_id: enterprise_id,
            enterprise_shortname: enterprise_shortname,
        },
        success: function(r) {
            // setTimeout(function() { 
            $(".load-projectlist").html(r);
            // }, 1000);
        },
    });
}
</script>