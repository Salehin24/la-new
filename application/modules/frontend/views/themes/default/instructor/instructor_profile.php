<style>
.nav-pills .nav-link.active,
.nav-pills .show>.nav-link {
    background-color: #07477d;
}
</style>
<?php 
$user_id = $this->session->userdata('user_id');
$user_type = $this->session->userdata('user_type');
?>
<!--Student Profile Edit Option-->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm mt-4">
            <div class="card-body p-4 p-xl-5">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="zone upload text-center">
                            <div id="dropZ">
                                <div class="selectFile">
                                    <label for="file"><i data-feather="camera" class="me-2"></i>Upload Profile
                                        Picture</label>
                                    <input type="file" name="profilepic" id="profilepic"
                                        onchange="instructor_profileupload(this)">
                                </div>
                            </div>
                        </div>
                        <div class="mt-1 text-danger">(Recommended: 120x120px)</div>
                    </div>
                    <div class="col-md-4">
                        <div class="zone upload text-center">
                            <div id="dropZ2">
                                <div class="selectFile">
                                    <label for="file2"><i data-feather="image" class="me-2"></i>Upload Cover
                                        Picture</label>
                                    <input type="file" name="coverpicture" id="coverpicture"
                                        onchange="studentcoverpictureupload(this)">
                                </div>
                            </div>
                        </div>
                        <div class="mt-1 text-danger">(Recommended: 1904x428px)</div>
                    </div>
                    <div class="col-md-4">
                        <a href="<?php echo base_url(($enterprise_shortname ? $enterprise_shortname : 'admin') . '/instructor-profile-edit'); ?>"
                            class="btn btn-lg btn-dark-cerulean"> <i data-feather="edit-3" class="me-2"></i>Edit
                            Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Student Profile Edit Option-->
<!--Start Resume/Portfolio PDF download-->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <?php 
        if($instructor_info->resume){
        //if($instructor_info->is_resumeshow == 1){ ?>
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5 d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold font-letter-spacing-1">Resume/Portfolio PDF </h4>
                <a href="<?php echo (!empty($instructor_info->resume) ? base_url($instructor_info->resume) : 'javascript:void()'); ?>"
                    class="download-icon ms-2" <?php echo (!empty($instructor_info->resume) ? 'download' : ''); ?>>
                    <svg enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512"
                        xmlns="http://www.w3.org/2000/svg" style="fill: #07477d;">
                        <g>
                            <path d="m380.35 101.65h92.863l-92.863-92.863z" />
                            <path
                                d="m350.35 131.65v-131.65h-230.35v60h200.35v209h-200.35v198h105.851l-70.458-86.829h78.107v-81.171h135v81.171h78.107l-70.458 86.829h105.851v-335.35z" />
                            <path
                                d="m89.653 140h-9.653v16.58h9.653c4.571 0 8.291-3.719 8.291-8.29s-3.72-8.29-8.291-8.29z" />
                            <path
                                d="m180.35 169.051v-9.102c0-11-8.949-19.949-19.949-19.949h-7.457v49h7.457c10.999 0 19.949-8.949 19.949-19.949z" />
                            <path
                                d="m290.35 239v-149h-260.35v149zm-75-119h45v20h-25v15h25v20h-25v34h-20zm-82.407 0h27.457c22.028 0 39.949 17.921 39.949 39.949v9.102c0 22.028-17.921 39.949-39.949 39.949h-27.457zm-43.29 56.58h-9.653v32.42h-20v-89h29.653c15.6 0 28.291 12.69 28.291 28.29s-12.692 28.29-28.291 28.29z" />
                            <path d="m301 512 82.629-101.829h-45.129v-81.171h-75v81.171h-45.129z" />
                        </g>
                    </svg>
                </a>


            </div>
        </div>
        <?php } 
        //} ?>
    </div>
</div>
<!--End Resume/Portfolio PDF download-->
<!--Start About Myself-->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <?php //if($instructor_info->is_profileshow == 1){ ?>
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <div class="mb-3">
                    <h4 class="fw-bold mb-1">
                        <?php echo (!empty($instructor_info->name) ? $instructor_info->name : ''); ?></h4>
                </div>
                <?php 
                // if($instructor_info->is_biographyshow == 1){ 
                    echo (!empty($instructor_info->biography) ? $instructor_info->biography : '');
                //  } ?>
                <div class="mt-3">
                    <h6 class="mb-1">Website</h6>
                    <a href="#"><?php echo (!empty($instructor_info->website) ? $instructor_info->website : '');  ?></a>
                </div>
            </div>
        </div>
        <?php //} ?>
    </div>
</div>
<!--End About Myself-->
<!--Start Personal Skills-->
<?php $skilss = ($instructor_info->skills ? explode(',', $instructor_info->skills) : '') ?>
<?php if($skilss){ ?>
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <?php //if($instructor_info->is_skillshow == 1){ ?>
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <!--Start Section Header-->
                <div class="section-header mb-4">
                    <h4 class="text-uppercase fw-bold">Skills</h4>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
                <!--Start Skills-->
                <?php
                if ($skilss) {
                    foreach ($skilss as $skill) {
                        ?>
                <span class="d-inline-block border fs-6 px-4 py-2 rounded me-2 mb-2"><?php echo $skill ?></span>
                <?php
                    }
                }
                ?>

                <!--End Skills-->
            </div>
        </div>
        <?php //} ?>
    </div>
</div>
<?php } ?>
<!--End Personal Skills-->

