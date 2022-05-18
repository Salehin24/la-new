<!--Start Course Preview Header-->
<div class="hero-header text-white position-relative bg-img"
    data-image-src="<?php echo base_url(!empty(getappsettings($enterprise_id)->event_header_image) ? getappsettings($enterprise_id)->event_header_image : default_600_400()); ?>">
    <div class="container-lg hero-header_wrap position-relative">
        <div class="row align-items-end my-5">
            <div class="col-8 offset-2 text-center">
                <h1 class="fw-semi-bold mb-3">Live Events</h1>
                <!-- <h5>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</h5> -->
            </div>
        </div>
    </div>
</div>
<!--End Course Preview Header-->
<div class="bg-alice-blue pt-5">
    <div class="container-xl">
        <div class="row g-4">
            <div class="col-lg-12 sticky-content">
                <?php if($get_eventlist) { ?>
                <div class="row mb-4 g-3">
                    <?php 
						 foreach($get_eventlist as $event){
						?>
                    <div class="col-sm-4">
                        <!--Start Course Card-->
                        <div class="course-card rounded bg-white position-relative overflow-hidden shadow-none border">
                            <!--Start Course Image-->
                            <a href="<?php echo base_url($enterprise_shortname.'/event-details/'.$event->course_id); ?>"
                                class="course-card_img">
                                <img src="<?php echo base_url((!empty($event->picture)?$event->picture:default_600_400()));?>"
                                    class="img-fluid w-100" alt="">
                            </a>
                            <!--End Course Image-->
                            <!--Start Course Card Body-->
                            <div class="course-card_body bg-prussian-blue p-4 position-relative m-0 rounded-0 bg-white">
                                <!--Start Course Title-->
                                <div class="badge px-0 mb-2">
                                    <a href="<?php echo base_url($enterprise_shortname.'/event-details/'.$event->course_id); ?>"
                                        class="text-danger fs-6"><?php echo $event->category_name;?></a>
                                </div>
                                <h3 class="course-card__course--title text-capitalize fs-6">
                                    <a href="<?php echo base_url($enterprise_shortname.'/event-details/'.$event->course_id); ?>"
                                        class="text-dark text-decoration-none"><?php echo (!empty($event->name)?$event->name:'');?></a>
                                </h3>
                                <!--End Course Title-->
                                <!--Start Course instructor-->
                                <div class="course-card__instructor mb-3">
                                    <div
                                        class="course-card__instructor--name text-black-50 text-uppercase fw-medium fs-13"><?php 
											$description = word_limiter($event->description, 10);
											echo (!empty($description) ? $description : ''); ?>
                                    </div>
                                </div>

                            </div>
                            <!--End Course Card Body-->
                        </div>
                        <!--End Course Card-->
                    </div>
                    <?php }?>
                </div>
                <?php }else{ ?>
                <p class="text-center text-danger">Record not found!</p>
                <?php } ?>

                <div class="row mb-4 g-3">
                    <div class="col-sm-6">
                        <?php if($get_eventlist){
							 echo $links;
						}	 
						?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>