<div class="project-carousel owl-carousel owl-theme">
    <!--Start Project Card-->
    <?php if($get_typewisproject){ ?>
    <?php foreach($get_typewisproject as $project){ ?>
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
                    <div class="mb-1 fs-13"><i data-feather="message-circle" class="me-1"></i>1</div>
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
            <?php if($mode == 'edit'){ ?>
            <a href="<?php echo base_url($enterprise_shortname . '/instructor-project-edit/'. $project->project_id); ?>"
                class="me-2 text-dark">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-edit-3">
                    <path d="M12 20h9"></path>
                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                </svg>
                <span>Edit</span></a>
            </a>
            <a href="javascript:void(0)" class="me-2 text-danger"
                onclick="instructorprojectdelete('<?php echo $project->project_id; ?>')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-trash-2">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line>
                    <line x1="14" y1="11" x2="14" y2="17"></line>
                </svg>
                <span>Delete</span></a>
            </a>
            <?php } ?>
        </div>
        <!--End Action Button-->
    </div>
    <?php } ?>
    <?php }else{ ?>
    <p class="text-danger">Record not found!</p>
    <?php } ?>
    <!--End Project Card-->
</div>

<script>
$(document).ready(function() {
    $('.project-carousel').owlCarousel({
        loop: false,
        margin: 20,
        dots: false,
        nav: true,
        navText: ["<i class='fas fa-caret-left'></i>", "<i class='fas fa-caret-right'></i>"],
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 2
            },
            768: {
                items: 4
            },
            992: {
                items: 5
            },
            1200: {
                items: 6
            }
        }
    });
});
</script>