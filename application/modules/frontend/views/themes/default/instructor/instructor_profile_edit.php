<link
    href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css'); ?>"
    rel="stylesheet">

<link href="<?php echo base_url() ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/plugins/select2-bootstrap4/dist/select2-bootstrap4.min.css" rel="stylesheet">
<style>
.bootstrap-tagsinput .tag {
    background: #07477d;
    padding: 0 5px 0 10px;
    border-radius: 4px;
    line-height: 30px;
    display: inline-block;
}

.bootstrap-tagsinput {
    display: block;
}

.select2-container--default .select2-selection--multiple .select2-selection__rendered li {
    /* background: #07477d;
        padding: 0 5px 0 10px;
        border-radius: 4px;
        line-height: 30px;
        color: #fff; */
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #07477d;
    color: #fff;
}

.nav-pills .nav-link.active,
.nav-pills .show>.nav-link {
    background-color: #07477d;
}

.toaddareahide_1 {
    display: contents;
}
</style>
<?php 
$user_id = $this->session->userdata('user_id');
$user_type = $this->session->userdata('user_type');
?>
<!--Start Resume/Portfolio PDF download-->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="">
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
        <div class="card border-0 rounded-0 shadow-sm mt-4">
            <div class="card-body p-4 p-xl-5">
                <div class="d-sm-flex justify-content-between mb-4">
                    <!--Start Section Header-->
                    <div class="section-header mb-3 mb-sm-0">
                        <h4 class="mb-0 fw-bold font-letter-spacing-1">Resume/Portfolio PDF</h4>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <div class="d-flex align-items-center justify-end btn-act">
                        <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox"
                                value="<?php echo ($instructor_info->is_resumeshow?$instructor_info->is_resumeshow:''); ?>"
                                id="is_resumeshow"
                                <?php echo (($instructor_info->is_resumeshow == 1) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="is_resumeshow">Show</label>
                        </div>
                        <button class="btn btn-dark-cerulean ms-3" onclick="resumeUpload()">
                            <i data-feather="save" class="me-1"></i>Save
                        </button>
                    </div>
                </div>
                <div class="mb-4">If you have a PDF portfolio/resume that you'd like others to see, upload it here. Up
                    to 20MB</div>
                <?php //d($instructor_info);?>
                <div class="d-flex align-items-center resume">
                    <?php if($instructor_info->resume){ ?>
                    <button class="btn btn-danger me-2" onclick="resume_upload_delete()">
                        <i class="fas fa-trash-alt me-2"></i>Delete CV
                    </button>
                    <?php } ?>
                    <div class="zone upload text-center d-inline-block">
                        <div id="dropZ2">
                            <div class="selectFile">
                                <label for="resume"><i data-feather="upload" class="me-2"></i>Upload CV</label>
                                <input type="file" name="files" id="resume" onchange="uploadCV('resume')">
                            </div>
                        </div>
                        <input type="hidden" id="old_resume" class="form-controll"
                            value="<?php echo (!empty($instructor_info->resume) ? $instructor_info->resume : ''); ?>">
                    </div>

                    <?php if($instructor_info->resume){ ?>
                    <a href="<?php echo base_url((!empty($instructor_info->resume) ? $instructor_info->resume : '')); ?>"
                        class="download-icon ms-2" download>
                        <svg id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512"
                            width="512" xmlns="http://www.w3.org/2000/svg" style="fill: #07477d;">
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
                    <?php } ?>
                </div>
                <!-- Progress bar -->
                <div class="progress-area mt-2"></div>
                <!-- Display upload status -->
                <div id="uploadStatus"></div>



            </div>
        </div>
    </div>
</div>

<!--End Resume/Portfolio PDF download-->
<!--Start Personal Skills-->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <div class="d-flex justify-content-between mb-4">
                    <!--Start Section Header-->
                    <div class="section-header">
                        <h4 class="text-uppercase fw-bold">Profile</h4>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <div class="d-flex align-items-center btn-act">
                        <!-- <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox"
                                value="<?php echo $instructor_info->is_profileshow ?>" id="is_profileshow"
                                <?php echo (($instructor_info->is_profileshow == 1) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="is_profileshow">Show</label>
                        </div> -->
                        <button class="btn btn-dark-cerulean ms-3" onclick="profileupdate()">
                            <i data-feather="save" class="me-1"></i>Save
                        </button>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="instructorName" class="form-label mb-1 fw-medium">Name *</label>
                    <input type="text" class="form-control form-control-lg" id="instructorName" placeholder="Your Name"
                        value="<?php echo (!empty($instructor_info->name) ? $instructor_info->name : ''); ?>">
                </div>
                <div class="mb-3">
                    <label for="designation" class="form-label mb-1 fw-medium">Professional Headline - One line about
                        you <span class="text-muted">(professional designation)</span></label>
                    <input type="text" class="form-control form-control-lg" placeholder="Write something about you"
                        id="designation"
                        value="<?php echo (!empty($instructor_info->designation) ? $instructor_info->designation : ''); ?>">
                </div>
                <div class="mb-3">
                    <label for="website" class="form-label mb-1 fw-medium">Web Address</label>
                    <input type="text" class="form-control form-control-lg" id="website" placeholder="Enter Website"
                        value="<?php echo (!empty($instructor_info->website) ? $instructor_info->website : ''); ?>">
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Personal Skills-->
<!--Start Personal Skills-->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <div class="d-flex justify-content-between mb-4">
                    <!--Start Section Header-->
                    <div class="section-header">
                        <h4 class="fw-bold mb-1">
                            <?php echo (!empty($instructor_info->name) ? $instructor_info->name : ''); ?></h4>
                    </div>
                    <!--End Section Header-->
                    <div class="d-flex align-items-center btn-act">
                        <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox"
                                value="<?php echo $instructor_info->is_biographyshow; ?>" id="is_biographyshow"
                                <?php echo (($instructor_info->is_biographyshow == 1) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="is_biographyshow">Show</label>
                        </div>
                        <button class="btn btn-dark-cerulean ms-3" id="instructorbiographysave">
                            <i data-feather="save" class="me-1"></i>Save
                        </button>
                    </div>
                </div>
                <div class="mb-3">
                    <textarea id="bioeditor"
                        rows="5"><?php  echo (!empty($instructor_info->biography) ? $instructor_info->biography : '') ;?></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Personal Skills-->
<!--Start Personal Skills-->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <div class="d-flex justify-content-between mb-4">
                    <!--Start Section Header-->
                    <div class="section-header">
                        <h4 class="text-uppercase fw-bold">Skills</h4>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <div class="d-flex align-items-center btn-act">
                        <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox"
                                value="<?php echo $instructor_info->is_skillshow; ?>" id="is_skillshow"
                                <?php echo (($instructor_info->is_skillshow == 1) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="is_skillshow">Show</label>
                        </div>
                        <button class="btn btn-dark-cerulean ms-3" onclick="skillsupdate()">
                            <i data-feather="save" class="me-1"></i>Save
                        </button>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="skillsSelect" class="form-label mb-2 fw-medium">Please select your skills (you can
                        select more than one)</label>
                    <input type="text"
                        value="<?php echo (!empty($instructor_info->skills) ? $instructor_info->skills : ''); ?>"
                        data-role="tagsinput" id="skillsSelect" />
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Personal Skills-->
<!--Start Professional Proficiency-->
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
                    <!--End Section Header-->
                    <div class="d-flex align-items-center justify-end btn-act">
                        <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox"
                                value="<?php echo $instructor_info->is_proficiencyshow; ?>" id="is_proficiencyshow"
                                <?php echo (($instructor_info->is_proficiencyshow == 1) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="is_proficiencyshow">Show</label>
                        </div>
                        <button class="btn btn-dark-cerulean ms-3" onclick="proficiencyupdate()">
                            <i data-feather="save" class="me-1"></i>Save
                        </button>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="proficiencySelect" class="form-label mb-2 fw-medium">Please select your professional
                        proficiency (you can select more than one)</label>
                    <input type="text" class="form-control proficiency-typeahead" placeholder="Enter Proficiency"
                        aria-label="Recipient's username" aria-describedby="button-addon2" id="proficiencySelect"
                        name="proficiency-typeahead" autocomplete="off">
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
                            <div class="close_btn">
                                <a href="javascript:void(0)"
                                    onclick="proficiency_delete('<?php echo $proficiency->id; ?>')">
                                    <i data-feather="x-circle" class="ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Professional Proficiency-->
<!--Start Featured Work-->
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
                    <div>

                        <div class="d-flex align-items-center justify-end btn-act">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox"
                                    value="<?php echo $instructor_info->is_featureshow; ?>" id="is_featureshow"
                                    <?php echo (($instructor_info->is_featureshow == 1) ? 'checked' : ''); ?>>
                                <label class="form-check-label" for="is_featureshow">Show</label>
                            </div>
                            <button class="btn btn-dark-cerulean ms-3" onclick="featureshowupdate()">
                                <i data-feather="save" class="me-1"></i>Save
                            </button>
                        </div><br>

                        <a href="<?php echo base_url($enterprise_shortname .'/instructor-project-add'); ?>"
                            class="btn btn-dark-cerulean">+&nbsp;Add New Project</a>
                    </div>
                </div>
                <div class="position-relative">
                    <!--Nav Pills-->
                    <ul class="nav nav-pills mb-3 assignment_nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active featured_work_color fw-semi-bold" id="pills-one-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-one" type="button" role="tab"
                                aria-controls="pills-one" aria-selected="true"
                                onclick="typewiseproject('0', 'edit')">All</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link featured_work_color fw-semi-bold" id="pills-two-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-two" type="button" role="tab"
                                aria-controls="pills-two" aria-selected="false"
                                onclick="typewiseproject('1', 'edit')">Course Project</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link featured_work_color fw-semi-bold" id="pills-five-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-five" type="button" role="tab"
                                aria-controls="pills-five" aria-selected="false"
                                onclick="typewiseproject('4', 'edit')">Client Project</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link featured_work_color fw-semi-bold" id="pills-three-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-three" type="button" role="tab"
                                aria-controls="pills-three" aria-selected="false"
                                onclick="typewiseproject('2', 'edit')">Personal Project</button>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
                            <button class="nav-link featured_work_color fw-semi-bold" id="pills-four-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-four" type="button" role="tab" aria-controls="pills-four"
                                aria-selected="false" onclick="typewiseproject('3', 'edit')">Practice Project</button>
                        </li> -->
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-one" role="tabpanel"
                            aria-labelledby="pills-one-tab">
                            <div class="project-carousel owl-carousel owl-theme">
                                <!--Start Project Card-->
                                <?php if($get_featuredproject){ ?>
                                <?php foreach($get_featuredproject as $project){ ?>
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
                                        <a class="text-dark fs-15"
                                            href="<?php echo base_url($enterprise_shortname . '/instructor-project-view/' . $project->project_id); ?>">
                                            <?php echo (!empty($project->title) ? $project->title : ''); ?>
                                        </a>
                                    </h6>
                                    <!--Start Action Button-->
                                    <div class="action-btn align-items-center d-flex mt-3">
                                        <a href="<?php echo base_url($enterprise_shortname . '/instructor-project-edit/'. $project->project_id); ?>"
                                            class="me-2 text-dark"><i data-feather="edit-3"
                                                class="me-1"></i><span>Edit</span></a>
                                        <a href="javascript:void(0)" class="me-2 text-danger"
                                            onclick="instructorprojectdelete('<?php echo $project->project_id; ?>')"><i
                                                data-feather="trash-2" class="me-1"></i><span>Delete</span></a>
                                    </div>
                                    <!--End Action Button-->
                                </div>
                                <?php } ?>
                                <?php }else{ ?>
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
<!--End Featured Work-->
<!--Start Experience-->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <?php echo form_open_multipart($enterprise_shortname . '/instructor-experience-save', 'class="myform" id="myform"'); ?>
                <div class="d-flex justify-content-between mb-4">
                    <!--Start Section Header-->
                    <div class="section-header">
                        <h4 class="text-uppercase fw-bold">Experience</h4>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <div class="d-flex align-items-center btn-act">
                        <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox"
                                value="<?php echo $instructor_info->is_experienceshow; ?>" id="is_experienceshow"
                                name="is_experienceshow"
                                <?php echo (($instructor_info->is_experienceshow == 1) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="is_experienceshow">Show</label>
                        </div>
                        <button type="submit" class="btn btn-dark-cerulean ms-3">
                            <i data-feather="save" class="me-1"></i>Save
                        </button>
                    </div>
                </div>
                <div id="experience_area">
                    <div id="rmvEx0">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="companyname" class="form-label mb-1 fw-medium">Company <i
                                            class="text-danger">*</i></label>
                                    <input type="text" class="form-control form-control-lg" id="companyname"
                                        name="companyname[]">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="cityname" class="form-label mb-1 fw-medium">City</label>
                                    <input type="text" class="form-control form-control-lg" id="cityname"
                                        name="cityname[]">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label mb-1 fw-medium">Title <i
                                            class="text-danger">*</i></label>
                                    <input type="text" class="form-control form-control-lg" id="title" name="title[]">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="country" class="form-label mb-1 fw-medium">Country </label>
                                    <input type="text" class="form-control form-control-lg" id="country"
                                        name="country[]">
                                </div>
                            </div>
                        </div>
                        <div class="row gx-3 gy-2 align-items-end mb-4">
                            <div class="col-sm-2">
                                <label for="frommonth">From</label>
                                <select class="form-select" id="frommonth" name="frommonth[]">
                                    <option selected>Choose Month</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label class="visually-hidden" for="fromyear">year</label>
                                <select class="form-select" id="fromyear" name="fromyear[]">
                                    <option selected>Choose Year</option>
                                    <?php 
                                    $cy = (int)date('Y');
                                    $y = 2010; ?>
                                    <?php
                                        for($y = 2010; $y<=$cy; $y++){
                                    ?>
                                    <option value="<?php echo $y;?>"><?php echo $y;?></option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" name="" id="yeardynamic" value='<?php 
                                    $cy = (int)date('Y');
                                    $y = 2010; ?>
                                    <?php
                                        for($y = 2010; $y<=$cy; $y++){
                                    ?>
                                    <option value="<?php echo $y;?>"><?php echo $y;?></option>
                                    <?php } ?>'>
                            </div>
                            <div class="toaddareahide_1">

                                <div class="col-auto me-3">
                                    <span class="fromto"></span>
                                </div>

                                <div class="col-sm-2 me-3">
                                    <label for="tomonth">To</label>
                                    <select class="form-select" id="tomonth" name="tomonth[]">
                                        <option selected>Choose Month</option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label class="visually-hidden" for="toyear">Year</label>
                                    <select class="form-select" id="toyear" name="toyear[]">
                                        <option selected>Choose Year</option>
                                        <?php 
                                    $cy = (int)date('Y');
                                    $y = 2010; ?>
                                        <?php
                                        for($y = 2010; $y<=$cy; $y++){
                                    ?>
                                        <option value="<?php echo $y;?>"><?php echo $y;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" onclick="isNowworking('1', 'add')"
                                        id="nowworking_1" name="nowworking[]">
                                    <input type="hidden" name="hdn_nowworking[]" id="hdn_nowworking_1">
                                    <label class="form-check-label" for="nowworking_1"> I currently work here</label>
                                </div>
                            </div>
                            <!--                            <div class="col-auto">
                                                            <button type="button" class="btn btn-danger"
                                                                    onclick="removeexperience(this)">Delete</button>
                                                        </div>-->
                        </div>
                    </div>

                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-dark-cerulean" onclick="addmoreexperience()">Add
                        Experience</button>
                </div>
                <?php echo form_close(); ?>
                <div class="row gx-3 gy-2 align-items-end mb-5">

                </div>
                <?php foreach($get_userexperience as $experience){ ?>
                <div class="d-sm-flex justify-content-between align-items-center mb-5">
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
                            <a href="javascript:void(0)"
                                onclick="facultyexpericen_update('<?php echo $experience->id; ?>')"
                                class="me-2 text-dark"><i data-feather="edit-3" class="me-1"></i><span>Edit</span></a>
                            <a href="javascript:void(0)"
                                onclick="instructor_expericenedelete('<?php echo $experience->id; ?>')"
                                class="me-2 text-danger"><i data-feather="trash-2"
                                    class="me-1"></i><span>Delete</span></a>
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
<!--End Experience-->
<!--Start Education-->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <?php echo form_open_multipart($enterprise_shortname . '/instructor-education-save', 'class="instructor_education" id="instructor_education"'); ?>
                <div class="d-flex justify-content-between mb-4">
                    <!--Start Section Header-->
                    <div class="section-header">
                        <h4 class="text-uppercase fw-bold">Education</h4>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <div class="d-flex align-items-center btn-act">
                        <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox" value="1" id="is_educationshow"
                                name="is_educationshow"
                                <?php echo (($instructor_info->is_educationshow == 1) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="is_educationshow">Show</label>
                        </div>
                        <button class="btn btn-dark-cerulean ms-3">
                            <i data-feather="save" class="me-1"></i>Save
                        </button>
                    </div>
                </div>
                <div id="education_area">
                    <div id="rmvEdu0">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="institutename_1"
                                        class="form-label mb-1 fw-medium">School/College/University/Institute Name
                                        *</label>
                                    <input type="text" class="form-control form-control-lg" id="institutename_1"
                                        name="institutename[]">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="degreename_1" class="form-label mb-1 fw-medium">Degree</label>
                                    <input type="text" class="form-control form-control-lg" id="degreename_1"
                                        name="degreename[]">
                                </div>
                            </div>
                        </div>
                        <div class="row gx-3 gy-2 align-items-end mb-5">
                            <div class="col-auto">
                                <label class="visually-hidden" for="passingyear_1">year</label>
                                <select class="form-select" id="passingyear_1" name="passing_year[]">
                                    <option selected>Choose Passing Year</option>
                                    <?php 
                                    $cy = (int)date('Y');
                                    $y = 2010; ?>
                                    <?php
                                        for($y = 2010; $y<=$cy; $y++){
                                    ?>
                                    <option value="<?php echo $y;?>"><?php echo $y;?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <!-- <div class="col-auto ms-auto">
                                <button type="button" class="btn btn-danger"
                                    onclick="removeeducation(this)">Delete</button>
                            </div> -->
                        </div>
                    </div>
                    <input type="hidden" name="" id="passingyearhv" value='<?php 
                                    $cy = (int)date('Y');
                                    $y = 2010; ?>
                                    <?php
                                        for($y = 2010; $y<=$cy; $y++){
                                    ?>
                                    <option value="<?php echo $y;?>"><?php echo $y;?></option>
                                    <?php } ?> '>
                </div>
                <div class="col-auto ms-auto">
                    <button type="button" class="btn btn-dark-cerulean" onclick="addmoreeducation()">Add</button>
                </div>
                <?php echo form_close(); ?>
                <div class="row g-3 mt-3">
                    <?php foreach($get_usereducation as $education){ ?>
                    <div class="col-md-6 col-xl-4">
                        <!--Start Action Button-->
                        <div class="action-btn align-items-center d-flex mb-2">
                            <a href="javascript:void(0)" onclick="educationEdit('<?php echo $education->id; ?>')"
                                class="me-2 text-dark"><i data-feather="edit-3" class="me-1"></i><span>Edit</span></a>
                            <a href="javascript:void(0)" onclick="educationDelete('<?php echo $education->id; ?>')"
                                class="me-2 text-danger"><i data-feather="trash-2"
                                    class="me-1"></i><span>Delete</span></a>
                        </div>
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
<!--End Education-->
<!--Start Certificates-->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <div class="d-flex justify-content-between mb-4">
                    <!--Start Section Header-->
                    <div class="section-header">
                        <h4 class="text-uppercase fw-bold">Credential Certificates</h4>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <div class="d-flex align-items-center btn-act">
                        <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox"
                                value="<?php echo ($instructor_info->is_resumeshow?$instructor_info->is_resumeshow:''); ?>"
                                id="certificateshow"
                                <?php echo (($instructor_info->is_certificateshow == 1) ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="certificateshow">Show</label>
                        </div>
                        <button class="btn btn-dark-cerulean ms-3" onclick="new_certificate()">Add new Certificate
                        </button>
                        <input type="hidden" name="" id="faculty_id"
                            value="<?php echo ($instructor_info->faculty_id?$instructor_info->faculty_id:''); ?>">
                    </div>
                </div>
                <!--Start Certificate Carousel-->
                <div class="row" id="customhandle2">
                    <?php if($certificates){
                        foreach($certificates as $ins_certificate){
                            $certificate_id = $ins_certificate->id;
  $logo = base_url($ins_certificate->institute_logo);
  $certificatelink = base_url($ins_certificate->certificate);
                        ?>
                    <div class="col-md-6" id="certificate_content_<?php echo $certificate_id ?>">

                        <div class="card mb-3">
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
                                            <?php if(!empty($ins_certificate->institute_logo)){?>
                                            <img src="<?php echo $logo?>"
                                                style="height:70px;width:70px;margin:0px;padding:0px;"
                                                class="rounded-circle">
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="text-capitalize mb-1"><?php echo $ins_certificate->certificatename?>
                                        </h5>
                                        <div class="fw-medium text-muted"><?php echo $ins_certificate->year;?></div>
                                    </div>
                                </div>
                                <div class="move_handler">
                                    <a href="javascript:void(0)" class="btn btn-danger"
                                        onclick="delete_certificate(<?php echo $certificate_id;?>)"><i
                                            class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php }}?>


                </div>
                <!--End Certificate Carousel-->
            </div>
        </div>
    </div>
</div>
<!--End Certificates-->

<!--Start Contact-->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-4 p-xl-5">
                <div class="d-flex justify-content-between mb-4">
                    <!--Start Section Header-->
                    <div class="section-header">
                        <h4 class="text-uppercase fw-bold">Contact</h4>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <div class="d-flex align-items-center btn-act">
                        <div class="form-check mb-0">
                            <input class="form-check-input" type="checkbox" value="1" id="is_contactshow"
                                <?php if($instructor_info->is_contactshow ==1){echo 'checked';}?>>
                            <label class="form-check-label" for="is_contactshow">Show</label>
                        </div>
                        <button class="btn btn-dark-cerulean ms-3" onclick="save_contact_data()">
                            <i data-feather="save" class="me-1"></i>Save
                        </button>
                    </div>
                </div>
                <div class="row mb-4 align-items-center">
                    <div class="col-6">
                        <label for="contactText" class="mb-2">Contact Text</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg" id="contactText"
                                aria-label="Text input with checkbox"
                                value="<?php echo ($instructor_info->contact_text?$instructor_info->contact_text:'')?>">
                        </div>

                    </div>
                    <div class="col-6">
                        <label for="public_email" class="mb-2">Public Email</label>
                        <div class="input-group mb-3">

                            <input type="text" class="form-control form-control-lg" id="public_email"
                                aria-label="Dollar amount (with dot and two decimal places)"
                                value="<?php echo ($instructor_info->public_email?$instructor_info->public_email:'')?>">

                        </div>
                    </div>

                    <div class="col-12">
                        <div class="input-group mb-3">
                            <select class="form-control" id="social_link_type" name="social_link">
                                <option selected="" value="">Select Social Link</option>
                                <option value="1">Facebook</option>
                                <option value="2">Twitter</option>
                                <option value="3">Linkedin</option>
                                <option value="4">Instagram</option>
                                <option value="5">Git</option>
                                <option value="6">Youtube</option>
                                <option value="7">Vimeo</option>
                                <option value="8">Website</option>
                            </select>

                            <input type="text" class="form-control form-control-lg"
                                aria-label="Dollar amount (with dot and two decimal places)"
                                placeholder="write your link" id="social_link">
                            <input type="hidden" name="" id="social_link_id">
                            <button class="input-group-text px-4" onclick="save_social_link()">Add</button>
                        </div>
                    </div>
                    <div class="col-12">
                        <div id="sociallinks_tabl" class="list-group col">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Contact-->

<!--Start Popular Course-->
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
                                        <img onclick="get_coursesaveloop(1, '<?php echo $courses->course_id; ?>')"
                                            src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-1.png'); ?>"
                                            class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                        <?php }else {
                                                if($user_type != 5){
                                                ?>
                                        <img onclick="coursesavecheck()"
                                            src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-1.png'); ?>"
                                            class="img-fluid ms-auto " alt="" style="cursor: pointer;">
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
                                        <input class="me-1" style="width:21px;height:21px" type="radio" name="" id=""
                                            onclick="" disabled>
                                        <label class="form-check-label fw-bold opa-half course_price_cart"
                                            for="flexRadioDefault1">
                                            Subscription
                                        </label>
                                    </div>
                                    <div class="align-items-center d-flex form-check ps-0">
                                        <input class="me-1" style="width:21px;height:21px" type="radio" name="" id=""
                                            onclick="" disabled>
                                        <label
                                            class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                            style="width:100%;"
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



<!--Start Popular Course-->


<!-- The Modal -->
<div class="modal fade" id="modal_info" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal_ttl"></h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body modalbody" id="info">

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ex_modal_info" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title ex_modal_ttl"></h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body modalbody" id="ex_info">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="certificate_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new Certificate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body certificatedetails">
            </div>

        </div>
    </div>
</div>

</div>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js'); ?>">
</script>

<script src="<?php echo base_url() ?>assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/dist/js/pages/select2.js"></script>
<!--End Popular Course-->
<script type="text/javascript">
$("document").ready(function() {
    new Sortable(document.getElementById('customhandle'), {
        handle: '.handle', // handle's class
        animation: 150
    });
    new Sortable(document.getElementById('customhandle2'), {
        handle: '.handle', // handle's class
        animation: 150
    });
    new Sortable(document.getElementById('gridDemo'), {
        animation: 150,
        ghostClass: 'blue-background-class'
    });

    ClassicEditor.create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });

});


// ============ its for resumeUpload ====================
("use strict");

function resumeUpload() {
    var user_id = $("#user_id").val();
    if ($('#is_resumeshow').is(":checked")) {
        var is_resumeshow = 1;
    } else {
        var is_resumeshow = 0;
    }
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    var fd = new FormData();
    fd.append("resume", $("#resume")[0].files[0]);

    fd.append("user_id", user_id);
    fd.append("is_resumeshow", is_resumeshow);
    fd.append("old_resume", $("#old_resume").val());
    fd.append("csrf_test_name", csrf_test_name);

    $.ajax({
        url: base_url + "/instructor-resume-upload",
        type: "POST",
        data: fd,
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        success: function(r) {
            toastr["success"](r);
            setTimeout(function() {
                location.reload();
            }, 1000);

        },
    });
}
// ================== its for profileupdate =================
("use strict");

function profileupdate() {
    var user_id = $("#user_id").val();
    // if ($('#is_profileshow').is(":checked")) {
    var is_profileshow = 1;
    // } else {
    //     var is_profileshow = 0;
    // }
    var instructorName = $("#instructorName").val();
    var designation = $("#designation").val();
    var website = $("#website").val();
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    if (instructorName == '') {
        toastr["error"]("Instructor name must be required");
        return false;
    }
    var fd = new FormData();
    fd.append("user_id", user_id);
    fd.append("is_profileshow", is_profileshow);
    fd.append("instructorName", instructorName);
    fd.append("designation", designation);
    fd.append("website", website);
    fd.append("csrf_test_name", csrf_test_name);

    $.ajax({
        url: base_url + "/instructor-profile-update",
        type: "POST",
        data: fd,
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        success: function(r) {
            toastr["success"](r);
            setTimeout(function() {
                location.reload();
            }, 1000);
        },
    });
}
// =============== its for skillsupdate ================
("use strict");

function skillsupdate() {
    var user_id = $("#user_id").val();
    if ($('#is_skillshow').is(":checked")) {
        var is_skillshow = 1;
    } else {
        var is_skillshow = 0;
    }
    var skillsSelect = $("#skillsSelect").val();
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    if (skillsSelect == '') {
        toastr["error"]("Skills must be required");
        return false;
    }
    var fd = new FormData();
    fd.append("user_id", user_id);
    fd.append("is_skillshow", is_skillshow);
    fd.append("skillsSelect", skillsSelect);
    fd.append("csrf_test_name", csrf_test_name);

    $.ajax({
        url: base_url + "/instructor-skill-update",
        type: "POST",
        data: fd,
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        success: function(r) {
            toastr["success"](r);
            setTimeout(function() {
                location.reload();
            }, 1000);
        },
    });
}
// =============== its for proficiencyupdate =================
("use strict");

function proficiencyupdate() {
    var user_id = $("#user_id").val();
    var enterprise_id = $("#enterprise_id").val();

    if ($('#is_proficiencyshow').is(":checked")) {
        var is_proficiencyshow = 1;
    } else {
        var is_proficiencyshow = 0;
    }
    var proficiencySelect = $("#proficiencySelect").val();
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    // if (proficiencySelect == '') {
    //     toastr["error"]("Proficiency must be required");
    //     return false;
    // }
    var fd = new FormData();
    fd.append("user_id", user_id);
    fd.append("is_proficiencyshow", is_proficiencyshow);
    fd.append("proficiencySelect", proficiencySelect);
    fd.append("enterprise_id", enterprise_id);
    fd.append("csrf_test_name", csrf_test_name);

    $.ajax({
        url: base_url + "/instructor-proficiency-update",
        type: "POST",
        data: fd,
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        success: function(r) {
            toastr["success"](r);
            setTimeout(function() {
                location.reload();
            }, 1000);
        },
    });
}
// ============= its for proficiency_delete ===============
("use strict");

function proficiency_delete(id) {
    var r = confirm("Do you want to delete?");
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    if (r == true) {
        $.ajax({
            url: base_url + "/student-proficiency-delete",
            type: "POST",
            data: {
                csrf_test_name: csrf_test_name,
                id: id
            },
            success: function(r) {
                toastr["success"](r);
                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
        });
    }
}

// =============== its for featureshowupdate =================
("use strict");

function featureshowupdate() {
    var user_id = $("#user_id").val();
    var enterprise_id = $("#enterprise_id").val();

    if ($('#is_featureshow').is(":checked")) {
        var is_featureshow = 1;
    } else {
        var is_featureshow = 0;
    }
    var is_featureshow = is_featureshow;
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";

    var fd = new FormData();
    fd.append("user_id", user_id);
    fd.append("is_featureshow", is_featureshow);
    fd.append("enterprise_id", enterprise_id);
    fd.append("csrf_test_name", csrf_test_name);

    $.ajax({
        url: base_url + "/instructor-featureshow-update",
        type: "POST",
        data: fd,
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        success: function(r) {
            toastr["success"](r);
            setTimeout(function() {
                location.reload();
            }, 1000);
        },
    });
}

$(document).ready(function() {
    "use strict";
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    var enterprise_id = $("#enterprise_id").val();
    let BioEditor;

    ClassicEditor.create(document.querySelector("#bioeditor"), {
            toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList']
        })
        .then((bioeditor) => {
            BioEditor = bioeditor;
        })
        .catch((error) => {
            console.error(error);
        });

    // ClassicEditor.create(document.querySelector("#bioeditor"))
    //     .then((bioeditor) => {
    //         BioEditor = bioeditor;
    //     })
    //     .catch((error) => {
    //         console.error(error);
    //     });

    function getDataFromBioEditor() {
        return BioEditor.getData();
    }

    document.getElementById("instructorbiographysave").addEventListener("click", () => {
        var notes = getDataFromBioEditor();
        // alert(notes);return false;
        var user_id = $("#user_id").val();
        if ($('#is_biographyshow').is(":checked")) {
            var is_biographyshow = 1;
        } else {
            var is_biographyshow = 0;
        }
        if (notes == '') {
            toastr["error"]("Biography must be required");
            return false;
        }
        var fd = new FormData();
        fd.append("user_id", user_id);
        fd.append("is_biographyshow", is_biographyshow);
        fd.append("notes", notes);
        fd.append("csrf_test_name", csrf_test_name);
        $.ajax({
            url: base_url + "/instructor-biography-update",
            type: "POST",
            data: fd,
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            success: function(r) {
                toastr["success"](r);
                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
        });
    });


    $("input.proficiency-typeahead").typeahead({
        highlight: true,
        minLength: 1,
        source: function(query, result) {
            $.ajax({
                url: base_url + "/autocomplete-proficiency-search",
                data: {
                    csrf_test_name: csrf_test_name,
                    query: query,
                    enterprise_id: enterprise_id,
                },
                dataType: "json",
                type: "POST",
                success: function(data) {
                    result(
                        $.map(data, function(item) {
                            return item.title;
                            // return item.title+"->"+item.proficiency_id;
                        })
                    );
                },
            });
        },
        autoSelect: false,
    });

    //    ============ its for is popular value add ============
    $("body").on("click", "#is_experienceshow", function() {
        if ($("#is_experienceshow").is(":checked")) {
            $("#is_experienceshow").attr("value", "1");
        } else {
            $("#is_experienceshow").attr("value", "0");
        }
    });


});

// ============ its for addmoreexperience ==============
("use strict");
ex = 0;
exx = 1;

function addmoreexperience() {
    var yeardynamic = $("#yeardynamic").val();
    ex++;
    exx++;
    $("#experience_area").append(
        '<div id="rmvEx' +
        ex +
        '"><hr>\n\
    <div class="row">\n\
        <div class="col-md-6">\n\
            <div class="mb-3">\n\
                <label for="companyname" class="form-label mb-1 fw-medium">Company <i class="text-danger"> </i></label>\n\
                <input type="text" class="form-control form-control-lg" id="companyname" name="companyname[]">\n\
            </div>\n\
        </div>\n\
        <div class="col-md-6">\n\
            <div class="mb-3">\n\
                <label for="cityname" class="form-label mb-1 fw-medium">City</label>\n\
                <input type="text" class="form-control form-control-lg" id="cityname" name="cityname[]">\n\
            </div>\n\
        </div>\n\
        <div class="col-md-6">\n\
            <div class="mb-3">\n\
                <label for="title" class="form-label mb-1 fw-medium">Title  <i class="text-danger"> </i></label>\n\
                <input type="text" class="form-control form-control-lg" id="title" name="title[]">\n\
            </div>\n\
        </div>\n\
        <div class="col-md-6">\n\
            <div class="mb-3">\n\
                <label for="country" class="form-label mb-1 fw-medium">Country </label>\n\
                <input type="text" class="form-control form-control-lg" id="country" name="country[]">\n\
            </div>\n\
        </div>\n\
    </div>\n\
    <div class="row gx-3 gy-2 align-items-end mb-4">\n\
        <div class="col-sm-2">\n\
            <label for="frommonth">From</label>\n\
            <select class="form-select" id="frommonth" name="frommonth[]">\n\
                <option selected>Choose Month</option>\n\
                <option value="January">January</option>\n\
                <option value="February">February</option>\n\
                <option value="March">March</option>\n\
                <option value="April">April</option>\n\
                <option value="May">May</option>\n\
                <option value="June">June</option>\n\
                <option value="July">July</option>\n\
                <option value="August">August</option>\n\
                <option value="September">September</option>\n\
                <option value="October">October</option>\n\
                <option value="November">November</option>\n\
                <option value="December">December</option>\n\
            </select>\n\
        </div>\n\
        <div class="col-sm-2">\n\
            <label class="visually-hidden" for="fromyear">year</label>\n\
            <select class="form-select" id="fromyear" name="fromyear[]">\n\
                <option selected>Choose Year</option>\n\
                ' +
        yeardynamic +
        '\n\
            </select>\n\
        </div>\n\
        <div class="toaddareahide_' + exx + '" style="display: contents;">\n\
        <div class="col-auto me-3">\n\
            <span class="fromto"></span>\n\
        </div>\n\
        <div class="col-sm-2 me-3">\n\
            <label for="tomonth">To</label>\n\
            <select class="form-select" id="tomonth" name="tomonth[]">\n\
                <option selected>Choose Month</option>\n\
                <option value="January">January</option>\n\
                <option value="February">February</option>\n\
                <option value="March">March</option>\n\
                <option value="April">April</option>\n\
                <option value="May">May</option>\n\
                <option value="June">June</option>\n\
                <option value="July">July</option>\n\
                <option value="August">August</option>\n\
                <option value="September">September</option>\n\
                <option value="October">October</option>\n\
                <option value="November">November</option>\n\
                <option value="December">December</option>\n\
            </select>\n\
        </div>\n\
        <div class="col-sm-2">\n\
            <label class="visually-hidden" for="toyear">year</label>\n\
            <select class="form-select" id="toyear" name="toyear[]">\n\
                <option selected>Choose Year</option>\n\
                ' + yeardynamic + '\n\
            </select>\n\
        </div>\n\
        </div>\n\
        <div class="col-auto">\n\
            <div class="form-check">\n\
                <input class="form-check-input" type="checkbox" onclick="isNowworking(' + exx + "," + "'add'" +
        ')" id="nowworking_' +
        exx +
        '" name="nowworking[]">\n\
                <input type="hidden" name="hdn_nowworking[]" id="hdn_nowworking_' +
        exx +
        '">\n\
                <label class="form-check-label" for="nowworking_' +
        exx +
        '"> I currently work here </label>\n\
            </div>\n\
        </div>\n\
        <div class="col-auto">\n\
            <button type="button" class="btn btn-danger" onclick="removeexperience(this)">Delete</button>\n\
        </div>\n\
    </div>\n\
     </div>'
    );
}

// ("use strict");
// function isNowworking(sl) {
//     if ($("#nowworking_" + sl).is(":checked")) {
//         $("#nowworking_" + sl).attr("value", "1");
//         $("#hdn_nowworking_" + sl).val(1);
//     } else {
//         $("#nowworking_" + sl).attr("value", "0");
//         $("#hdn_nowworking_" + sl).val(0);
//     }
// }


("use strict");

function isNowworking(sl, mode) {
    if (mode == "add") {
        if ($("#nowworking_" + sl).is(":checked")) {
            $("#nowworking_" + sl).attr("value", "1");
            $("#hdn_nowworking_" + sl).val(1);
        } else {
            $("#nowworking_" + sl).attr("value", "0");
            $("#hdn_nowworking_" + sl).val(0);
        }
        $(".toaddareahide_" + sl).slideToggle();
    } else {
        $(".toeditareahide").slideToggle();
        $("#isnow").val(0);
        // $(".toeditareahide").css("display", "block");
        if ($("#nowworking_edit").is(":checked")) {
            $("#nowworking_edit").attr("value", "1");
            $("#hdn_nowworking_" + sl).val(1);
        } else {
            $("#nowworking_edit").attr("value", "0");
            $("#hdn_nowworking_" + sl).val(0);
        }
    }
}

("use strict");

function removeexperience(experienceElem) {
    var parentid = $(experienceElem).parent().parent().parent().remove();
}

("use strict");

function facultyexpericen_update(id) {
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    $.ajax({
        url: base_url + "/instructor-experience-editdata",
        type: "POST",
        data: {
            csrf_test_name: csrf_test_name,
            id: id
        },
        success: function(r) {
            $(".ex_modal_ttl").html("Experience information update");
            $("#ex_info").html(r);
            $("#ex_modal_info").modal("show");
        },
    });
}


// ============ its for experienceinfo_update ================
("use strict");

function instructorexperienceinfo_update(id) {
    var companyname = $("#edit_companyname").val();
    var edit_title = $("#edit_title").val();
    var edit_city = $("#edit_city").val();
    var edit_country = $("#edit_country").val();
    var edit_frommonth = $("#edit_frommonth").val();
    var edit_fromyear = $("#edit_fromyear").val();
    var edit_tomonth = $("#edit_tomonth").val();
    var edit_toyear = $("#edit_toyear").val();
    var nowworking = $("#nowworking_1").val();
    if ($("#is_experienceshow").is(":checked")) {
        var is_experienceshow = 1;
    } else {
        var is_experienceshow = 0;
    }
    var user_id = $("#user_id").val();
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    var fd = new FormData();
    fd.append("id", id);
    fd.append("user_id", user_id);
    fd.append("companyname", companyname);
    fd.append("title", edit_title);
    fd.append("city", edit_city);
    fd.append("country", edit_country);
    fd.append("frommonth", edit_frommonth);
    fd.append("fromyear", edit_fromyear);
    fd.append("tomonth", edit_tomonth);
    fd.append("toyear", edit_toyear);
    fd.append("is_now", nowworking);
    fd.append("is_experienceshow", is_experienceshow);
    fd.append("csrf_test_name", csrf_test_name);

    $.ajax({
        url: base_url + "/instructor-experience-update",
        type: "POST",
        data: fd,
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        success: function(r) {
            toastr["success"](r);
            $("#modal_info").modal("hide");
            setTimeout(function() {
                location.reload();
            }, 1000);
        },
    });
}


// ============= its for student experience delete ===============
("use strict");

function instructor_expericenedelete(id) {
    var r = confirm("Do you want to delete?");
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    if (r == true) {
        $.ajax({
            url: base_url + "/student-experience-delete",
            type: "POST",
            data: {
                csrf_test_name: csrf_test_name,
                id: id
            },
            success: function(r) {
                toastr["success"](r);
                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
        });
    }
}


//=============== its for addmoreeducation ========================
("use strict");
edu = 0;
eduu = 1;

function addmoreeducation() {
    edu++;
    eduu++;
    var yeardynamic = $("#passingyearhv").val();

    $("#education_area").append(
        '<div id="rmvEdu' +
        edu +
        '"><hr>\n\
                        <div class="row mb-4">\n\
                            <div class="col-md-6">\n\
                                <div class="mb-3">\n\
                                    <label for="institutename_' +
        eduu +
        '" class="form-label mb-1 fw-medium">School/College/University/Institute *</label>\n\
                                    <input type="text" class="form-control form-control-lg" id="institutename_' +
        eduu +
        '" name="institutename[]">\n\
                                </div>\n\
                            </div>\n\
                            <div class="col-md-6">\n\
                                <div class="mb-3">\n\
                                    <label for="degreename_' +
        eduu +
        '" class="form-label mb-1 fw-medium">Degree</label>\n\
                                    <input type="text" class="form-control form-control-lg" id="degreename_' +
        eduu +
        '" name="degreename[]]">\n\
                                </div>\n\
                            </div>\n\
                        </div>\n\
                        <div class="row gx-3 gy-2 align-items-end mb-5">\n\
                            <div class="col-auto">\n\
                                <label class="visually-hidden" for="passing_year_' +
        eduu +
        '">Passing Year</label>\n\
                                <select class="form-select" id="passingyear_' +
        eduu +
        '" name="passing_year[]">\n\
                                <option selected>Choose Passing Year</option>\n\
                               ' +
        yeardynamic +
        '\n\
                                </select>\n\
                            </div>\n\
                            <div class="col-auto ms-auto">\n\
                                <button type="button" class="btn btn-danger" onclick="removeeducation(this)">Delete</button>\n\
                            </div>\n\
                        </div>\n\
                    </div>'
    );
}

("use strict");

function removeeducation(experienceElem) {
    var parentid = $(experienceElem).parent().parent().parent().remove();
}

//    ================== its for educationEdit  ===========
("use strict");

function educationEdit(id) {
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    $.ajax({
        url: base_url + "/instructor-education-editdata",
        type: "POST",
        data: {
            csrf_test_name: csrf_test_name,
            id: id
        },
        success: function(r) {
            $(".modal_ttl").html("Education information update");
            $("#info").html(r);
            $("#modal_info").modal("show");
        },
    });
}

// ============ its for educationinfo_update ================
("use strict");

function educationinfo_update(id) {
    var institutename = $("#institutename").val();
    var degree = $("#degree").val();
    var user_id = $("#user_id").val();
    var passing_year = $("#passing_year").val();
    var fd = new FormData();
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    fd.append("id", id);
    fd.append("user_id", user_id);
    fd.append("institutename", institutename);
    fd.append("degree", degree);
    fd.append("passing_year", passing_year);
    fd.append("csrf_test_name", csrf_test_name);

    $.ajax({
        url: base_url + "/instructor-education-update",
        type: "POST",
        data: fd,
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        success: function(r) {
            toastr["success"](r);
            $("#modal_info").modal("hide");
            setTimeout(function() {
                location.reload();
            }, 1000);
        },
    });
}

// ============= its for student education delete ===============
("use strict");

function educationDelete(id) {
    var r = confirm("Do you want to delete?");
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    if (r == true) {
        $.ajax({
            url: base_url + "/student-education-delete",
            type: "POST",
            data: {
                csrf_test_name: csrf_test_name,
                id: id
            },
            success: function(r) {
                toastr["success"](r);
                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
        });
    }
}
//=========== its for valid mail check ===============
("use strict");

function IsEmail(email) {
    var regex =
        /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    } else {
        return true;
    }
}

function save_contact_data() {
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    var user_id = $("#user_id").val();
    var contact_text = $("#contactText").val();
    var public_email = $("#public_email").val();
    if ($('#is_contactshow').is(":checked")) {
        var is_contactshow = 1;
    } else {
        var is_contactshow = 0;
    }
    if(!empty(public_email)){
    if (IsEmail(public_email) == false) {
        toastrErrorMsg("invalid email address!");
        return false;
    }
   }

    $.ajax({
        url: base_url + "/instructor-contact-save",
        type: "POST",
        data: {
            csrf_test_name: csrf_test_name,
            user_id: user_id,
            contact_text: contact_text,
            public_email: public_email,
            is_contactshow: is_contactshow
        },
        success: function(r) {
            toastr["success"](r);
            setTimeout(function() {
                location.reload();
            }, 1000);
        },
    });
}

function save_social_link() {
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    var user_id = $("#user_id").val();
    var social_link_type = $("#social_link_type").val();
    var social_link = $("#social_link").val();
    var social_link_id = $("#social_link_id").val();
    if (social_link_type == '') {
        toastr["error"]('Please Select Social link type');
        return false;
    }
    if (social_link == '') {
        toastr["error"]('Please Add Social link');
        return false;
    }
    $.ajax({
        url: base_url + "/instructor-sociallink-save",
        type: "POST",
        data: {
            csrf_test_name: csrf_test_name,
            user_id: user_id,
            social_link_type: social_link_type,
            social_link: social_link,
            social_link_id: social_link_id
        },
        success: function(r) {
            toastr["success"](r);
            $("#social_link").val('');
            // $("#social_link_type option").attr("selected", false);
            // $('#social_link_type').find('option:empty');
            // $('#social_link_type').append('<option value="">Select social link</option>');
            instructor_sociallinks();
        },
    });

}



function instructor_sociallinks() {
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    var user_id = $("#user_id").val();
    $.ajax({
        url: base_url + "/instructor-sociallink-list",
        type: "POST",
        data: {
            csrf_test_name: csrf_test_name,
            user_id: user_id
        },
        success: function(data) {
            $('#sociallinks_tabl').html(data);
        }
    });
}

function delete_social_link(id) {
    var r = confirm("Do you want to delete?");
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    if (r == true) {
        $.ajax({
            url: base_url + "/instructor-sociallink-delete",
            type: "POST",
            data: {
                csrf_test_name: csrf_test_name,
                id: id
            },
            success: function(r) {
                toastr["success"](r);
                instructor_sociallinks();
            }
        });
    }
}

function social_update(sl, mode) {
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
    var user_id = $("#user_id").val();
    var social_link_type = $("#social_link_type_" + sl).val();
    var social_link = $("#social_link_" + sl).val();
    var social_link_id = $("#social_link_id_" + sl).val();
    if (social_link_type == '') {
        toastr["error"]('Please Select Social link type');
        return false;
    }
    if (social_link == '') {
        toastr["error"]('Please Add Social link');
        return false;
    }
    $.ajax({
        url: base_url + "/instructor-sociallink-save",
        type: "POST",
        data: {
            csrf_test_name: csrf_test_name,
            mode: mode,
            user_id: user_id,
            social_link_type: social_link_type,
            social_link: social_link,
            social_link_id: social_link_id
        },
        success: function(r) {
            toastr["success"](r);
            $("#social_link").val('');
            instructor_sociallinks();
        },
    });
}


// setInterval(function() {
instructor_sociallinks();
// }, 2000);

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

// =============== its for instructor projectdelete ====================
"use strict";

function instructorprojectdelete(project_id) {
    var base_url = $("#base_url").val();
    var enterprise_shortname = $("#enterprise_shortname").val();
    var enterprise_id = $("#enterprise_id").val();
    var CSRF_TOKEN = $("#CSRF_TOKEN").val();

    var r = confirm("Do you want to delete?");
    if (r == true) {
        $.ajax({
            url: base_url + enterprise_shortname + "/instructor-project-delete",
            type: "POST",
            data: {
                csrf_test_name: CSRF_TOKEN,
                project_id: project_id,
                enterprise_id: enterprise_id,
            },
            success: function(r) {
                toastr["error"](r);
                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
        });
    }
}

// =========resume_upload_delete==================
("use strict");

function resume_upload_delete() {
    var user_id = $("#user_id").val();
    var fd = new FormData();

    fd.append("user_id", user_id);
    fd.append("csrf_test_name", CSRF_TOKEN);
    var r = confirm("Do you want to delete?");
    if (r == true) {
        $.ajax({
            url: base_url + enterprise_shortname + "/instructor-resume-upload-delete",
            type: "POST",
            data: fd,
            enctype: "multipart/form-data",
            processData: false,
            contentType: false,
            success: function(r) {
                toastrSuccessMsg(r);
            },
        });
    }
}

function new_certificate() {
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var url = $("#base_urlrm").val();
    $.ajax({
        url: url + "/instructor-new-certificate",
        type: "POST",
        data: {
            csrf_test_name: csrf_test_name
        },
        success: function(data) {

            $('.certificatedetails').html(data);
            $('#certificate_modal').modal('show');

        },
        error: function(xhr) {
            alert('failed!');
        }
    });
}




$('body').on('click', '#new_certificate_add', function(event) {
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var url = $("#base_urlrm").val();
    var fd = new FormData();
    fd.append("certificatename", $('[name="certificatename"]').val());
    // fd.append("certificatename", $('[name="certificatename"]').val());
    fd.append("faculty_id", $('[name="faculty_id"]').val());
    fd.append("pyear", $('[name="pyear"]').val());
    fd.append("certificate", $("#certificate")[0].files[0]);
    fd.append("organization_logo", $("#organization_logo")[0].files[0]);
    fd.append("csrf_test_name", csrf_test_name);
    var certificatename = $('[name="certificatename"]').val();
    var pyear = $('[name="pyear"]').val();
     if(certificatename ==""){
        toastr["error"]('Certificate name is require');
        return false;
     }
     if(pyear ==""){
        toastr["error"]('Year is require');
        return false;
     }

    $.ajax({
        url: url + '/instructor-certificate-save',
        method: 'POST',
        enctype: "multipart/form-data",
        data: fd,
        processData: false,
        contentType: false,
        success: function(data) {
            toastr["success"]('Certificate add successfully');
            $("#customhandle2").append(data);
            $('#certificate_modal').modal('hide');
        },
        // error: function(xhr) {
        //     alert('failed!');
        // }
    });


});

function delete_certificate(id) {
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = $("#base_urlrm").val();
    var r = confirm("Do you want to delete?");
    if (r == true) {

        $.ajax({
            url: base_url + "/instructor-certificate-delete",
            type: "POST",
            data: {
                csrf_test_name: csrf_test_name,
                certificate_id: id,
            },
            success: function(r) {
                var div = document.getElementById("certificate_content_" + id);
                div.parentNode.removeChild(div);
                toastr["success"](r);

            },
        });


    }
}

$('#certificateshow').on('click', function() {

    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = $("#base_urlrm").val();
    var faculty_id = $("#faculty_id").val();
    if ($('#certificateshow').is(":checked")) {
        var is_show = 1;

    } else {
        var is_show = 0;

    }

    $.ajax({
        url: base_url + "/instructor-certificate-showhide",
        type: "POST",
        data: {
            csrf_test_name: csrf_test_name,
            is_show: is_show,
            faculty_id: faculty_id,
        },
        success: function(r) {
            toastr["success"](r);

        },
    });


});







// =============== its for  file type check ===============
function filetypecheck(fileid) {
    var allowedTypes = [
        "application/pdf",
        "application/msword",
        "application/vnd.ms-office",
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
        "image/jpeg",
        "image/png",
        "image/jpg",
        "image/gif",
    ];

    // var file = this.files[0];
    var file = $("#" + fileid)[0].files[0];
    var fileType = file.type;
    if (!allowedTypes.includes(fileType)) {
        alert("Please select a valid file (PDF/DOC/DOCX/JPEG/JPG/PNG/GIF).");
        $("#" + fileid).val("");
        return false;
    }
}

// ============= its for uploadCV ==============
function uploadCV(fileid) {
    filetypecheck(fileid);
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var fd = new FormData();

    fd.append("resume", $("#resume")[0].files[0]);

    if ($('#is_resumeshow').is(":checked")) {
        var is_resumeshow = 1;
    } else {
        var is_resumeshow = 0;
    }
    
    fd.append("user_id", user_id);
    fd.append("is_resumeshow", is_resumeshow);
    fd.append("old_resume", $("#old_resume").val());
    fd.append("csrf_test_name", csrf_test_name);


    // fd.append("name", $("#resume").val());
    $.ajax({
        type: "POST",
        url: base_url + enterprise_shortname + "/instructor-fileupload-progressbar-check",
        // data: new FormData(this),
        data: fd,
        contentType: false,
        cache: false,
        processData: false,

        error: function() {
            $("#uploadStatus").html(
                '<p style="color:#EA4335;">File upload failed, please try again.</p>'
            );
        },
        success: function(resp) {
            console.log(resp);
            if (resp == "ok") {
                $("#uploadStatus").html(
                      '<p style="color:#28A74B;">File has uploaded successfully!</p>'
                );
                $(".progress-area").html(
                    '<div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">100%</div></div>'
                );
            } else if (resp == "err") {
                $(".progress-area").html("");
                $("#uploadStatus").html(
                    '<p style="color:#EA4335;">Please select a valid file to upload.</p>'
                );
            }
        },
    });
}
</script>