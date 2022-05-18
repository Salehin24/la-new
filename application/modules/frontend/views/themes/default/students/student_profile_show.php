<style>
.nav-pills .nav-link.active,
.nav-pills .show>.nav-link {
    background-color: #07477d;
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
  $user_id = $this->session->userdata('user_id');
  $user_type = $this->session->userdata('user_type');
//   d($user_id);
//   dd($user_type);
?>


<!--Student Profile Edit Option-->
<!--Start About Myself-->
<?php 
//if($get_studentinfo->is_profileshow == 1){ ?>

<!-- py-3 -->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm mt-4">
            <div class="card-body p-4 p-xl-5">
                <div class="mb-3">
                    <h4 class="fw-bold mb-1">
                        <?php echo (!empty($get_studentinfo->name) ? $get_studentinfo->name : ''); ?></h4>
                    <div>
                        <?php //echo (!empty($get_studentinfo->designation) ? $get_studentinfo->designation : ''); ?>
                    </div>
                </div>
                <?php if($get_studentinfo->is_biographyshow == 1){ ?>
                <p class="text-justify">
                    <?php echo (!empty($get_studentinfo->biography) ? $get_studentinfo->biography : ''); ?></p>
                <?php } ?>
                <!-- <div class="mt-3">
                    <h6 class="mb-1">Website</h6>
                    <a
                        href="javascript:void(0)"><?php echo (!empty($get_studentinfo->website) ? $get_studentinfo->website : ''); ?></a>
                </div> -->
            </div>
        </div>
    </div>
</div>
<?php //} ?>
<!--End About Myself-->

<!--Start Resume/Portfolio PDF download-->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <?php 
        $resume = get_studentinfo($student_id)->resume;
        if(get_studentinfo($student_id)->is_resumeshow == 1){
            if($resume){ ?>
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5 d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold font-letter-spacing-1">Resume/Portfolio PDF</h4>
                <a href="<?php echo (!empty($resume) ? base_url($resume) : 'javascript:void(0)'); ?>"
                    class="download-icon ms-2" download>
                    <svg id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512"
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
    } ?>
    </div>
</div>
<!--End Resume/Portfolio PDF download-->
<!--Start Personal Skills-->
<?php 
$skills = $get_studentinfo->skills;
if($get_studentinfo->is_skillshow == 1){
    if($skills){   ?>
<div class="bg-alice-blue py-3">
    <div class="container-lg">
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
                    $explodeskills = explode(',', $skills);
                foreach($explodeskills as $skill){ ?>
                <span class="d-inline-block border fs-6 px-4 py-2 rounded me-2 mb-2"><?php echo $skill; ?></span>
                <?php } ?>
                <!--End Skills-->
            </div>
        </div>
    </div>
</div>
<?php } } ?>
<!--End Personal Skills-->
<!--Start Professional Proficiency-->
<?php if($get_studentinfo->is_proficiencyshow == 1){
    if($get_studentproficiency){ ?>
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <div class="d-sm-flex justify-content-between mb-4">
                    <!--Start Section Header-->
                    <div class="section-header mb-3 mb-sm-0">
                        <h4 class="text-uppercase fw-bold">Professional Proficiency</h4>
                        <div class="section-header_divider"></div>
                    </div>
                </div>
                <div class="row g-3">
                    <?php foreach($get_studentproficiency as $proficiency){ ?>
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
    </div>
</div>
<?php } 
}
 ?>
<!--End Professional Proficiency-->
<!--Start Featured Work-->
<?php if($get_studentinfo->is_featureshow == 1){ ?>
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
                    <!-- <div><button type="button" class="btn btn-dark-cerulean">+&nbsp;Add New Project</button></div> -->
                </div>
                <div class="position-relative">
                    <!--Nav Pills-->
                    <ul class="nav nav-pills mb-3 assignment_nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="featured_work_color fw-semi-bold nav-link active" id="pills-one-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-one" type="button" role="tab"
                                aria-controls="pills-one" aria-selected="true"
                                onclick="typewiseprojectpublic('0', 'view')">All</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="featured_work_color fw-semi-bold nav-link" id="pills-two-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-two" type="button" role="tab"
                                aria-controls="pills-two" aria-selected="false"
                                onclick="typewiseprojectpublic('1', 'view')">Course
                                Project</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="featured_work_color fw-semi-bold nav-link" id="pills-five-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-five" type="button" role="tab"
                                aria-controls="pills-five" aria-selected="false"
                                onclick="typewiseprojectpublic('4', 'view')">Client Project</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="featured_work_color fw-semi-bold nav-link" id="pills-three-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-three" type="button" role="tab"
                                aria-controls="pills-three" aria-selected="false"
                                onclick="typewiseprojectpublic('2', 'view')">Personal Project</button>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
                            <button class="featured_work_color fw-semi-bold nav-link" id="pills-four-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-four" type="button" role="tab"
                                aria-controls="pills-four" aria-selected="false"
                                onclick="typewiseprojectpublic('3', 'view')">Practice
                                Project</button>
                        </li> -->
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-one" role="tabpanel"
                            aria-labelledby="pills-one-tab">
                            <div class="project-carousel owl-carousel owl-theme">
                                <!--Start Project Card-->
                                <?php if($get_featuredprojectportfolio){ ?>
                                <?php foreach($get_featuredprojectportfolio as $project){ ?>
                                <div class="project-card">
                                    <div class="project-card_img position-relative overflow-hidden rounded">
                                        <img src="<?php echo base_url((!empty($project->coverpic) ? $project->coverpic : default_600_400())); ?>"
                                            alt="" class="img-fluid">
                                        <div
                                            class="featured-opacity  bottom-0 d-flex end-0 flex-wrap h-100 <?php if($project->publish_status==0){ echo "justify-content-center";}else{ echo "align-items-center";}?> p-3 position-absolute project-card_overlay start-0 top-0">
                                            <div class="w-100">

                                                <?php if($project->project_type==1){?>
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
                                                    <div class="fs-13 ms-2">
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
                                            <div class="project-card_icon text-white w-100">
                                                <div class="mb-1 fs-13"><i data-feather="heart" class="me-1"></i>26
                                                </div>
                                                <div class="mb-1 fs-13"><i data-feather="message-circle"
                                                        class="me-1"></i>1</div>
                                                <div class="mb-1 fs-13"><i data-feather="eye" class="me-1"></i>225</div>
                                            </div>
                                        </div> -->
                                    </div>
                                    <h6 class="project-card-title mb-0 mt-2 text-truncate">
                                        <?php if(get_usertype() == 4){?>
                                        <a class="text-dark fs-15"
                                            href="<?php echo base_url($enterprise_shortname . '/student-project-view/'. $project->project_id); ?>">
                                            <?php echo (!empty($project->title) ? $project->title : ''); ?>
                                        </a>
                                        <?php }else{ ?>
                                        <a class="text-dark fs-15"
                                            href="<?php echo base_url($enterprise_shortname . '/student-project-publicview/'. $project->project_id); ?>">
                                            <?php echo (!empty($project->title) ? $project->title : ''); ?>
                                        </a>
                                        <?php } ?>
                                    </h6>
                                    <!--Start Action Button-->
                                    <div class="action-btn align-items-center d-flex mt-3">
                                        <!-- <a href="<?php echo base_url($enterprise_shortname . '/student-project-edit/'. $project->project_id); ?>"
                                            class="me-2 text-dark"><i data-feather="edit-3"
                                                class="me-1"></i><span>Edit</span></a>
                                        <a href="javascript:void(0)" class="me-2 text-danger" onclick="studentprojectdelete('<?php echo $project->project_id; ?>')"><i data-feather="trash-2"
                                                class="me-1"></i><span>Delete</span></a> -->
                                    </div>
                                    <!--End Action Button-->
                                </div>
                                <?php } ?>
                                <?php }else{ ?>
                                <p>Record not found!</p>
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
<?php } ?>
<!--End Featured Work-->
<!--Start Experience-->
<?php if($get_studentinfo->is_experienceshow == 1){
    if($get_userexperience){ ?>
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <!--Start Section Header-->
                <div class="section-header mb-4">
                    <h4 class="text-uppercase fw-bold">Experience</h4>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
                <?php foreach($get_userexperience as $experience){ ?>
                <div class="align-items-center d-sm-flex justify-content-between mb-5">
                    <div>
                        <h4 class="mb-1 fw-semi-bold fs-20">
                            <?php echo (!empty($experience->title) ? $experience->title : ''); ?>
                            at
                            <?php echo (!empty($experience->companyname) ? $experience->companyname : ''); ?>
                        </h4>
                        <div class="hash-color fw-bold fs-16">
                            <?php echo (!empty($experience->city) ? $experience->city. ', ' : ''); ?>
                            <?php echo (!empty($experience->country) ? $experience->country : ''); ?>
                        </div>
                    </div>
                    <div class="d-block text-end">
                        <!--Start Action Button-->
                        <div class="action-btn align-items-center justify-content-end d-flex mb-2">
                            <!-- <a href="javascript:void(0)"
                                onclick="studentexperience_edit('<?php //echo $experience->id; ?>')"
                                class="me-2 text-dark"><i data-feather="edit-3" class="me-1"></i><span>Edit</span></a>
                            <a href="javascript:void(0)"
                                onclick="studentexperience_delete('<?php //echo $experience->id; ?>')"
                                class="me-2 text-danger"><i data-feather="trash-2"
                                    class="me-1"></i><span>Delete</span></a> -->
                        </div>
                        <!--End Action Button-->
                        <div
                            class="fs-16 fw-semi-bold ms-sm-2 mt-2 mt-sm-0 px-4 py-2 rounded site-fc text-nowrap experience-time-box">
                            <?php echo (!empty($experience->frommonth) ? $experience->frommonth : ''); ?>
                            <?php echo (!empty($experience->fromyear) ? $experience->fromyear : ''); ?> -
                            <?php
                            if($experience->is_now == 1){
                                echo 'Present';
                            }else{
                                echo (!empty($experience->tomonth) ? $experience->tomonth : ''). ' ';
                                echo (!empty($experience->toyear) ? $experience->toyear : '');
                            }
                            ?>
                        </div>
                    </div>

                </div>
                <hr>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php } 
}
 ?>
<!--End Experience-->
<!--Start Education-->
<?php if($get_studentinfo->is_educationshow == 1){
    if($get_usereducation){ ?>
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <!--Start Section Header-->
                <div class="section-header mb-4">
                    <h4 class="text-uppercase fw-bold">Education</h4>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
                <div class="row g-3">
                    <?php foreach($get_usereducation as $education){ ?>
                    <div class="col-md-6 col-xl-4">
                        <!--End Action Button-->
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
    </div>
</div>
<?php }
} ?>
<!--End Education-->
<!--Start Certificates-->
<?php if($get_studentinfo->is_certificateshow == 1){
    if($get_usermappingcertificate){ ?>
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <!--Start Section Header-->
                <div class="section-header mb-4">
                    <h4 class="text-uppercase fw-bold">Certificates</h4>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
                <!--Start Certificate Carousel-->
                <div class="certificate-carousel owl-carousel owl-theme">
                    <!--Start Certificate Card-->
                    <?php 
                        foreach($get_usermappingcertificate as $certificate){
                        ?>
                    <div class="card">
                        <div class="card-body p-4">
                            <div
                                class="text-center text-md-start d-sm-flex align-items-sm-center justify-content-sm-between mb-3">
                                <h5 class="text-capitalize mb-0">Successfully Completed</h5>
                                <a href="<?php echo base_url($enterprise_shortname.'/download-certificate/'.$certificate->id); ?>"
                                    target="_new" class="btn btn-dark-cerulean btn-sm mt-2 mt-sm-0 text-nowrap"><i
                                        data-feather="download" class="me-2"></i>Download</a>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="badge-icon">
                                        <svg id="Capa_1" enable-background="new 0 0 512 512" height="512"
                                            viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <g>
                                                    <path
                                                        d="m452.42 210.226c10.146-15.543 8.272-35.766-4.557-49.18-5.654-5.912-8.017-14.218-6.323-22.22 3.847-18.159-5.206-36.34-22.015-44.213-7.408-3.47-12.612-10.362-13.923-18.436-2.973-18.322-17.983-32.005-36.5-33.275-8.161-.56-15.504-5.106-19.643-12.162-9.392-16.009-28.326-23.346-46.056-17.842-7.812 2.426-16.3.838-22.709-4.245-14.541-11.536-34.85-11.536-49.39 0-6.408 5.085-14.898 6.671-22.709 4.245-17.726-5.505-36.665 1.832-46.056 17.842-4.139 7.056-11.481 11.602-19.642 12.162-18.518 1.27-33.527 14.954-36.501 33.275-1.31 8.074-6.515 14.966-13.922 18.436-16.808 7.874-25.861 26.055-22.016 44.213 1.695 8.002-.669 16.309-6.322 22.221-12.828 13.414-14.703 33.638-4.557 49.181 4.471 6.849 5.268 15.449 2.131 23.004-7.117 17.142-1.558 36.677 13.516 47.505 6.644 4.773 10.493 12.504 10.297 20.681-.443 18.555 11.797 34.763 29.765 39.415 5.304 1.373 9.912 4.442 13.214 8.628l-41.324 99.763c-5.791 13.981 7.316 28.378 21.769 23.941l45.242-13.884c1.322-.403 2.748.188 3.395 1.407l22.173 41.808c7.093 13.374 26.538 12.43 32.322-1.535l43.071-103.981c.565-.019 1.13-.019 1.695 0l43.071 103.981c5.795 13.987 25.239 14.89 32.323 1.536l22.173-41.809c.646-1.22 2.073-1.811 3.395-1.406l45.241 13.884c14.461 4.439 27.558-9.968 21.77-23.941l-41.325-99.763c3.302-4.186 7.91-7.255 13.214-8.628 17.968-4.651 30.207-20.859 29.765-39.415-.196-8.177 3.654-15.908 10.298-20.68 15.075-10.829 20.632-30.364 13.515-47.506-3.132-7.558-2.335-16.158 2.135-23.007zm-254.196 284.993c-.941 2.272-4.067 2.411-5.214.248l-22.173-41.808c-4.011-7.563-12.862-11.227-21.045-8.717l-45.242 13.884c-2.347.718-4.452-1.594-3.512-3.863l36.662-88.513c8.272 11.331 22.1 17.646 36.657 15.946 8.124-.947 16.177 2.171 21.542 8.345 7.783 8.96 18.75 13.716 29.939 13.715 3.539 0 7.099-.495 10.589-1.464zm209.227-36.394-45.241-13.884c-8.183-2.51-17.036 1.155-21.046 8.717l-22.173 41.808c-1.145 2.161-4.275 2.021-5.215-.248l-38.195-92.209c14.519 4.03 30.278-.48 40.521-12.27 5.364-6.175 13.414-9.295 21.542-8.345 14.571 1.703 28.39-4.614 36.657-15.945l36.664 88.51c.942 2.278-1.175 4.581-3.514 3.866zm32.41-256.797c-7.182 11.003-8.462 24.817-3.424 36.953 4.43 10.671.971 22.831-8.414 29.573-10.672 7.666-16.856 20.085-16.542 33.22.276 11.552-7.344 21.642-18.53 24.537-10.463 2.709-19.249 9.519-24.518 18.728-.014.027-.029.053-.043.079-1.117 1.963-2.085 4.029-2.864 6.194-3.915 10.871-14.658 17.533-26.141 16.187-13.049-1.526-25.988 3.487-34.605 13.406-7.577 8.722-20.006 11.045-30.224 5.65-3.475-1.836-7.155-3.11-10.913-3.847-.031-.007-.062-.014-.093-.02-4.992-.967-10.122-.966-15.114.004-.018.004-.035.008-.053.011-3.767.737-7.454 2.013-10.937 3.852-10.218 5.396-22.646 3.072-30.223-5.65-7.598-8.745-18.551-13.675-29.982-13.675-1.534 0-3.079.089-4.624.27-11.472 1.343-22.227-5.315-26.142-16.187-.779-2.163-1.745-4.226-2.861-6.188-.017-.032-.034-.062-.051-.094-5.27-9.205-14.053-16.012-24.513-18.72-11.186-2.896-18.805-12.985-18.529-24.536.314-13.136-5.87-25.554-16.542-33.221-9.384-6.741-12.845-18.902-8.414-29.574 5.038-12.136 3.758-25.95-3.424-36.953-6.315-9.675-5.149-22.265 2.838-30.615 9.081-9.496 12.878-22.84 10.156-35.694-2.394-11.304 3.242-22.622 13.705-27.524 11.899-5.574 20.259-16.645 22.365-29.615 1.851-11.406 11.195-19.924 22.722-20.714 13.109-.899 24.905-8.202 31.553-19.537 5.847-9.966 17.639-14.532 28.67-11.106 12.549 3.897 26.186 1.348 36.48-6.819 9.05-7.182 21.694-7.182 30.747 0 10.293 8.166 23.928 10.717 36.479 6.819 11.035-3.427 22.825 1.141 28.67 11.106 6.648 11.334 18.444 18.637 31.553 19.537 11.527.791 20.871 9.309 22.722 20.714 2.106 12.97 10.467 24.041 22.365 29.616 10.464 4.901 16.099 16.219 13.705 27.523-2.722 12.854 1.074 26.198 10.156 35.694 7.983 8.35 9.149 20.94 2.834 30.616z" />
                                                    <path
                                                        d="m113.951 192.129c4.107.505 7.854-2.417 8.359-6.527 8.282-67.315 65.757-118.076 133.69-118.076 67.966 0 125.443 50.788 133.698 118.139.466 3.801 3.7 6.588 7.434 6.588.305 0 .612-.019.922-.057 4.111-.504 7.035-4.245 6.532-8.356-9.176-74.861-73.054-131.313-148.586-131.313-75.497 0-139.371 56.422-148.577 131.243-.505 4.111 2.417 7.853 6.528 8.359z" />
                                                    <path
                                                        d="m398.055 212.26c-4.099-.5-7.852 2.421-8.356 6.532-8.252 67.354-65.73 118.145-133.699 118.145-67.938 0-125.413-50.766-133.692-118.086-.505-4.11-4.245-7.031-8.359-6.528-4.11.505-7.034 4.248-6.528 8.359 9.202 74.827 73.076 131.253 148.578 131.253 75.536 0 139.414-56.455 148.586-131.32.505-4.11-2.419-7.851-6.53-8.355z" />
                                                    <path
                                                        d="m361.899 171.281c-1.906-5.866-7.12-9.8-13.285-10.021l-58.801-2.109-20.177-55.272c-2.115-5.794-7.467-9.538-13.635-9.538s-11.52 3.744-13.635 9.538l-20.177 55.272-58.801 2.109c-6.164.221-11.379 4.155-13.285 10.021s0 12.114 4.857 15.916l46.331 36.269-16.164 56.576c-1.695 5.931.435 12.106 5.426 15.732 4.985 3.622 11.516 3.746 16.637.298l48.81-32.857 48.811 32.855c5.115 3.444 11.646 3.328 16.637-.298 4.991-3.625 7.12-9.8 5.425-15.732l-16.164-56.575 46.331-36.269c4.858-3.802 6.765-10.049 4.859-15.915zm-60.69 40.574c-4.675 3.66-6.642 9.713-5.01 15.419l15.89 55.615-47.982-32.297c-2.463-1.658-5.285-2.487-8.107-2.487s-5.644.829-8.106 2.486l-47.983 32.297 15.89-55.614c1.631-5.708-.335-11.759-5.009-15.419l-45.546-35.654 57.805-2.074c5.932-.213 11.08-3.954 13.115-9.529l19.835-54.334 19.835 54.334c2.036 5.575 7.183 9.316 13.115 9.528l57.803 2.074z" />
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="text-capitalize mb-1">
                                        <?php echo (!empty($certificate->title) ? $certificate->title : ''); ?></h5>
                                    <div class="fw-medium text-muted">
                                        <?php echo date('F Y', strtotime($certificate->created_date)); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <!--End Certificate Card-->

                </div>
                <!--End Certificate Carousel-->
            </div>
        </div>
    </div>
</div>
<?php } 
}
?>
<!--End Certificates-->
<!--Start Hiring Information-->
<?php if($get_studentinfo->is_hiringshow == 1){
    if($get_studentinfo->hiring_title){
    ?>
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <!--Start Section Header-->
                <div class="section-header mb-4">
                    <h4 class="text-uppercase fw-bold">Hiring Information</h4>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
                <div class="text-center">
                    <h6 class="fs-4 fw-semi-bold text-navy-blue">I am interested to work as a</h6>
                    <h3 class="mb-0 fw-semi-bold" style="font-size:23px">
                        <?php echo (!empty($get_studentinfo->hiring_title) ? $get_studentinfo->hiring_title : ''); ?>
                    </h3>
                    <!-- <h3 class="mb-0">Concept Arts, Illustrator, Art Director</h3> -->
                    <hr class="my-4">
                    <div class="btn-group-m">
                        <?php 
                            $explode_hiringtypes = explode(",", $get_studentinfo->hiring_type);
                            foreach($explode_hiringtypes as $type){
                        ?>
                        <button type="button" class="btn  hiring-btn">
                            <?php
                             if($type == 1){
                                echo "Full Time";
                            }elseif($type == 2){
                                echo 'Part Time';
                            }elseif($type == 3){
                                echo 'Contract';
                            }elseif($type == 4){
                                echo 'Freelance';
                            }elseif($type == 5){
                                echo 'Self Employed';
                            }elseif($type == 6){
                                echo 'Internship';
                            }elseif($type == 7){
                                echo 'Seasonal';
                            }elseif($type == 8){
                                echo 'Apprenticeship';
                            }
                             ?>
                        </button>
                        <?php } ?>
                        <!-- <button type="button" class="btn btn-outline-dark-cerulean">Part-time</button>
                        <button type="button" class="btn btn-outline-dark-cerulean">Contract</button>
                        <button type="button" class="btn btn-outline-dark-cerulean">Freelance</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
}
}
 ?>
<!--End Hiring Information-->
<!--Start Contact-->
<?php if($get_studentinfo->is_contactshow == 1){
    if($get_studentinfo->contacttitle || $get_studentinfo->public_email){ ?>
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <!--Start Section Header-->
                <div class="section-header mb-4">
                    <h4 class="text-uppercase fw-bold">Contact</h4>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
                <div class="text-center">
                    <?php if($get_studentinfo->is_contacttitle == 1){ ?>
                    <!-- <h6 class="text-navy-blue">Have any projects in mind? <span class="text-danger">Say hello At</span></h6> -->
                    <h6 class="text-navy-blue">
                        <?php echo (!empty($get_studentinfo->contacttitle) ? $get_studentinfo->contacttitle : ''); ?>
                    </h6>
                    <?php } ?>
                    <a href="mailto:webmaster@example.com" class="fs-3 fw-semi-bold"
                        style="color:#063f80;font-size:23px"
                        s><?php echo (!empty($get_studentinfo->public_email) ? $get_studentinfo->public_email : ''); ?></a>
                    <?php 
                        $this->db->select('*');
                        $this->db->from('social_links');
                        $this->db->where('user_id', $get_studentinfo->student_id);
                        $this->db->order_by('id', 'asc');
                        $student_sociallinks = $this->db->get()->result();
                        ?>
                    <!--Start Social Share Icon-->
                    <div class="social-share_icon mt-3 fs-2">
                        <?php foreach($student_sociallinks as $sociallink){
                               if($sociallink->link_type == 1){
                                $link = '<i class="fab fa-facebook text-blue"></i>';
                               }elseif($sociallink->link_type == 2){
                                $link = '<i class="fab fa-twitter text-blue"></i>';
                               }elseif($sociallink->link_type == 3){
                                $link = '<i class="fab fa-linkedin text-blue"></i>';
                               }elseif($sociallink->link_type == 4){
                                $link = '<i class="fab fa-instagram text-blue"></i>';
                               }elseif($sociallink->link_type == 5){
                                $link = '<i class="fab fa-github text-blue"></i>';
                               }elseif($sociallink->link_type == 6){
                                $link = '<i class="fab fa-youtube text-blue"></i>';
                               }elseif($sociallink->link_type == 7){
                                $link = '<i class="fab fa-vimeo text-blue"></i>';
                               }elseif($sociallink->link_type == 8){
                                $link = '<i class="fas fa-globe text-blue"></i>';
                               }
                            ?>
                        <a href="<?php echo (!empty($sociallink->link) ? $sociallink->link : ''); ?>" target="_new"
                            class="d-inline-block me-3 text-dark"><?php echo $link; ?></a>
                        <?php } ?>
                        <!-- <a href="<?php echo (!empty($get_studentinfo->facebook) ? $get_studentinfo->facebook : ''); ?>"
                            target="_new" class="d-inline-block me-3 text-dark"><i class="fab fa-facebook"></i></a>
                        <a href="<?php echo (!empty($get_studentinfo->linkedin) ? $get_studentinfo->linkedin : ''); ?>"
                            class="d-inline-block me-3 text-dark" target="_new"><i class="fab fa-linkedin"></i></a>
                        <a href="<?php echo (!empty($get_studentinfo->twitter) ? $get_studentinfo->twitter : ''); ?>"
                            class="d-inline-block me-3 text-dark" target="_new"><i class="fab fa-twitter"></i></a>
                        <a href="<?php echo (!empty($get_studentinfo->instagram) ? $get_studentinfo->git : ''); ?>"
                            class="d-inline-block me-3 text-dark" target="_new"><i class="fab fa-github"></i></a>
                        <a href="<?php echo (!empty($get_studentinfo->instagram) ? $get_studentinfo->instagram : ''); ?>"
                            class="d-inline-block me-3 text-dark" target="_new"><i class="fab fa-instagram"></i></a> -->
                    </div>
                    <!--End Social Share Icon-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
} 
} 
?>
<!--End Contact-->

<!--Start Popular Course-->
<?php if($courses_complete_course){ ?>
<div class="bg-alice-blue py-3">
    <?php if($courses_complete_course){ ?>
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-3 p-md-4 p-xl-5">
                <!--Start Section Header-->
                <div class="section-header mb-4">
                    <h4 class="text-uppercase fw-bold">Course Completed</h4>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
                <div class="row" id="gridDemo">
                    <?php 
                       foreach($courses_complete_course as $courses_complete){
                        $studentCount = $this->db->where('product_id', $courses_complete->product_id)->get('invoice_details')->num_rows();
                        $LessonDuration=$this->db->select('*')->from('lesson_tbl')->where('course_id',$courses_complete->product_id)->where('enterprise_id',$enterprise_id)->get()->result();
                        $seconds = 0;
                            foreach ($LessonDuration as $singletime) {
                                list($hour, $minute, $second) = explode(':', html_escape($singletime->duration));
                                $seconds += $hour * 3600;
                                $seconds += $minute * 60;
                                $seconds += $second;
                            }
                            $dayseconds= $seconds;
                            // function secondsToWords($dayseconds) {
                            //     /*** number of days ***/
                            //     $days = (int)($dayseconds / 86400);
                            //     /*** if more than one day ***/
                            //     $plural = $days > 1 ? 'days' : 'day';
                            //     /*** number of hours ***/
                            //     $hours = (int)(($dayseconds - ($days * 86400)) / 3600);
                            //     /*** number of mins ***/
                            //     $mins = (int)(($dayseconds - $days * 86400 - $hours * 3600) / 60);
                            //     /*** number of seconds ***/
                            //     $secs = (int)($dayseconds - ($days * 86400) - ($hours * 3600) - ($mins * 60));
                            //     /*** return the string ***/
                            //     echo  sprintf("%d hr %d m", $hours,$mins);
                            // }
                         // progress           
                      //======video % start calculation here=================== 
                    //   $lesson_tbl=$this->db->select('*')->from('lesson_tbl')->where('course_id',$courses_complete->product_id)->where('lesson_type',1)->where('enterprise_id',$enterprise_id)->get()->result();
                    //   $toTalLessonVideoDuration = 0;
                    //   $eachVideoDuration= 0;
                    //   $TotalWatchTime=0;
                    //   $i=0;
                    //   foreach ($lesson_tbl as $lesson_tbl_duration) {
                    //       list($hour, $minute, $second) = explode(':', html_escape($lesson_tbl_duration->duration));
                    //       $hour1 = $hour * 3600;
                    //       $minute1 = $minute * 60;
                    //       $second1 = $second;
                    //   $eachVideoDuration=$hour1+$minute1+$second1;
                    //   $toTalLessonVideoDuration +=$eachVideoDuration; //all lesson duration
                    //   $watch=$this->db->select('*')->from('watch_time_tbl')->where('lesson_id',$lesson_tbl_duration->lesson_id)->where('student_id',$user_id)->where('course_id',$courses_complete->product_id)->where('enterprise_id',$enterprise_id)->get()->row();
                    //   $eachvideoWatchTime=(!empty($watch->real_time) ? $watch->real_time : '1');
                    //   if($eachvideoWatchTime<=$eachVideoDuration){
                    //       $TotalWatchTime +=@$watch->real_time; //single video watch time
                    //   }else{
                    //       $TotalWatchTime +=$eachVideoDuration;
                    //   }
                    //   }

                      
                    //   if($TotalWatchTime > 0 && $toTalLessonVideoDuration>0){
                    //   $eachVedioPercent = number_format((@$TotalWatchTime * 100 )/ $toTalLessonVideoDuration,2); //each video percentage
                    //   $TotalVideo=$eachVedioPercent;
                    //   // new  
                    //   $videoWatchPercentage=$eachVedioPercent*25/100;

                    //   }else{
                    //       $videoWatchPercentage=0;
                    //   }
                    //    //======video % end calculation here=================== 

                    //    // text file and pdf  start
                    //   $textFilePerCalculation=$this->db->where('course_id',$courses_complete->product_id)->where('lesson_type !=',1)->where('enterprise_id',$enterprise_id)->get('lesson_tbl')->num_rows();
                    //   $completetextFile = $this->db->where('course_id',$courses_complete->product_id)->where('student_id', $user_id)->where('file_type',0)->where('is_complete',1)->where('enterprise_id',$enterprise_id)->get('watch_time_tbl')->num_rows();
                    //   if($completetextFile > 0 && $textFilePerCalculation>0){
                    //   $Textfilecount=$completetextFile*100/$textFilePerCalculation;
                    //   }else{
                    //    $Textfilecount=0;
                    //   }
                    //   $Filecomplete =$Textfilecount*25/100;
                    //    //=========================text file and pdf  end=================================

                    //   $VideoAndFIle=(!empty($videoWatchPercentage) ? $videoWatchPercentage:'0')+(!empty($Filecomplete) ? $Filecomplete:'0');//===text file video file % sum 
                    //   $assignment=25;
                    //   $q=25;
                    //   $TotalProgress=number_format($VideoAndFIle+50,1); //== total % calculation 
                    //      if($TotalProgress =='100'){
                        ?>
                    <div class="col-xxl-3 col-lg-4 col-md-6 hideClass">
                        <!--Start Course Card-->
                        <div
                            class="course-card course-card-shadow rounded-6 bg-white position-relative overflow-hidden">
                            <div class="position-relative overflow-hidden bg-prussian-blue">
                                <!--Start Course Image-->
                                <a href="<?php echo base_url($enterprise_shortname . '/course-details/' .$courses_complete->product_id); ?>"
                                    class="course-card_img">
                                    <img src="<?php echo base_url(!empty($courses_complete->picture) ? $courses_complete->picture : default_600_400()); ?>"
                                        class="img-fluid w-100" alt="">
                                </a>
                                <!--End Course Image-->
                                <!--Start items badge-->
                                <div
                                    class="align-items-center top-0 d-flex fs-12 position-absolute px-3 py-2 start-0 text-white w-100 z-index-2">
                                    <?php
                                        if ($courses_complete->tagstatus == 4) {?>
                                    <span class="badge-new  me-1">Most Popular</span>
                                    <?php
                                        } elseif ($courses_complete->tagstatus == 3) {?>
                                    <span class="badge-new  me-1">New</span>
                                    <?php } elseif ($courses_complete->tagstatus == 1) {?>
                                    <span class="badge-new  me-1">Recomended</span>

                                    <?php } elseif ($courses_complete->tagstatus == 2) {?>
                                    <span class="badge-new  me-1">Best Seller</span>
                                    <?php }?>
                                    <span
                                        class="badge-business"><?php echo html_escape($courses_complete->category_name); ?></span>
                                    <span id="savecourse<?php echo $courses_complete->product_id; ?>" class="ms-auto">
                                        <?php
                                        $coursesaved_checked = $this->Frontend_model->coursesaved_checked($user_id,$courses_complete->product_id);
                                        if (!$coursesaved_checked){
                            
                                            if ($user_type == 4) {?>
                                        <img onclick="get_coursesaveloop(1, '<?php echo $courses_complete->product_id; ?>')"
                                            src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-1.png'); ?>"
                                            class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                        <?php }else {?>
                                        <img onclick="coursesavecheck()"
                                            src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-1.png'); ?>"
                                            class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                        <?php }
                                        } else {?>
                                        <img onclick="get_coursesaveloop(0, '<?php echo $courses_complete->product_id; ?>')"
                                            src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-2.png'); ?>"
                                            class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                        <?php } ?>
                                    </span>
                                </div>
                                <?php if (!empty($courses_complete->is_discount == 1)) {?>
                                <span
                                    class="px-0 badge m-3   position-absolute start-0 text-white   z-index-2 polygon-shape"
                                    style="top:25px">
                                    <span class="d-block fs-13 mb-1">Off</span>
                                    <span
                                        class="fs-15 fw-bold"><?php echo (($courses_complete->discount) ? $courses_complete->discount : ''); ?><?php if ($courses_complete->discount_type == 2) {echo "%";} else {echo " ";}?></span>
                                </span>
                                <?php }?>
                                <!--End items badge-->
                                <!--Start Course Card Body-->
                                <div class="bg-prussian-blue course-card_body course_middle px-3 py-2 text-white py-12">
                                    <!--Start Course Title-->
                                    <h3 class="course-card__course--title  mb-0 text-capitalize">
                                        <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses_complete->product_id); ?>"
                                            class="text-decoration-none text-white"><?php echo (!empty($courses_complete->course_name) ? $courses_complete->course_name : ''); ?></a>
                                    </h3>
                                    <!--End Course Title-->
                                    <div class="course-card__instructor d-flex align-items-center">
                                        <div class="card__instructor--name my-2">
                                            <a class="text-capitalize instructor-name"
                                                href="<?php echo base_url($enterprise_shortname . '/instructor-profile-show/' . $courses_complete->faculty_id); ?>"><?php echo (!empty($courses_complete->instructor_name) ? $courses_complete->instructor_name : ''); ?></a>
                                        </div>
                                    </div>
                                    <!--Start Course Hints-->
                                    <table class="course-card__hints table table-borderless table-sm text-white mb-0">
                                        <tbody>
                                            <tr>
                                                <td width="80" class="ps-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="course-card__hints--icon me-3">
                                                            <?php if (@$courses_complete->course_level == 1) {?>
                                                            <div class="d-flex align-items-center">
                                                                <div class="bar-custom me-2">
                                                                    <span class="fill"></span>
                                                                    <span></span>
                                                                    <span></span>
                                                                </div>
                                                            </div>
                                                            <?php } elseif (@$courses_complete->course_level == 2) {?>
                                                            <div class="d-flex align-items-center">
                                                                <div class="bar-custom me-2">
                                                                    <span class="fill"></span>
                                                                    <span class="fill"></span>
                                                                    <span></span>
                                                                </div>
                                                            </div>
                                                            <?php } elseif (@$courses_complete->course_level == 3) {?>
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
                                                        if ($courses_complete->course_level == 1) {
                                                            echo "Beginner  Level";
                                                        } elseif ($courses_complete->course_level == 2) {
                                                            echo "Intermediate Level";
                                                        } elseif ($courses_complete->course_level == 3) {
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
                                                            <?php if ($courses_complete->enterprise_name == 'Admin') {echo "Lead Academy";} else{echo $courses_complete->enterprise_name . " " . "Academy";}?>

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
                                            $course_wise_lesson = $this->Course_model->course_wise_lesson($courses_complete->product_id);
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
                                                $studentCount = $this->db->where('product_id', $courses_complete->product_id)->get('invoice_details')->num_rows();
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
                                                    <?php echo average_ratings_number($courses_complete->product_id, $enterprise_id); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--End Course Card Body-->


                                <!--Start Course Card Hover Content-->
                                <div class="course-card__hover--content">
                                    <img src="<?php echo base_url(!empty($courses_complete->hover_thumbnail) ? $courses_complete->hover_thumbnail : default_600_400()); ?>"
                                        class="course-card__hover--content___img">
                                    <!--Start Video Icon With Popup Youtube-->
                                    <?php if ($courses_complete->url) {?>

                                    <a class="course-card__hover--content___icon popup-youtube"
                                        href="<?php echo (!empty($courses_complete->url) ? $courses_complete->url : ''); ?>"
                                        autoplay>
                                        <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/Playicon.png'); ?>"
                                            class="img-fluid" alt="">
                                    </a>
                                    <?php }?>
                                    <!--End Video Icon With Popup Youtube-->

                                    <h3
                                        class="bottom-0 course-card__hover--content___text d-block fs-15 mb-0 position-absolute text-capitalize text-decoration-none text-white">
                                        <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses_complete->product_id); ?>"
                                            class="text-decoration-none text-white"><?php echo (!empty($courses_complete->course_name) ? $courses_complete->course_name : ''); ?></a>
                                    </h3>
                                </div>
                                <!--End Card Hover Content-->
                            </div>
                            <?php $course_types = json_decode($courses_complete->course_type);
                             $checked_purchase = $this->db->where('customer_id',$user_id)->where('product_id', $courses_complete->product_id)->where('status',1)->where('status',1)->get('invoice_details')->row();
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
                                            for="flexRadioDefault2_<?php echo $courses_complete->product_id?>">
                                            <span class="course_price_cart">Course Price
                                                <span class="text-success">
                                                </span>
                                            </span>
                                            <span class="align-items-center d-flex  rounded text-center">
                                                <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                    <?php echo (($courses_complete->is_offer == 1) ? number_format($courses_complete->offer_courseprice) : number_format($courses_complete->price)); ?></span>
                                                <?php if(!empty($courses_complete->is_discount==1)){?>
                                                <del
                                                    class="fs-12 fw-bold text-muted2"><?php echo (($courses_complete->oldprice)?number_format($courses_complete->oldprice) :" "); ?></del>
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
                                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $courses_complete->product_id); ?>"
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
                                    <input type="hidden" class="course"
                                        value="<?php echo $courses_complete->product_id; ?>"
                                        id="<?php echo $courses_complete->product_id; ?>">
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <!-- <input class="form-check-input" type="radio" name="flexRadioDefault1_<?php echo $courses_complete->product_id ?>" id="flexRadioDefault1_<?php echo $courses_complete->product_id ?>"  onclick="subscriptionchecedRadio('<?php echo $courses_complete->product_id; ?>')" > -->
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault1_<?php echo $courses_complete->product_id ?>"
                                            id="flexRadioDefault1_<?php echo $courses_complete->product_id ?>"
                                            onclick="subscriptionchecedRadio('<?php echo $courses_complete->product_id; ?>')">
                                        <label class="form-check-label fw-bold course_price_cart "
                                            for="flexRadioDefault1_<?php echo $courses_complete->product_id ?>">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="form-check d-flex align-items-center ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault2_<?php echo $courses_complete->product_id ?>"
                                            id="flexRadioDefault2_<?php echo $courses_complete->product_id ?>"
                                            onclick="coursechecedRadio('<?php echo $courses_complete->product_id; ?>')"
                                            checked>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                            style="width:100%;"
                                            for="flexRadioDefault2_<?php echo $courses_complete->product_id ?>">
                                            <span class="course_price_cart">Course Price
                                                <span class="text-success">
                                                </span>
                                            </span>
                                            <span class="align-items-center d-flex  rounded text-center">
                                                <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                    <?php echo (($courses_complete->is_offer == 1) ? number_format($courses_complete->offer_courseprice) : number_format($courses_complete->price)); ?></span>
                                                <?php if (!empty($courses_complete->is_discount == 1)) {?>
                                                <del
                                                    class="fs-12 fw-bold text-muted2"><?php echo (($courses_complete->oldprice) ? number_format($courses_complete->oldprice) : " "); ?></del>
                                                <?php }?>

                                            </span>
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2"
                                        id="course_purchase_<?php echo $courses_complete->product_id ?>">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses_complete->product_id); ?>"
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
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses_complete->product_id); ?>"
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
                                        id="course_subscription_<?php echo $courses_complete->product_id ?>">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/subscription-details'); ?>"
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
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses_complete->product_id); ?>"
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
                                            name="flexRadioDefault1_<?php echo $courses_complete->product_id ?>"
                                            id="flexRadioDefault1_<?php echo $courses_complete->product_id ?>"
                                            onclick="subscriptionchecedRadio('<?php echo $courses_complete->product_id; ?>')"
                                            disabled>
                                        <label class="form-check-label fw-bold opa-half course_price_cart"
                                            for="flexRadioDefault1">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="form-check d-flex align-items-center ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault2_<?php echo $courses_complete->product_id ?>"
                                            id="flexRadioDefault2_<?php echo $courses_complete->product_id ?>"
                                            onclick="coursechecedRadio('<?php echo $courses_complete->product_id; ?>')"
                                            checked>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                            style="width:100%"
                                            for="flexRadioDefault2_<?php echo $courses_complete->product_id ?>">
                                            <span class="course_price_cart">Course Price <span
                                                    class="text-success"></span>
                                            </span>
                                            <span class="align-items-center d-flex  rounded text-center">
                                                <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                    <?php echo (($courses_complete->is_offer == 1) ? number_format($courses_complete->offer_courseprice) : number_format($courses_complete->price)); ?></span>
                                                <?php if (!empty($courses_complete->is_discount == 1)) {?>
                                                <del
                                                    class="fs-12 fw-bold text-muted2"><?php echo (($courses_complete->oldprice) ? number_format($courses_complete->oldprice) : " "); ?></del>
                                                <?php }?>
                                            </span>

                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses_complete->product_id); ?>"
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
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses_complete->product_id); ?>"
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
                                            name="flexRadioDefault1_<?php echo $courses_complete->product_id ?>"
                                            id="flexRadioDefault1_<?php echo $courses_complete->product_id ?>"
                                            onclick="subscriptionchecedRadio('<?php echo $courses_complete->product_id; ?>')"
                                            checked>
                                        <label class="form-check-label fw-bold course_price_cart"
                                            for="flexRadioDefault1_<?php echo $courses_complete->product_id ?>">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="form-check d-flex align-items-center ps-0 ">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault2_<?php echo $courses_complete->product_id ?>"
                                            id="flexRadioDefault2_<?php echo $courses_complete->product_id ?>"
                                            onclick="coursechecedRadio('<?php echo $courses_complete->product_id; ?>')"
                                            disabled>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between opa-half"
                                            style="width: calc(100% - 25px);" for="flexRadioDefault2">
                                            <span class="course_price_cart">Course Price <span
                                                    class="text-success"></span></span>
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/subscription-details'); ?>"
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
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses_complete->product_id); ?>"
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
                                            name="flexRadioDefault1_<?php echo $courses_complete->product_id ?>"
                                            id="flexRadioDefault1_<?php echo $courses_complete->product_id ?>"
                                            onclick="subscriptionchecedRadio('<?php echo $courses_complete->product_id; ?>')"
                                            disabled>
                                        <label class="form-check-label fw-bold opa-half course_price_cart"
                                            for="flexRadioDefault1">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault2_<?php echo $courses_complete->product_id ?>"
                                            id="flexRadioDefault2_<?php echo $courses_complete->product_id ?>"
                                            onclick="coursechecedRadio('<?php echo $courses_complete->product_id; ?>')"
                                            disabled>
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
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses_complete->product_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13"> Enroll Free </span>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses_complete->product_id); ?>"
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
                                            name="flexRadioDefault1_<?php echo $courses_complete->product_id ?>"
                                            id="flexRadioDefault1_<?php echo $courses_complete->product_id ?>"
                                            onclick="subscriptionchecedRadio('<?php echo $courses_complete->product_id; ?>')"
                                            disabled>
                                        <label class="form-check-label fw-bold opa-half course_price_cart"
                                            for="flexRadioDefault1">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio"
                                            name="flexRadioDefault2_<?php echo $courses_complete->product_id ?>"
                                            id="flexRadioDefault2_<?php echo $courses_complete->product_id ?>"
                                            onclick="coursechecedRadio('<?php echo $courses_complete->product_id; ?>')"
                                            disabled>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between opa-half"
                                            for="flexRadioDefault2_<?php echo $courses_complete->product_id ?>">
                                            <span class="course_price_cart">Course Price</span>
                                            <span class="bg-danger d-flex px-2 rounded text-center text-white">
                                                <!-- Govt -->
                                            </span>
                                        </label>
                                        <span class="badge bg-success me-1 float-end ms-auto"> Govt</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-stretch mt-2">
                                        <div class="flex-grow-1 me-2 w-sub">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses_complete->product_id); ?>"
                                                class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                <span class="shopping me-1 shopping_icon position-relative">
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                        style="width: 14px;">
                                                </span>
                                                <span class="text-center w-100 fw-bold fs-13"> Govt </span>
                                            </a>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $courses_complete->product_id); ?>"
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
                                <?php }?>

                            </div>
                        </div>
                        <!--End Course Card-->
                    </div>
                    <?php } //}?>

                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<?php } ?>
<!--End Popular Course-->