<!--Start Professional Proficiency-->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <?php if($instructor_profi){ 
            //if($instructor_info->is_proficiencyshow == 1){ ?>
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <div class="d-sm-flex justify-content-between mb-4">
                    <!--Start Section Header-->
                    <div class="section-header mb-3 mb-sm-0">
                        <h4 class="text-uppercase fw-bold">Professional Proficiency</h4>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                </div>

                <div class="row g-3">
                    <?php foreach ($instructor_profi as $proficiency) { ?>
                    <div class="col-sm-6 col-xl-3">
                        <div class="d-flex align-items-center p-2 border">
                            <div class="proficiency-brand_logo">
                                <img src="<?php echo base_url(($proficiency->logo) ? $proficiency->logo : 'assets/img/prof-proficiency-icon.svg'); ?>"
                                    alt="..." class="img-fluid">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5><?php echo (!empty($proficiency->proficiency) ? $proficiency->proficiency : ''); ?>
                                </h5>
                            </div>

                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } //} ?>
    </div>
</div>
<!--End Professional Proficiency-->
<!--Start Featured Work-->
<?php// if($get_featuredprojectportfolio){ ?>
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <!--Start Section Header-->
                    <div class="section-header">
                        <h4 class="fw-bold">Featured Work</h4>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                </div>
                <div class="position-relative">
                    <!--Nav Pills-->
                    <ul class="nav nav-pills mb-3 assignment_nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link featured_work_color fw-semi-bold active" id="pills-one-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-one" type="button" role="tab"
                                aria-controls="pills-one" aria-selected="true"
                                onclick="typewiseproject('0', 'view')">All</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link featured_work_color fw-semi-bold" id="pills-two-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-two" type="button" role="tab"
                                aria-controls="pills-two" aria-selected="false"
                                onclick="typewiseproject('1', 'view')">Course Project</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link featured_work_color fw-semi-bold" id="pills-five-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-five" type="button" role="tab"
                                aria-controls="pills-five" aria-selected="false"
                                onclick="typewiseproject('4', 'view')">Client Project</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link featured_work_color fw-semi-bold" id="pills-three-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-three" type="button" role="tab"
                                aria-controls="pills-three" aria-selected="false"
                                onclick="typewiseproject('2', 'view')">Personal Project</button>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-four-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-four" type="button" role="tab" aria-controls="pills-four"
                                aria-selected="false" onclick="typewiseproject('3', 'view')">Practice Project</button>
                        </li> -->
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-one" role="tabpanel"
                            aria-labelledby="pills-one-tab">
                            <div class="project-carousel owl-carousel owl-theme">
                                <!--Start Project Card-->
                                <?php if ($get_featuredprojectportfolio) { ?>
                                <?php foreach ($get_featuredprojectportfolio as $project) { 
                                    
                                    
                                ?>
                                <div class="project-card">
                                    <div class="project-card_img position-relative overflow-hidden rounded">
                                        <img src="<?php echo base_url((!empty($project->coverpic) ? $project->coverpic : default_600_400())); ?>"
                                            alt="" class="img-fluid">
                                        <div
                                            class="featured-opacity  bottom-0 d-flex end-0 flex-wrap h-100 <?php if($project->publish_status==0){ echo "justify-content-center";}else{ echo "align-items-center";}?> p-3 position-absolute project-card_overlay start-0 top-0">
                                            <div class="w-100">

                                            <?php if($project->project_type==1){ ?>
                                                <div class="d-flex align-items-center text-white mb-1">
                                                    <div class="flex-shrink-0">
                                                        <div
                                                            class="project-card_round--icon bg-primary d-flex align-items-center justify-content-center">
                                                            <i data-feather="anchor"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2 fs-13">
                                                        <?php 
                                                            if($project->coursetype==1){
                                                                echo "Chapter Project";
                                                            }else{ 
                                                                echo "Final Project";
                                                            }
                                                            ?>
                                                    </div>
                                                </div>
                                                <?php }?>

                                                <div class="align-items-center d-flex text-white mb-1">
                                                    <div class="flex-shrink-0">
                                                        <div
                                                            class="project-card_round--icon bg-danger d-flex align-items-center justify-content-center">
                                                            <i data-feather="bookmark"></i>
                                                        </div>
                                                    </div>
                                                    <div class=" ms-2 fs-13">
                                                        <?php if($project->project_type==1){?>
                                                        Course Project
                                                        <?php }elseif($project->project_type==2){?>
                                                        Personal Project
                                                        <?php }elseif($project->project_type==4){?>
                                                        Client Project
                                                        <?php }?>
                                                    </div>
                                                </div>
                                                <?php if($project->publish_status==0){?>
                                                <div class="align-items-center d-flex  text-white">
                                                    <div class="flex-shrink-0">
                                                        <div
                                                            class="project-card_round--icon bg-primary d-flex align-items-center justify-content-center">
                                                            <i data-feather="anchor"></i>
                                                        </div>
                                                    </div>
                                                    <div class=" ms-2 fs-13">
                                                        Draft
                                                    </div>
                                                </div>
                                                <?php }?>


                                            </div>

                                        </div>
                                    </div>
                                    <h6 class="project-card-title mb-0 mt-2 text-truncate">
                                        <a class="text-dark fs-15"
                                            href="<?php echo base_url($enterprise_shortname . '/instructor-project-view/' . $project->project_id); ?>">
                                            <?php echo (!empty($project->title) ? $project->title : ''); ?>
                                        </a>
                                    </h6>
                                    <!--Start Action Button-->
                                    <div class="action-btn align-items-center d-flex mt-3">
                                        <!-- <a href="<?php echo base_url($enterprise_shortname . '/student-project-edit/' . $project->project_id); ?>"
                                                            class="me-2 text-dark"><i data-feather="edit-3"
                                                                class="me-1"></i><span>Edit</span></a>
                                                        <a href="javascript:void(0)" class="me-2 text-danger" onclick="studentprojectdelete('<?php echo $project->project_id; ?>')"><i data-feather="trash-2"
                                                                class="me-1"></i><span>Delete</span></a> -->
                                    </div>
                                    <!--End Action Button-->
                                </div>
                                <?php } ?>
                                <?php } else { ?>
                                <p class="text-danger">Record not found!</p>
                                <?php } ?>
                                <!--End Project Card-->
                            </div>
                        </div>
                        <div class="tab-pane fade load-project" id="pills-two" role="tabpanel"
                            aria-labelledby="pills-tow-tab">

                        </div>
                        <div class="tab-pane fade load-project" id="pills-three" role="tabpanel"
                            aria-labelledby="pills-three-tab">

                        </div>
                        <div class="tab-pane fade load-project" id="pills-four" role="tabpanel"
                            aria-labelledby="pills-four-tab">

                        </div>
                        <div class="tab-pane fade load-project" id="pills-five" role="tabpanel"
                            aria-labelledby="pills-five-tab">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php //} ?>
<!--End Featured Work-->
<!--Start Experience-->
<?php if($get_userexperience){ ?>
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <?php //if($instructor_info->is_experienceshow == 1){ ?>
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <!--Start Section Header-->
                <div class="section-header mb-4">
                    <h4 class="text-uppercase fw-bold">Experience</h4>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
                <?php foreach ($get_userexperience as $experience) { ?>
                <div class="d-sm-flex justify-content-between align-items-center mb-5">
                    <div>
                        <h4 class="mb-1 fw-semi-bold fs-20">
                            <?php echo (!empty($experience->title) ? $experience->title : ''); ?> at
                            <?php echo (!empty($experience->companyname) ? $experience->companyname : ''); ?>
                        </h4>
                        <div class="hash-color fw-bold fs-16">
                            <?php echo (!empty($experience->city) ? $experience->city . ', ' : ''); ?>
                            <?php echo (!empty($experience->country) ? $experience->country : ''); ?></div>
                    </div>
                    <div
                        class="fs-16 fw-semi-bold ms-sm-2 mt-2 mt-sm-0 px-4 py-2 rounded site-fc text-nowrap experience-time-box">
                        <?php echo (!empty($experience->frommonth) ? $experience->frommonth : ''); ?>
                        <?php echo (!empty($experience->fromyear) ? $experience->fromyear : ''); ?> -
                        <?php
                            if ($experience->is_now == 1) {
                                echo 'Present';
                            } else {
                                echo (!empty($experience->tomonth) ? $experience->tomonth : '') . ' ';
                                echo (!empty($experience->toyear) ? $experience->toyear : '');
                            }
                            ?>
                    </div>
                </div>
                <hr>
                <?php } ?>
            </div>
        </div>
        <?php //} ?>
    </div>
</div>
<?php } ?>
<!--End Experience-->
<!--Start Education-->
<?php if($get_usereducation){ ?>
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <?php //if($instructor_info->is_educationshow == 1){ ?>
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <!--Start Section Header-->
                <div class="section-header mb-4">
                    <h4 class="text-uppercase fw-bold">Education</h4>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
                <div class="row g-3">
                    <?php foreach ($get_usereducation as $education) { ?>
                    <div class="col-md-6 col-xl-4">

                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <img src="<?php echo base_url(default_university()); ?>" alt="..."
                                    class="organization-logo rounded border p-2">
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h5><?php echo (!empty($education->institutename) ? $education->institutename : ''); ?>
                                </h5>
                                <div><?php echo (!empty($education->degree) ? $education->degree : ''); ?></div>
                                <em
                                    class="fs-13 text-muted"><?php echo (!empty($education->passing_year) ? $education->passing_year : ''); ?></em>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php //} ?>
    </div>
</div>
<?php } ?>
<!--End Education-->
<!--Start Certificates-->
<?php if($certificates){ ?>
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <!--Start Section Header-->
                <div class="section-header mb-4">
                    <h4 class="text-uppercase fw-bold">Credential Certificates</h4>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
                <!--Start Certificate Carousel-->
                <div class="certificate-carousel owl-carousel owl-theme">
                    <?php
                        foreach($certificates as $ins_certificate){
                             $certificate_id = $ins_certificate->id;
                            $logo = base_url($ins_certificate->institute_logo);
                            $certificatelink = base_url($ins_certificate->certificate);
                        ?>
                    <div class="card">
                        <div class="card-body p-4">
                            <div
                                class="text-center text-md-start d-sm-flex align-items-sm-center justify-content-sm-between mb-3">
                                <h5 class="text-capitalize mb-0">Successfully Completed</h5>
                                <a href="<?php echo ($ins_certificate?$certificatelink:'javascript:void(0)')?>"
                                    class="'.($certificate?'btn btn-dark-cerulean btn-sm mt-2 mt-sm-0 text-nowrap':'').'"
                                    download> <?php echo ($ins_certificate?'Download':'')?></a>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="text-center">
                                        <img src="<?php echo $logo?>"
                                            style="height:70px;width:70px;margin:0px;padding:0px;"
                                            class="rounded-circle">
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="text-capitalize mb-1"><?php echo $ins_certificate->certificatename?></h5>
                                    <div class="fw-medium text-muted"><?php echo $ins_certificate->year?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php }?>



                </div>
                <!--End Certificate Carousel-->
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!--End Certificates-->
<!--Start Contact-->
<?php if($instructor_info->contact_text || $instructor_info->public_email){ ?>
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <?php //if($instructor_info->is_contactshow == 1){ ?>
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <!--Start Section Header-->
                <div class="section-header mb-4">
                    <h4 class="text-uppercase fw-bold">Contact</h4>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
                <div class="text-center">
                    <?php if($instructor_info->contact_text){ ?>
                    <h6 class="fw-semi-bold text-navy-blue"><?php echo $instructor_info->contact_text; ?>?
                        <!-- <span class="text-danger"> -->
                        Say hello At
                        <!-- </span> -->
                    </h6>
                    <?php } ?>
                    <a href="mailto:webmaster@example.com" class="fs-3 fw-semi-bold"
                        style="color:#063f80;font-size:23px"><?php echo $instructor_info->public_email; ?></a>
                    <!--Start Social Share Icon-->
                    <div class="social-share_icon mt-3 fs-2">
                        <?php
                        if ($social_links) {
                            foreach ($social_links as $links) {
                                if ($links->link_type == 1) {
                                    $link = '<i class="fab fa-facebook text-blue"></i>';
                                } elseif ($links->link_type == 2) {
                                    $link = '<i class="fab fa-twitter text-blue"></i>';
                                } elseif ($links->link_type == 3) {
                                    $link = '<i class="fab fa-linkedin text-blue"></i>';
                                } elseif ($links->link_type == 4) {
                                    $link = '<i class="fab fa-github text-blue"></i>';
                                } elseif ($links->link_type == 5) {
                                    $link = '<i class="fab fa-instagram text-blue"></i>';
                                } elseif ($links->link_type == 6) {
                                    $link = '<i class="fab fa-youtube text-blue"></i>';
                                } elseif ($links->link_type == 7) {
                                    $link = '<i class="fab fa-vimeo text-blue"></i>';
                                } elseif ($links->link_type == 8) {
                                    $link = '<i class="fab fa-world text-blue"></i>';
                                }
                                ?>
                        <a href="<?php echo $links->link ?>"
                            class="d-inline-block me-3 text-dark"><?php echo $link; ?></a>
                        <?php
                               }
                           }
                           ?>


                    </div>
                    <!--End Social Share Icon-->
                </div>
            </div>
        </div>
        <?php //} ?>
    </div>
</div>
<?php } ?>
<!--End Contact-->

<!--Start Popular Course-->
<?php if($course_list){ ?>
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-3 p-md-4 p-xl-5">
                <!--Start Section Header-->
                <div class="section-header mb-4">
                    <h4 class="text-uppercase fw-bold">Instructor Courses</h4>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
                <!-- <div class="viewe-carousel owl-carousel owl-theme"> -->
                <div class="row" id="gridDemo">
                    <!--Start Course Card-->
                    <?php
                    if ($course_list) {
                        foreach ($course_list as $courses) {
                            ?>
                    <!--Start Course Card-->
                    <div class="col-xxl-3 col-lg-4 col-md-6 hideClass">
                        <div
                            class="course-card course-card-shadow rounded-6 bg-white position-relative overflow-hidden">
                            <div class="position-relative overflow-hidden bg-prussian-blue">
                                <!-- <div class="position-relative"> -->
                                <!--Start Course Image-->
                                <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses->course_id); ?>"
                                    class="course-card_img">
                                    <img src="<?php echo base_url(!empty($courses->picture) ? $courses->picture : default_600_400()); ?>"
                                        class="img-fluid w-100" alt="">
                                </a>
                                <!--End Course Image-->
                                <!--Start items badge-->

                                <div
                                    class="align-items-center top-0 d-flex fs-12 position-absolute px-3 py-2 start-0 text-white w-100 z-index-2">
                                    <?php
                                        if ($courses->tagstatus == 4) {?>
                                    <span class="badge-new  me-1">Most Popular</span>
                                    <?php
                                        } elseif ($courses->tagstatus == 3) {?>
                                    <span class="badge-new  me-1">New</span>
                                    <?php } elseif ($courses->tagstatus == 1) {?>
                                    <span class="badge-new  me-1">Recomended</span>

                                    <?php } elseif ($courses->tagstatus == 2) {?>
                                    <span class="badge-new  me-1">Best Seller</span>
                                    <?php }?>
                                    <span
                                        class="badge-business"><?php echo html_escape($courses->category_name); ?></span>
                                        <span id="savecourse<?php echo $courses->course_id; ?>" class="ms-auto">
                                        <?php
                                        $coursesaved_checked = $this->Frontend_model->coursesaved_checked($user_id,$courses->course_id);
                            
                                        if (!$coursesaved_checked){
                                            if ($user_type == 4) {?>
                                                <img onclick="get_coursesaveloop(1, '<?php echo $courses->course_id; ?>')" src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-1.png'); ?>"
                                                class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                                <?php }else {
                                                if($user_type != 5){
                                                ?>
                                                <img onclick="coursesavecheck()" src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-1.png'); ?>" class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                            <?php }}
                                        } else {?>
                                            
                                        <?php } ?>
                                        </span>
                                </div>
                                <!--End items badge-->
                                <!-- </div> -->
                                <?php if (!empty($courses->is_discount == 1)) {?>
                                <span
                                    class="px-0 badge m-3   position-absolute start-0 text-white   z-index-2 polygon-shape"
                                    style="top:25px">
                                    <span class="d-block fs-13 mb-1">Off</span>
                                    <span
                                        class="fs-15 fw-bold"><?php echo (($courses->discount) ? $courses->discount : ''); ?><?php if ($courses->discount_type == 2) {echo "%";} else {echo " ";}?></span>
                                </span>
                                <?php }?>
                                <!--Start Course Card Body-->
                                <div class="bg-prussian-blue course-card_body course_middle px-3 py-2 text-white py-12">
                                    <!--Start Course Title-->
                                    <h3 class="course-card__course--title  mb-0 text-capitalize">
                                        <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses->course_id); ?>"
                                            class="text-decoration-none text-white"><?php echo (!empty($courses->name) ? $courses->name : ''); ?></a>
                                    </h3>
                                    <!--End Course Title-->
                                    <div class="course-card__instructor d-flex align-items-center">
                                        <div class="card__instructor--name my-2">
                                            <a class="text-capitalize instructor-name"
                                                href="<?php echo base_url($enterprise_shortname . '/instructor-profile-show/' . $courses->faculty_id); ?>"><?php echo (!empty($courses->instructor_name) ? $courses->instructor_name : ''); ?></a>
                                        </div>
                                    </div>
                                    <!--Start Course Hints-->
                                    <table class="course-card__hints table table-borderless table-sm text-white mb-0">
                                        <tbody>
                                            <tr>
                                                <td width="80" class="ps-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="course-card__hints--icon me-3">
                                                            <?php if (@$courses->course_level == 1) {?>
                                                            <div class="d-flex align-items-center">
                                                                <div class="bar-custom me-2">
                                                                    <span class="fill"></span>
                                                                    <span></span>
                                                                    <span></span>
                                                                </div>
                                                            </div>
                                                            <?php } elseif (@$courses->course_level == 2) {?>
                                                            <div class="d-flex align-items-center">
                                                                <div class="bar-custom me-2">
                                                                    <span class="fill"></span>
                                                                    <span class="fill"></span>
                                                                    <span></span>
                                                                </div>
                                                            </div>
                                                            <?php } elseif (@$courses->course_level == 3) {?>
                                                            <div class="d-flex align-items-center">
                                                                <div class="bar-custom me-2">
                                                                    <span class="fill"></span>
                                                                    <span class="fill"></span>
                                                                    <span class="fill"></span>
                                                                </div>
                                                            </div>
                                                            <?php }?>
                                                        </div>
                                                        <div class="course-card__hints--text fs-12 fw-bold text-white">
                                                            <?php
                                                        if ($courses->course_level == 1) {
                                                            echo "Beginner  Level";
                                                        } elseif ($courses->course_level == 2) {
                                                            echo "Intermediate Level";
                                                        } elseif ($courses->course_level == 3) {
                                                            echo "Advanced Level";
                                                        }
                                                        ?>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="course-card__hints--icon me-3">
                                                            <svg id="document" xmlns="http://www.w3.org/2000/svg"
                                                                width="17.26" height="14.926"
                                                                viewBox="0 0 17.26 14.926">
                                                                <path id="Path_148" data-name="Path 148"
                                                                    d="M16.065,17.081H1.2a1.2,1.2,0,0,0-1.2,1.2V28.364a1.2,1.2,0,0,0,1.2,1.2h8.67l-.262,1.6a.69.69,0,0,0,1.041.75l1.871-.985a.393.393,0,0,1,.248,0l1.871.985a.834.834,0,0,0,.388.1.656.656,0,0,0,.387-.123.726.726,0,0,0,.266-.728l-.262-1.6h.651a1.2,1.2,0,0,0,1.2-1.2V18.277A1.2,1.2,0,0,0,16.065,17.081ZM12.64,27.511a2.084,2.084,0,1,1,2.084-2.084A2.086,2.086,0,0,1,12.64,27.511Zm.6,2.5a1.383,1.383,0,0,0-1.2,0l-1.323.7.42-2.565a3.1,3.1,0,0,0,3.007,0l.164,1v.005l.256,1.56Zm2.994-1.651a.173.173,0,0,1-.171.171h-.819l-.187-1.142s0-.009,0-.013a3.108,3.108,0,1,0-4.831,0l0,.013-.187,1.142H1.2a.173.173,0,0,1-.171-.171V18.277a.173.173,0,0,1,.171-.171H16.065a.173.173,0,0,1,.171.171Z"
                                                                    transform="translate(0 -17.081)" fill="#B5C5DB" />
                                                                <path id="Path_149" data-name="Path 149"
                                                                    d="M43.246,60.243H31.631a.512.512,0,0,0,0,1.025H43.246a.512.512,0,0,0,0-1.025Z"
                                                                    transform="translate(-28.993 -57.295)"
                                                                    fill="#B5C5DB" />
                                                                <path id="Path_150" data-name="Path 150"
                                                                    d="M36.55,100.911H31.631a.512.512,0,0,0,0,1.025H36.55a.512.512,0,0,0,0-1.025Z"
                                                                    transform="translate(-28.993 -95.184)"
                                                                    fill="#B5C5DB" />
                                                            </svg>
                                                        </div>
                                                        <div class="course-card__hints--text fs-12 fw-bold text-white">
                                                            <?php if ($courses->enterprise_name == 'Admin') {echo "Lead Academy";} else{echo $courses->enterprise_name . " " . "Academy";}?>

                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                    <!--End Course Hints-->
                                    <div
                                        class="align-items-center d-flex fs-12 justify-content-between pt-1 text-white w-100">
                                        <div class="d-flex align-items-center">
                                            <div class="course-card__hints--icon me-3">
                                                <svg id="clock_1_" data-name="clock (1)"
                                                    xmlns="http://www.w3.org/2000/svg" width="16.706" height="16.706"
                                                    viewBox="0 0 16.706 16.706">
                                                    <path id="Path_13" data-name="Path 13"
                                                        d="M8.353,0a8.353,8.353,0,1,0,8.353,8.353A8.363,8.363,0,0,0,8.353,0Zm0,15.662a7.309,7.309,0,1,1,7.309-7.309,7.317,7.317,0,0,1-7.309,7.309Z"
                                                        fill="#B5C5DB" />
                                                    <path id="Path_14" data-name="Path 14"
                                                        d="M208.838,83.118h-1.044v5.437l3.285,3.285.738-.738-2.979-2.979Z"
                                                        transform="translate(-199.963 -79.985)" fill="#B5C5DB" />
                                                </svg>
                                            </div>
                                            <div class="course-card__hints--text fs-12 fw-bold text-white">
                                                <?php
                                            $course_wise_lesson = $this->Course_model->course_wise_lesson($courses->course_id);
                                                    $seconds = 0;
                                                    foreach ($course_wise_lesson as $lesson) {
                                                        list($hour, $minute, $second) = explode(':', html_escape($lesson->duration));
                                                        $seconds += $hour * 3600;
                                                        $seconds += $minute * 60;
                                                        $seconds += $second;
                                                    }
                                                    $hours = floor($seconds / 3600);
                                                    $seconds -= $hours * 3600;
                                                    $minutes = floor($seconds / 60);
                                                    $seconds -= $minutes * 60;
                                                    // echo  "14 hrs 33 min"
                                                    echo ' ' . $hours . " hrs" . " " . $minutes . " min";
                                                    ?>
                                            </div>
                                        </div>
                                        <div class="course-like d-flex align-items-center">
                                            <i class="fas fa-graduation-cap fs-15 me-1 " style="color:#B5C5DB"></i>
                                            <div class="d-block">
                                                <div class="reviews fs-12 fw-bold text-white"><?php
                                                $studentCount = $this->db->where('product_id', $courses->course_id)->get('invoice_details')->num_rows();
                                                //echo  html_escape($studentCount?$studentCount:0)
                                                echo number_format($studentCount ? $studentCount : 0);
                                                ?>
                                                </div>
                                            </div>
                                        </div>

                                        <!--Start Star Rating-->
                                        <div class="star-rating__wrap d-flex align-items-center ">
                                            <i class="fas fa-star me-1 text-warning" style="color:#B5C5DB"></i>
                                            <div class="d-block">
                                                <div class="reviews fs-12 fw-bold text-white">
                                                    <?php echo average_ratings_number($courses->course_id, $enterprise_id); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End Course Card Body-->

                                <!--Start Course Card Hover Content-->
                                <?php if (!empty($courses->url)) { ?>
                                <div class="course-card__hover--content">
                                    <img src="<?php echo base_url(!empty($courses->hover_thumbnail) ? $courses->hover_thumbnail : default_600_400()); ?>"
                                        class="course-card__hover--content___img">
                                    <!--Start Video Icon With Popup Youtube-->
                                    <?php if ($courses->url) {?>

                                    <a class="course-card__hover--content___icon popup-youtube"
                                        href="<?php echo (!empty($courses->url) ? $courses->url : ''); ?>" autoplay>
                                        <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/Playicon.png'); ?>"
                                            class="img-fluid" alt="">
                                    </a>
                                    <?php }?>
                                    <!--End Video Icon With Popup Youtube-->

                                    <h3
                                        class="bottom-0 course-card__hover--content___text d-block fs-15 mb-0 position-absolute text-capitalize text-decoration-none text-white">
                                        <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses->course_id); ?>"
                                            class="text-decoration-none text-white"><?php echo (!empty($courses->name) ? $courses->name : ''); ?></a>
                                    </h3>
                                </div>
                                <?php } ?>
                                <!--End Card Hover Content-->
                            </div>

                            <?php  
                             $course_types = json_decode($courses->course_type); 
                             $checked_purchase = $this->db->where('customer_id',$user_id)->where('product_id', $courses->course_id)->where('status',1)->get('invoice_details')->row();
                            ?>
                            <div class="course-card_footer g-2 px-3 py-12">
                                  <?php 
                                  // check purchase or subscription 
                                  if($checked_purchase){?>
                                    <div class="d-block">
                                        <div class="align-items-center d-flex form-check ps-0">
                                            <input class="me-1" style="width:21px;height:21px" type="radio"
                                                name=""
                                                id=""
                                                onclick=""
                                                disabled>
                                            <label class="form-check-label fw-bold opa-half course_price_cart"
                                                for="flexRadioDefault1">
                                                Subscription
                                            </label>
                                        </div>
                                        <div class="align-items-center d-flex form-check ps-0">
                                            <input class="me-1" style="width:21px;height:21px" type="radio"
                                                name=""
                                                id=""
                                                onclick=""
                                                disabled>
                                                <label class="align-items-center d-flex form-check-label fw-bold justify-content-between" style="width:100%;"
                                                    for="flexRadioDefault2_<?php echo $courses->course_id?>">
                                                    <span class="course_price_cart">Course Price
                                                        <span class="text-success">
                                                        </span>
                                                    </span>
                                                    <span class="align-items-center d-flex  rounded text-center">
                                                        <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                            <?php echo (($courses->is_offer == 1) ? number_format($courses->offer_courseprice) : number_format($courses->price)); ?></span>
                                                        <?php if(!empty($courses->is_discount==1)){?>
                                                        <del
                                                            class="fs-12 fw-bold text-muted2"><?php echo (($courses->oldprice)?number_format($courses->oldprice) :" "); ?></del>
                                                        <?php }?>
                                                    </span>
                                                </label>
                                            <!-- <span class="badge bg-success me-1 float-end ms-auto">  </span> -->
                                        </div>
                                        <div class="d-flex justify-content-between align-items-stretch mt-2">
                                            <div class="flex-grow-1 me-2 w-sub">
                                                <a href="javascript:void(0)"
                                                    class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                    <span class="shopping me-1 shopping_icon position-relative">
                                                        <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                            style="width: 14px;">
                                                    </span>
                                                    <span class="text-center w-100 fw-bold fs-13">Enrolled</span>
                                                </a>
                                            </div>
                                            <div class="flex-grow-1">
                                                <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $courses->course_id); ?>"
                                                    class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                    <span class="shopping me-1 shopping_icon position-relative">
                                                        <img class="me-1"
                                                            src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                            style="width: 14px;">
                                                    </span>
                                                    <span class="text-center w-100 fw-bold fs-13">Details</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php }else{?>
                                <div class="d-block">
                                    <?php if (in_array("1", $course_types) && in_array("2", $course_types)) {?>
                                    <input type="hidden" class="course" value="<?php echo $courses->course_id; ?>"
                                        id="<?php echo $courses->course_id; ?>">
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <!-- <input class="form-check-input" type="radio" name="flexRadioDefault1_<?php echo $courses->course_id ?>" id="flexRadioDefault1_<?php echo $courses->course_id ?>"  onclick="subscriptionchecedRadio('<?php echo $courses->course_id; ?>')" > -->
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault1_<?php echo $courses->course_id ?>"
                                            id="flexRadioDefault1_<?php echo $courses->course_id ?>"
                                            onclick="subscriptionchecedRadio('<?php echo $courses->course_id; ?>')">
                                        <label class="form-check-label fw-bold course_price_cart "
                                            for="flexRadioDefault1_<?php echo $courses->course_id ?>">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="form-check d-flex align-items-center ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault2_<?php echo $courses->course_id ?>"
                                            id="flexRadioDefault2_<?php echo $courses->course_id ?>"
                                            onclick="coursechecedRadio('<?php echo $courses->course_id; ?>')" checked>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                            style="width:100%;"
                                            for="flexRadioDefault2_<?php echo $courses->course_id ?>">
                                            <span class="course_price_cart">Course Price
                                                <span class="text-success">
                                                </span>
                                            </span>
                                            <span class="align-items-center d-flex  rounded text-center">
                                                <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                    <?php echo (($courses->is_offer == 1) ? number_format($courses->offer_courseprice) : number_format($courses->price)); ?></span>
                                                <?php if (!empty($courses->is_discount == 1)) {?>
                                                <del
                                                    class="fs-12 fw-bold text-muted2"><?php echo (($courses->oldprice) ? number_format($courses->oldprice) : " "); ?></del>
                                                <?php }?>

                                            </span>
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2"
                                        id="course_purchase_<?php echo $courses->course_id ?>">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13"> Purchase
                                                </span>

                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img class="me-1"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Details</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2"
                                        id="course_subscription_<?php echo $courses->course_id ?>">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php if ($user_type != 5){ echo base_url($enterprise_shortname . '/subscription-details');}else{ echo base_url($enterprise_shortname . '/course-details/' . $courses->course_id);} ?>"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13"> Subscription
                                                </span>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img class="me-1"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Details</span>

                                            </a>
                                        </div>
                                    </div>
                                    <?php } elseif (in_array("3", $course_types) && in_array("4", $course_types)) {?>
                                    <?php } elseif (in_array("1", $course_types)) {?>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault1_<?php echo $courses->course_id ?>"
                                            id="flexRadioDefault1_<?php echo $courses->course_id ?>"
                                            onclick="subscriptionchecedRadio('<?php echo $courses->course_id; ?>')"
                                            disabled>
                                        <label class="form-check-label fw-bold opa-half course_price_cart"
                                            for="flexRadioDefault1">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="form-check d-flex align-items-center ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault2_<?php echo $courses->course_id ?>"
                                            id="flexRadioDefault2_<?php echo $courses->course_id ?>"
                                            onclick="coursechecedRadio('<?php echo $courses->course_id; ?>')" checked>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                            style="width:100%"
                                            for="flexRadioDefault2_<?php echo $courses->course_id ?>">
                                            <span class="course_price_cart">Course Price <span
                                                    class="text-success"></span>
                                            </span>
                                            <span class="align-items-center d-flex  rounded text-center">
                                                <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                    <?php echo (($courses->is_offer == 1) ? number_format($courses->offer_courseprice) : number_format($courses->price)); ?></span>
                                                <?php if (!empty($courses->is_discount == 1)) {?>
                                                <del
                                                    class="fs-12 fw-bold text-muted2"><?php echo (($courses->oldprice) ? number_format($courses->oldprice) : " "); ?></del>
                                                <?php }?>
                                            </span>

                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13"> Purchase
                                                </span>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img class="me-1"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Details</span>
                                            </a>
                                        </div>
                                    </div>
                                    <?php } elseif (in_array("2", $course_types)) {?>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault1_<?php echo $courses->course_id ?>"
                                            id="flexRadioDefault1_<?php echo $courses->course_id ?>"
                                            onclick="subscriptionchecedRadio('<?php echo $courses->course_id; ?>')"
                                            checked>
                                        <label class="form-check-label fw-bold course_price_cart"
                                            for="flexRadioDefault1_<?php echo $courses->course_id ?>">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="form-check d-flex align-items-center ps-0 ">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault2_<?php echo $courses->course_id ?>"
                                            id="flexRadioDefault2_<?php echo $courses->course_id ?>"
                                            onclick="coursechecedRadio('<?php echo $courses->course_id; ?>')" disabled>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between opa-half"
                                            style="width: calc(100% - 25px);" for="flexRadioDefault2">
                                            <span class="course_price_cart">Course Price <span
                                                    class="text-success"></span></span>
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php if ($user_type != 5){ echo base_url($enterprise_shortname . '/subscription-details');}else{ echo base_url($enterprise_shortname . '/course-details/' . $courses->course_id);} ?>"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13"> Subscription
                                                </span>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img class="me-1"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Details</span>
                                            </a>
                                        </div>
                                    </div>
                                    <?php } elseif (in_array("3", $course_types)) {?>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault1_<?php echo $courses->course_id ?>"
                                            id="flexRadioDefault1_<?php echo $courses->course_id ?>"
                                            onclick="subscriptionchecedRadio('<?php echo $courses->course_id; ?>')"
                                            disabled>
                                        <label class="form-check-label fw-bold opa-half course_price_cart"
                                            for="flexRadioDefault1">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault2_<?php echo $courses->course_id ?>"
                                            id="flexRadioDefault2_<?php echo $courses->course_id ?>"
                                            onclick="coursechecedRadio('<?php echo $courses->course_id; ?>')" disabled>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between opa-half"
                                            style="width: calc(100% - 25px);" for="flexRadioDefault2">
                                            <span class="course_price_cart">Course Price </span>
                                            <span class="d-flex px-2 rounded text-center">
                                                <span class="d-block fs-12 fw-bold me-2 text-success">
                                                    <!-- Free -->
                                                </span>
                                            </span>
                                        </label>
                                        <span class="badge bg-success me-1 float-end ms-auto"> Free</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13"> Enroll Free </span>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img class="me-1"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Details</span>
                                            </a>
                                        </div>
                                    </div>

                                    <?php } elseif (in_array("4", $course_types)) {?>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault1_<?php echo $courses->course_id ?>"
                                            id="flexRadioDefault1_<?php echo $courses->course_id ?>"
                                            onclick="subscriptionchecedRadio('<?php echo $courses->course_id; ?>')"
                                            disabled>
                                        <label class="form-check-label fw-bold opa-half course_price_cart"
                                            for="flexRadioDefault1">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault2_<?php echo $courses->course_id ?>"
                                            id="flexRadioDefault2_<?php echo $courses->course_id ?>"
                                            onclick="coursechecedRadio('<?php echo $courses->course_id; ?>')" disabled>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between opa-half"
                                            for="flexRadioDefault2_<?php echo $courses->course_id ?>">
                                            <span class="course_price_cart">Course Price</span>
                                            <span class="bg-danger d-flex px-2 rounded text-center text-white">
                                                <!-- Govt -->
                                            </span>
                                        </label>
                                        <span class="badge bg-success me-1 float-end ms-auto"> Govt</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13"> Govt </span>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses->course_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img class="me-1"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13">Details</span>
                                            </a>
                                        </div>
                                    </div>
                                    <?php } else {?>
                                    No Allow this type
                                    <?php }?>
                                </div>
                                <?php } ?>

                            </div>

           

                            <!--End Course Card-->


                            <!--End Course Card-->
                        </div>
                    </div>
                    <?php
                        }
                    }
            
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>
<!--End Popular Course-->
<script type="text/javascript">
// ================= its for instructor_profileupload  ================
("use strict");

function instructor_profileupload(value) {
    var enterprise_id = $("#enterprise_id").val();

    var path = value.value;
    var extenstion = path.split(".").pop();
    if (
        extenstion == "jpg" ||
        extenstion == "svg" ||
        extenstion == "jpeg" ||
        extenstion == "png" ||
        extenstion == "gif"
    ) {
        // document.getElementById('image-preview').src = window.URL.createObjectURL(value.files[0]);
        var filename = path
            .replace(/^.*[\\\/]/, "")
            .split(".")
            .slice(0, -1)
            .join(".");
        // alert(filename);
        // document.getElementById("filename").innerHTML = filename;
        var fd = new FormData();
        var csrf_test_name = $('[name="csrf_test_name"]').val();
        var base_url = "<?php echo base_url(($enterprise_shortname ? $enterprise_shortname : 'admin')) ?>";
        fd.append("profilepic", $("#profilepic")[0].files[0]);
        fd.append("enterprise_id", enterprise_id);
        fd.append("csrf_test_name", csrf_test_name);
        $.ajax({
            url: base_url + "/instructor-profile-picture-update",
            type: "POST",
            data: fd,
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            success: function(r) {
                toastrSuccessMsg(r);
            },
        });
    } else {
        alert(
            "File not supported. Kindly Upload the Image of below given extension "
        );
    }
}
// ================= its for instructor_profileupload  ================
("use strict");

function studentcoverpictureupload(value) {
    var enterprise_id = $("#enterprise_id").val();
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = "<?php echo base_url(($enterprise_shortname ? $enterprise_shortname : 'admin')) ?>";
    var path = value.value;
    var extenstion = path.split(".").pop();
    if (
        extenstion == "jpg" ||
        extenstion == "svg" ||
        extenstion == "jpeg" ||
        extenstion == "png" ||
        extenstion == "gif"
    ) {
        // document.getElementById('image-preview').src = window.URL.createObjectURL(value.files[0]);
        var filename = path
            .replace(/^.*[\\\/]/, "")
            .split(".")
            .slice(0, -1)
            .join(".");
        // alert(filename);
        // document.getElementById("filename").innerHTML = filename;
        var fd = new FormData();
        fd.append("coverpicture", $("#coverpicture")[0].files[0]);
        fd.append("enterprise_id", enterprise_id);
        fd.append("csrf_test_name", csrf_test_name);
        $.ajax({
            url: base_url + "/instructor-cover-picture-update",
            type: "POST",
            data: fd,
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            success: function(r) {
                toastrSuccessMsg(r);
            },
        });
    } else {
        alert(
            "File not supported. Kindly Upload the Image of below given extension "
        );
    }
}

("use strict");

function toastrSuccessMsg(r) {
    setTimeout(function() {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: "slideDown",
            timeOut: 1500,
            onHidden: function() {
                window.location.reload();
            },
        };
        toastr.success(r);
    }, 1000);
}

"use sctrict";

function typewiseproject(type, mode) {
    var base_url = $("#base_url").val();
    var enterprise_shortname = $("#enterprise_shortname").val();
    var enterprise_id = $("#enterprise_id").val();
    var CSRF_TOKEN = $("#CSRF_TOKEN").val();
    $.ajax({
        url: base_url + enterprise_shortname + "/type-wise-instructor-project-load",
        type: "POST",
        data: {
            csrf_test_name: CSRF_TOKEN,
            type: type,
            mode: mode,
            enterprise_id: enterprise_id,
            enterprise_shortname: enterprise_shortname,
        },
        success: function(r) {
            // setTimeout(function() { 
            $(".load-project").html(r);
            // }, 1000);
            //Feather Icon
            feather.replace();
        },
    });
}
</script>