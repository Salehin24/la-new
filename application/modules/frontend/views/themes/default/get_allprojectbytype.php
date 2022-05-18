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
				}else{ ?>
                <p class="text-center text-danger">Record not found</p>
               <?php }				 ?>
            </div>
        </div>