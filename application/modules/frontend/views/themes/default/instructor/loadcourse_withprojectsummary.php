<div class="py-4 bg-alice-blue">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-3 p-md-4 p-xl-5">
                <div class="row">
                    <div class="col-xxl-3 col-lg-4 col-md-6">
                        <!--Start Course Card-->
                        <div
                            class="course-card rounded-20 bg-white position-relative overflow-hidden shadow-none border mb-3">
                            <div class="course-card_top position-relative">
                                <div class="position-relative">
                                    <!--Start Course Image-->
                                    <a href="javascript:void(0)" class="course-card_img">
                                        <img src="<?php echo base_url(!empty($get_courseinfo->picture) ? $get_courseinfo->picture : default_600_400()); ?>"
                                            class="img-fluid w-100" alt="">
                                    </a>
                                    <!--End Course Image-->
                                    <!--Start items badge-->
                                    <div
                                        class="align-items-center top-0 d-flex fs-12 position-absolute px-3 py-2 start-0 text-white w-100">
                                        <span class="badge bg-success me-1">New </span>
                                        <span
                                            class="badge bg-electric-indigo"><?php echo (!empty($get_courseinfo->category_name) ? $get_courseinfo->category_name : ''); ?></span>
                                    </div>
                                    <!--End items badge-->
                                </div>
                                <!--Start Course Card Body-->
                                <div class="course-card_body bg-prussian-blue text-white p-3 position-relative">
                                    <!--Start Course Title-->
                                    <h3 class="course-card__course--title text-capitalize fs-6 mb-0">
                                        <a href="javascript:void(0)"
                                            class="text-white text-decoration-none"><?php echo (!empty($get_courseinfo->name) ? $get_courseinfo->name : ''); ?></a>
                                    </h3>
                                    <!--End Course Title-->
                                    <!--Start Course instructor-->
                                    <div class="course-card__instructor mb-3">
                                        <div
                                            class="course-card__instructor--name text-white-50 text-uppercase fw-light fs-13">
                                            by
                                            <?php echo (!empty($get_courseinfo->instructor_name) ? $get_courseinfo->instructor_name : ''); ?>
                                        </div>
                                    </div>
                                    <!--End Course instructor-->
                                    <!--Start Course Hints-->
                                    <table class="course-card__hints table table-borderless table-sm text-white mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="ps-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="course-card__hints--icon me-2">
                                                            
                                                            <div class="d-flex align-items-center">
                                                                <?php
                                                                 if ($get_courseinfo->course_level == 1) {?>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bar-custom me-2">
                                                                        <span class="fill"></span>
                                                                        <span></span>
                                                                        <span></span>
                                                                    </div>
                                                                    <span>Beginner</span>
                                                                </div>
                                                                <?php } elseif ($get_courseinfo->course_level == 2) {?>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bar-custom me-2">
                                                                        <span class="fill"></span>
                                                                        <span class="fill"></span>
                                                                        <span></span>
                                                                    </div>
                                                                    <span>Intermediate</span>
                                                                </div>
                                                                <?php } elseif ($get_courseinfo->course_level == 3) {?>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="bar-custom me-2">
                                                                        <span class="fill"></span>
                                                                        <span class="fill"></span>
                                                                        <span class="fill"></span>
                                                                    </div>
                                                                    <span>Advanced</span>
                                                                </div>
                                                                <?php }?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="course-card__hints--icon me-2">
                                                            <svg id="clock_1_" data-name="clock (1)"
                                                                xmlns="http://www.w3.org/2000/svg" width="16.706"
                                                                height="16.706" viewBox="0 0 16.706 16.706">
                                                                <path id="Path_13" data-name="Path 13"
                                                                    d="M8.353,0a8.353,8.353,0,1,0,8.353,8.353A8.363,8.363,0,0,0,8.353,0Zm0,15.662a7.309,7.309,0,1,1,7.309-7.309,7.317,7.317,0,0,1-7.309,7.309Z"
                                                                    fill="#fff" />
                                                                <path id="Path_14" data-name="Path 14"
                                                                    d="M208.838,83.118h-1.044v5.437l3.285,3.285.738-.738-2.979-2.979Z"
                                                                    transform="translate(-199.963 -79.985)"
                                                                    fill="#fff" />
                                                            </svg>
                                                        </div>
                                                        <div class="course-card__hints--text">
                                                        <?php 
                                                                $course_wise_lesson = $this->Course_model->course_wise_lesson( $get_courseinfo->course_id);
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
                                                    
                                                                echo $hours."hr" ." ".$minutes."m"?>
                                                                <!-- echo "hr ".$hours ." m ".$minutes . " S ". $seconds;?> -->
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="ps-0">
                                                    <div class="d-flex align-items-center">
                                                        <div class="course-card__hints--icon me-2">
                                                            <svg id="document" xmlns="http://www.w3.org/2000/svg"
                                                                width="17.26" height="14.926"
                                                                viewBox="0 0 17.26 14.926">
                                                                <path id="Path_148" data-name="Path 148"
                                                                    d="M16.065,17.081H1.2a1.2,1.2,0,0,0-1.2,1.2V28.364a1.2,1.2,0,0,0,1.2,1.2h8.67l-.262,1.6a.69.69,0,0,0,1.041.75l1.871-.985a.393.393,0,0,1,.248,0l1.871.985a.834.834,0,0,0,.388.1.656.656,0,0,0,.387-.123.726.726,0,0,0,.266-.728l-.262-1.6h.651a1.2,1.2,0,0,0,1.2-1.2V18.277A1.2,1.2,0,0,0,16.065,17.081ZM12.64,27.511a2.084,2.084,0,1,1,2.084-2.084A2.086,2.086,0,0,1,12.64,27.511Zm.6,2.5a1.383,1.383,0,0,0-1.2,0l-1.323.7.42-2.565a3.1,3.1,0,0,0,3.007,0l.164,1v.005l.256,1.56Zm2.994-1.651a.173.173,0,0,1-.171.171h-.819l-.187-1.142s0-.009,0-.013a3.108,3.108,0,1,0-4.831,0l0,.013-.187,1.142H1.2a.173.173,0,0,1-.171-.171V18.277a.173.173,0,0,1,.171-.171H16.065a.173.173,0,0,1,.171.171Z"
                                                                    transform="translate(0 -17.081)" fill="#fff" />
                                                                <path id="Path_149" data-name="Path 149"
                                                                    d="M43.246,60.243H31.631a.512.512,0,0,0,0,1.025H43.246a.512.512,0,0,0,0-1.025Z"
                                                                    transform="translate(-28.993 -57.295)"
                                                                    fill="#fff" />
                                                                <path id="Path_15006" data-name="Path 150"
                                                                    d="M36.55,100.911H31.631a.512.512,0,0,0,0,1.025H36.55a.512.512,0,0,0,0-1.025Z"
                                                                    transform="translate(-28.993 -95.184)"
                                                                    fill="#fff" />
                                                            </svg>
                                                        </div>
                                                        <div class="course-card__hints--text">
                                                        <?php echo html_escape($enterprise_shortname)?>  Academy Certified
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--End Course Hints-->
                                </div>
                                <!--End Course Card Body-->
                            </div>
                        </div>
                        <!--End Course Card-->
                    </div>
                    <div class="col-xxl-9 col-lg-8 col-md-6">
                        <div class="mb-3">
                            <h4 class="mb-3">Total Projects - <?php echo $reviewpending_projectcount; ?></h4>
                        </div>
                        <div class="class-carousel owl-carousel owl-theme no-transform">
                            <?php if($get_reviewpendingproject){ 
                               foreach($get_reviewpendingproject as $project){
                               ?>
                            <div class="course-card border p-3">
                                <div class="h5">Project :
                                    <?php echo (!empty($project->title) ? $project->title : ''); ?></div>
                                <?php if($project->section_name){ ?>
                                <div class="h5">Chapter : <?php echo $project->section_name; ?></div>
                                <?php } ?>
                                <?php if($project->lesson_name){ ?>
                                <div class="h5">Lesson : <?php echo $project->lesson_name; ?></div>
                                <?php } ?>
                                <!-- <p>Details: How to create a website using html, css, jquery, javascript and bootstrap.</p> -->
                            </div>
                            <?php  
                            } 
                        }else{  ?>
                            <p class="text-left text-danger">
                                Record not found!
                            </p>
                            <?php } ?>
                            <!-- <div class="course-card border p-3">
                                <div class="h5">Project : 01</div>
                                <div class="h5">Chapter : 11, Lesson: 04</div>
                                <p>Details: How to create a website using html, css, jquery, javascript and bootstrap.
                                </p>
                            </div>
                            <div class="course-card border p-3">
                                <div class="h5">Project : 01</div>
                                <div class="h5">Chapter : 11, Lesson: 04</div>
                                <p>Details: How to create a website using html, css, jquery, javascript and bootstrap.
                                </p>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.class-carousel').owlCarousel({
        loop: true,
        margin: 20,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<i class='fas fa-caret-left'></i>", "<i class='fas fa-caret-right'></i>"]
    })

})
</script>