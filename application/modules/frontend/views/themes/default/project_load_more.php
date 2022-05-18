        <!-- <div class="row justify-content-center g-4"> -->
               <!-- <input type="hidden" id="course_id" value="<?php //echo $course_id;?>"> -->
           <?php 
            if(!empty($get_load_data)){
            foreach($get_load_data as $project_list){
           ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <!--Start Gallery Card-->
                <a href="#" class="gallery-card bg-white d-block text-decoration-none">
                    <figure class="gallery-card_img zoom-in-hover mb-0">
                        <img src="<?php echo base_url(!empty($project_list['coverpic']) ? $project_list['coverpic'] : default_600_400()); ?>" class="img-fluid" alt="">
                    </figure>
                    <div class="gallery-card_body py-3 px-3">
                        <div class="d-flex justify-content-between">
                            <span><?php echo html_escape($project_list['title']);?></span>
                            <!-- <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="17.107" height="15.113"
                                    viewBox="0 0 17.107 15.113">
                                    <path id="Path_504" data-name="Path 504"
                                        d="M15.859,31.321a4.309,4.309,0,0,0-6.88.5,6.559,6.559,0,0,0-.426.69,6.553,6.553,0,0,0-.426-.69,4.309,4.309,0,0,0-6.88-.5A5.185,5.185,0,0,0,0,34.765a6.35,6.35,0,0,0,1.749,4.167,38.937,38.937,0,0,0,4.377,4.09c.662.564,1.347,1.148,2.075,1.785l.022.019a.5.5,0,0,0,.66,0l.022-.019c.729-.638,1.413-1.221,2.076-1.785a38.931,38.931,0,0,0,4.377-4.09,6.35,6.35,0,0,0,1.749-4.167A5.185,5.185,0,0,0,15.859,31.321ZM10.331,42.258c-.571.486-1.158.987-1.777,1.525-.619-.538-1.207-1.039-1.777-1.525C3.3,39.3,1,37.338,1,34.765a4.185,4.185,0,0,1,1-2.781,3.346,3.346,0,0,1,2.544-1.145A3.379,3.379,0,0,1,7.31,32.4a5.942,5.942,0,0,1,.767,1.526.5.5,0,0,0,.953,0A5.943,5.943,0,0,1,9.8,32.4a3.308,3.308,0,0,1,5.31-.412,4.185,4.185,0,0,1,1,2.781C16.1,37.338,13.808,39.3,10.331,42.258Z"
                                        transform="translate(0 -29.836)" fill="#5f5f5f" />
                                </svg>
                                207 likes
                            </span> -->
                        </div>
                        <span class="mt-1 d-block">
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="18.825" height="15.501"
                                viewBox="0 0 18.825 15.501">
                                <path id="Path_505" data-name="Path 505"
                                    d="M14.964.5H3.861A3.865,3.865,0,0,0,0,4.361v5.963a3.8,3.8,0,0,0,2.731,3.652L4.6,15.839a.551.551,0,0,0,.78,0l1.71-1.711h7.878a3.865,3.865,0,0,0,3.861-3.861V4.361A3.865,3.865,0,0,0,14.964.5Zm2.758,9.768a2.761,2.761,0,0,1-2.758,2.758H6.858a.552.552,0,0,0-.39.162L4.986,14.669,3.407,13.091a.551.551,0,0,0-.257-.145A2.7,2.7,0,0,1,1.1,10.323V4.361A2.761,2.761,0,0,1,3.861,1.6h11.1a2.761,2.761,0,0,1,2.758,2.758Zm0,0"
                                    transform="translate(0 -0.5)" fill="#5f5f5f" />
                                <path id="Path_506" data-name="Path 506"
                                    d="M153.313,144.328h-7a.551.551,0,1,0,0,1.1h7a.551.551,0,1,0,0-1.1Zm0,0"
                                    transform="translate(-140.399 -139.04)" fill="#5f5f5f" />
                                <path id="Path_507" data-name="Path 507"
                                    d="M153.313,197.352h-7a.552.552,0,1,0,0,1.1h7a.552.552,0,0,0,0-1.1Zm0,0"
                                    transform="translate(-140.399 -190.114)" fill="#5f5f5f" />
                            </svg>
                            16 comments -->
                        </span>
                    </div>
                </a>
                <!--End Gallery Card-->
            </div>
           <?php }?>
           
        <!-- </div> -->

        <div class="text-center mt-5 firstbutton removebuton_<?php echo (!empty($project_list['id']) ? $project_list['id'] : '');?>">
            <div id="home_course_load<?php echo (!empty($project_list['id']) ? $project_list['id'] : '');?>">
                <button type="button" onClick="project_loadmore_data(<?php echo (!empty($project_list['id']) ? $project_list['id'] : '');?>);" class="btn btn-lg btn-dark-cerulean home_course_load" id="<?php echo (!empty($project_list['id']) ? $project_list['id'] : '');?>">
                    Browse more Courses
                    <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="28.56" height="15.666" viewBox="0 0 28.56 15.666">
                    <path id="right-arrow_3_" data-name="right-arrow (3)" d="M20.727,107.5l-1.272,1.272,5.661,5.661H0v1.8H25.116l-5.661,5.661,1.272,1.272,7.833-7.833Z" transform="translate(0 -107.5)" fill="#fff"></path>
                    </svg>
                </button>
            </div>
        </div>
    <!-- </div> -->
    <?php }else{?>
     <div class="row justify-content-center g-4">
       <div class="col-sm-6 col-md-4 col-lg-3">
        No more record to load
       </div>
     </div>
    <?php 	}?>