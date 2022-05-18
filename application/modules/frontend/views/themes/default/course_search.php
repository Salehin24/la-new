<div class="bg-alice-blue py-3 py-lg-4">
            <div class="container-lg">
                <!--Start breadcrumb-->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-uppercase mb-3 mb-lg-4">
                        <!-- <li class="breadcrumb-item"><a href="#">Photo &amp; Video</a></li>
                        <li class="breadcrumb-item"><a href="#">Photography</a></li>
                        <li class="breadcrumb-item active" aria-current="page">The Art Of Filmmaking And Editing</li> -->
                    </ol>
                </nav>
                <!--End breadcrumb-->
                <div class="row">
                    <!-- <div class="col-md-3 pe-xl-5 d-none d-md-block sticky-content"> -->
                        <!--Start Sidebar Filter-->
                        <!-- <div class="sidebar-filter">
                            <h4 class="fw-bold text-dark-cerulean mb-4">All Classess</h4>
                            <h5 class="fw-bold text-dark-cerulean">Most Popular</h5>
                            <hr class="my-2 bg-dark-cerulean">
                            <ul class="list-unstyled cat-list my-3">
                             <?php
                             if(!empty($get_category_course)){
                             foreach($get_category_course as $category_course){?>
                                <li><a href="<?php echo base_url($enterprise_shortname. '/course-details/'. $category_course->course_id); ?>"><?php echo html_escape($category_course->name);?></a></li>
                            <?php }}?>
                            </ul>
                            <h5 class="fw-bold text-dark-cerulean">Govt.Project</h5>
                            <hr class="my-2 bg-dark-cerulean">
                            <ul class="list-unstyled cat-list my-3">
                            <?php 
                             if(!empty($gov_courses)){
                            foreach($gov_courses as $gov_course){?>
                                <li><a href="<?php echo base_url($enterprise_shortname. '/course-details/'. $gov_course->course_id); ?>"><?php echo html_escape($gov_course->name);?></a></li>
                            <?php }}?>
                            </ul>
                            <h5 class="fw-bold text-dark-cerulean">Free Courses</h5>
                            <hr class="my-2 bg-dark-cerulean">
                            <ul class="list-unstyled cat-list my-3">
                                <?php 
                                 if(!empty($free_courses)){
                                foreach($free_courses as $free_course){
                                ?>
                                    <li><a href="<?php echo base_url($enterprise_shortname. '/course-details/'. $free_course->course_id); ?>"><?php echo html_escape($free_course->name);?></a></li>
                                <?php }}?>
                            </ul>
                            <h5 class="fw-bold text-dark-cerulean">Trending Courses</h5>
                            <hr class="my-2 bg-dark-cerulean">
                            <ul class="list-unstyled cat-list my-3">
                                <li><a href="#">Graphic Design</a></li>
                                <li><a href="#">Illustration</a></li>
                                <li><a href="#">Music</a></li>
                                <li><a href="#">Photography</a></li>
                                <li><a href="#">UI/UX Design</a></li>
                                <li><a href="#">Web Development</a></li>
                            </ul>
                            <h5 class="fw-bold text-dark-cerulean">Creative</h5>
                            <hr class="my-2 bg-dark-cerulean">
                            <ul class="list-unstyled cat-list my-3">
                                <li><a href="#">Graphic Design</a></li>
                                <li><a href="#">Illustration</a></li>
                                <li><a href="#">Music</a></li>
                                <li><a href="#">Photography</a></li>
                                <li><a href="#">UI/UX Design</a></li>
                                <li><a href="#">Web Development</a></li>
                            </ul>
                            
                        </div> -->
                        <!--End Sidebar filter-->
                    <!-- </div> -->
                    
                    <div class="col-md-12 sticky-content">
                        <!--Start Category Banner-->
                        <div class="category-banner bg-img text-white p-4 p-sm-5 mb-4" data-image-src="<?php echo base_url(!empty($get_appseeting->course_header_image) ? "$get_appseeting->course_header_image" : 'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) .'/assets/img/category-banner-bg.jpg'); ?>">
                            <h2 class="fw-semi-bold"><?php // echo html_escape($category_info->name); ?></h2>
                            <p>Find what fascinates you as you explore these animation classes.</p>
                            <!-- <button type="button" class="btn btn-dark-cerulean">Get Started</button> -->
                        </div>
                        <!--End Category Banner-->
                        <!--Start Course Search-->
                        <!-- <div class="input-group course-search mb-4">
                            <input type="text" class="form-control typeaheads" id="items" placeholder="Search For Course" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-dark-cerulean btn-shadow" type="button" id="button-addon2" onclick="typeahead_category_wise_search()">
                                <svg id="search_4_" data-name="search (4)" xmlns="http://www.w3.org/2000/svg" width="24.894" height="24.894" viewBox="0 0 24.894 24.894">
                                <g id="Group_16" data-name="Group 16" transform="translate(3.743 5.396)">
                                <g id="Group_15" data-name="Group 15">
                                <path id="Path_5" data-name="Path 5" d="M80.108,111.245a.919.919,0,0,0-1.3,0,6.286,6.286,0,0,0-1.8,5.1.92.92,0,0,0,.914.828c.031,0,.062,0,.092,0a.92.92,0,0,0,.824-1.007,4.453,4.453,0,0,1,1.268-3.612A.919.919,0,0,0,80.108,111.245Z" transform="translate(-76.978 -110.976)" fill="#fff"/>
                                </g>
                                </g>
                                <g id="Group_18" data-name="Group 18">
                                <g id="Group_17" data-name="Group 17">
                                <path id="Path_6" data-name="Path 6" d="M10.516,0A10.516,10.516,0,1,0,21.032,10.516,10.528,10.528,0,0,0,10.516,0Zm0,19.192a8.676,8.676,0,1,1,8.676-8.676A8.686,8.686,0,0,1,10.516,19.192Z" fill="#fff"/>
                                </g>
                                </g>
                                <g id="Group_20" data-name="Group 20" transform="translate(16.371 16.371)">
                                <g id="Group_19" data-name="Group 19">
                                <path id="Path_7" data-name="Path 7" d="M344.962,343.663l-6.684-6.684a.92.92,0,0,0-1.3,1.3l6.684,6.684a.92.92,0,0,0,1.3-1.3Z" transform="translate(-336.709 -336.71)" fill="#fff"/>
                                </g>
                                </g>
                                </svg>
                            </button>
                        </div> -->
                        <!--End Course Search-->
                        <!--Start Course Filter-->

                        <!-- <ul class="list-inline d-flex align-items-center"> -->
                            <!-- <li class="list-inline-item me-auto">
                                SORT BY :
                            </li> -->
                            <!-- <li class="list-inline-item d-none d-md-inline-block">
                                <input type="hidden" value="<?php echo $this->uri->segment(3);?>" id="course_cat_id">
                                <select class="form-select rounded-0" aria-label="Default select example" id="course_filters">
                                    <option selected><?php echo display('select_one')?></option>
                                    <option value="1">Popular</option>
                                    <option value="3">Free</option>
                                    <option value="4"> Govt</option>
                                    
                                </select>
                            </li> -->
                            <!-- <li class="list-inline-item d-none d-md-inline-block">
                                <select class="form-select rounded-0" aria-label="Default select example" id="daywise_filters" >
                                <option selected><?php echo display('select_one')?></option>
                                <option value="7">Last 7 Days</option>
                                </select>
                            </li> -->
                           
                            <!-- <li class="list-inline-item d-md-none">
                                <button class="btn btn-dark-cerulean btn-filter" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                                    <i class="fas fa-filter"></i>
                                </button>
                            </li>
                        </ul> -->
                        <!--End Course Filter-->
                        <!--Start offcanvas filter-->
                        <!-- <div class="category-offcanvas_filter offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title text-dark-cerulean" id="offcanvasExampleLabel">All Classess</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div> -->
                            <!-- <div class="offcanvas-body"> -->
                                <!--Start Sidebar Filter-->
                                <!-- <div class="sidebar-filter">

                                    <div class="mb-3">
                                        <select class="form-select rounded-0" aria-label="Default select example">
                                            <option selected>Popular</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select rounded-0" aria-label="Default select example">
                                            <option selected>Filters</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>

                                    </div>
                                    <div class="mb-3">
                                        <select class="form-select rounded-0" aria-label="Default select example">
                                            <option selected>Filters</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                    <h5 class="fw-bold text-dark-cerulean">Most Popular</h5>
                                    <hr class="my-2 bg-dark-cerulean">
                                    <ul class="list-unstyled cat-list my-3">
                                        <li><a href="#">Graphic Design</a></li>
                                        <li><a href="#">Illustration</a></li>
                                        <li><a href="#">Music</a></li>
                                        <li><a href="#">Photography</a></li>
                                        <li><a href="#">UI/UX Design</a></li>
                                        <li><a href="#">Web Development</a></li>
                                    </ul>
                                    <h5 class="fw-bold text-dark-cerulean">Creative</h5>
                                    <hr class="my-2 bg-dark-cerulean">
                                    <ul class="list-unstyled cat-list my-3">
                                        <li><a href="#">Graphic Design</a></li>
                                        <li><a href="#">Illustration</a></li>
                                        <li><a href="#">Music</a></li>
                                        <li><a href="#">Photography</a></li>
                                        <li><a href="#">UI/UX Design</a></li>
                                        <li><a href="#">Web Development</a></li>
                                    </ul>
                                    <h5 class="fw-bold text-dark-cerulean">Govt.Project</h5>
                                    <hr class="my-2 bg-dark-cerulean">
                                    <ul class="list-unstyled cat-list my-3">
                                        <li><a href="#">Graphic Design</a></li>
                                        <li><a href="#">Illustration</a></li>
                                        <li><a href="#">Music</a></li>
                                        <li><a href="#">Photography</a></li>
                                        <li><a href="#">UI/UX Design</a></li>
                                        <li><a href="#">Web Development</a></li>
                                    </ul>
                                    <h5 class="fw-bold text-dark-cerulean">Free Courses</h5>
                                    <hr class="my-2 bg-dark-cerulean">
                                    <ul class="list-unstyled cat-list my-3">
                                        <li><a href="#">Graphic Design</a></li>
                                        <li><a href="#">Illustration</a></li>
                                        <li><a href="#">Music</a></li>
                                        <li><a href="#">Photography</a></li>
                                        <li><a href="#">UI/UX Design</a></li>
                                        <li><a href="#">Web Development</a></li>
                                    </ul>
                                    <h5 class="fw-bold text-dark-cerulean">Trending Courses</h5>
                                    <hr class="my-2 bg-dark-cerulean">
                                    <ul class="list-unstyled cat-list my-3">
                                        <li><a href="#">Graphic Design</a></li>
                                        <li><a href="#">Illustration</a></li>
                                        <li><a href="#">Music</a></li>
                                        <li><a href="#">Photography</a></li>
                                        <li><a href="#">UI/UX Design</a></li>
                                        <li><a href="#">Web Development</a></li>
                                    </ul>
                                </div> -->
                                <!--End Sidebar filter-->
                            <!-- </div> -->
                        <!-- </div> -->
                        <!--End offcanvas filter-->
                        <!--Start Skills-->
                        <!-- <div class="skills bg-white shadow-sm p-4 mb-4"> -->
                            <!--Start Section Header-->
                            <!-- <div class="section-header mb-4">
                                <h4 class="h5">Related Skills</h4>
                                <div class="section-header_divider"></div>
                            </div> -->
                            <!--End Section Header-->
                            <!--Start Tags-->
                            <!-- <div class="tags">
                                <a href="#" class="tag-link text-white text-decoration-none d-inline-block mb-1 px-3 py-2 bg-navy-blue">Logistic Regression</a>
                                <a href="#" class="tag-link text-white text-decoration-none d-inline-block mb-1 px-3 py-2 bg-endeavour">Machin</a>
                                <a href="#" class="tag-link text-white text-decoration-none d-inline-block mb-1 px-3 py-2 bg-resolution-blue">Networking</a>
                                <a href="#" class="tag-link text-white text-decoration-none d-inline-block mb-1 px-3 py-2 bg-dark-cerulean">Logistic Regression</a>
                                <a href="#" class="tag-link text-white text-decoration-none d-inline-block mb-1 px-3 py-2 bg-prussian-blue">Logistic</a>
                                <a href="#" class="tag-link text-white text-decoration-none d-inline-block mb-1 px-3 py-2 bg-electric-indigo">Logistic Regression</a>
                            </div> -->
                            <!--End Tags-->
                        <!-- </div> -->
                        <!--End Skills-->
                        <!-- <div id="alldata"> -->
                     
                        <div class="row justify-content-center gx-3 gy-4" id="alldata">
                            <input type="hidden" value="<?php echo $this->uri->segment(3);?>" id="category_id">
                            <?php 
                            if(!empty($category_courses)){
                                $s=0;
                            foreach($category_courses as $category_course){
                            ?>
                            
                                <div class="col-sm-5 col-md-5 col-lg-5 col-xl-3 hideClass" id="<?php echo  @$category_course->id ;?>">
                                    <!--Start Course Card-->
                                    <div class="course-card course-card-shadow rounded-6 bg-white position-relative overflow-hidden">
                                        <div class="position-relative overflow-hidden bg-prussian-blue">
                                            <!--Start Course Image-->
                                            <a href="<?php echo base_url($enterprise_shortname. '/course-details/'. $category_course->course_id); ?>" class="course-card_img">
                                                <img src="<?php echo base_url(!empty($category_course->picture) ? $category_course->picture : default_600_400()); ?>" class="img-fluid w-100" alt="">
                                            </a>
                                            <!--End Course Image-->
                                            <div class="align-items-center top-0 d-flex fs-12 position-absolute px-3 py-2 start-0 text-white w-100 z-index-2">
                                                <input  type="hidden" value="<?php echo $category_course->course_id;?>" id="course_id">
                                                <input  type="hidden" value="<?php echo $user_id;?>" id="student_id">
                                                <input  type="hidden" value="<?php echo $user_type;?>" id="user_type">
                                                <?php 
                                                if($category_course->tagstatus==4){?>
                                                <span class="badge-new  me-1">Most Popular</span>
                                                <?php   
                                                }elseif($category_course->tagstatus==3){?>
                                                    <span class="badge-new  me-1">New</span>
                                                <?php }elseif($category_course->tagstatus==1){?> 
                                                    <span class="badge-new  me-1">Recomended</span>

                                                <?php }elseif($category_course->tagstatus==2){?>  
                                                    <span class="badge-new  me-1">Best Seller</span> 
                                                <?php  }?>
                                                <span class="badge-business"><?php echo html_escape($category_course->category_name);?></span>
                                                <span id="savecourse<?php echo $category_course->course_id; ?>" class="ms-auto">
                                                <?php
                                                    $coursesaved_checked = $this->Frontend_model->coursesaved_checked($user_id,$category_course->course_id);
                                                    if (!$coursesaved_checked){
                                                        if ($user_type == 4) {?>
                                                        <img onclick="get_coursesaveloop(1, '<?php echo $category_course->course_id; ?>')"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-1.png'); ?>"
                                                        class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                                    <?php } else { 
                                                        if($user_type != 5){
                                                    ?>
                                                        <img onclick="coursesavecheck()"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-1.png'); ?>"
                                                        class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                                    <?php }}
                                                    } else {?>
                                                      <img onclick="get_coursesaveloop(0, '<?php echo $category_course->course_id; ?>')"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-2.png'); ?>"
                                                        class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                                    <?php } ?>
                                                </span>
                                            </div>
                                            <?php if(!empty($category_course->is_discount==1)){ ?>
                                            <span  class="px-0 badge m-3   position-absolute start-0 text-white   z-index-2 polygon-shape" style="top:25px">
                                                <span class="d-block fs-13 mb-1">Off</span>
                                                <span class="fs-15 fw-bold"><?php  echo (($category_course->discount) ? $category_course->discount :''); ?><?php if($category_course->discount_type==2){ echo "%";}else{ echo " ";}?></span>
                                            </span>
                                            <?php }?>
                                            <!--Start Course Card Body-->
                                            <div class="bg-prussian-blue course-card_body course_middle px-3 py-2 text-white py-12">
                                                <!--Start Course Title-->
                                                <h3 class="course-card__course--title  mb-0 text-capitalize">
                                                    <a href="<?php echo base_url($enterprise_shortname. '/course-details/'. $category_course->course_id); ?>"
                                                        class="text-decoration-none text-white"><?php echo (!empty($category_course->name) ? $category_course->name : ''); ?></a>
                                                </h3>
                                                <!--End Course Title-->
                                                <div class="course-card__instructor d-flex align-items-center">
                                                    <div class="card__instructor--name my-2">
                                                        <a class="text-capitalize instructor-name"
                                                            href="<?php echo base_url($enterprise_shortname.'/instructor-profile-show/'.$category_course->faculty_id); ?>"><?php echo (!empty($category_course->instructor_name) ? $category_course->instructor_name : ''); ?></a>
                                                    </div>
                                                </div>
                                                <!--Start Course Hints-->
                                                <table
                                                    class="course-card__hints table table-borderless table-sm text-white mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <td width="80" class="ps-0">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="course-card__hints--icon me-3">
                                                                        <?php
                                                                                if (@$category_course->course_level == 1) {?>
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="bar-custom me-2">
                                                                                <span class="fill"></span>
                                                                                <span></span>
                                                                                <span></span>
                                                                            </div>
                                                                        </div>
                                                                        <?php } elseif (@$category_course->course_level == 2) {?>
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="bar-custom me-2">
                                                                                <span class="fill"></span>
                                                                                <span class="fill"></span>
                                                                                <span></span>
                                                                            </div>
                                                                        </div>
                                                                        <?php } elseif (@$category_course->course_level == 3) {?>
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="bar-custom me-2">
                                                                                <span class="fill"></span>
                                                                                <span class="fill"></span>
                                                                                <span class="fill"></span>
                                                                            </div>
                                                                        </div>
                                                                        <?php }?>
                                                                    </div>
                                                                    <div
                                                                        class="course-card__hints--text fs-12 fw-bold text-white">
                                                                        <?php 
                                                                            if($category_course->course_level == 1){
                                                                                
                                                                                echo "Beginner  Level";
                                                                            }elseif($category_course->course_level == 2){
                                                                                echo "Intermediate Level";
                                                                            }elseif($category_course->course_level == 3){
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
                                                                        <svg id="document"
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            width="17.26" height="14.926"
                                                                            viewBox="0 0 17.26 14.926">
                                                                            <path id="Path_148" data-name="Path 148"
                                                                                d="M16.065,17.081H1.2a1.2,1.2,0,0,0-1.2,1.2V28.364a1.2,1.2,0,0,0,1.2,1.2h8.67l-.262,1.6a.69.69,0,0,0,1.041.75l1.871-.985a.393.393,0,0,1,.248,0l1.871.985a.834.834,0,0,0,.388.1.656.656,0,0,0,.387-.123.726.726,0,0,0,.266-.728l-.262-1.6h.651a1.2,1.2,0,0,0,1.2-1.2V18.277A1.2,1.2,0,0,0,16.065,17.081ZM12.64,27.511a2.084,2.084,0,1,1,2.084-2.084A2.086,2.086,0,0,1,12.64,27.511Zm.6,2.5a1.383,1.383,0,0,0-1.2,0l-1.323.7.42-2.565a3.1,3.1,0,0,0,3.007,0l.164,1v.005l.256,1.56Zm2.994-1.651a.173.173,0,0,1-.171.171h-.819l-.187-1.142s0-.009,0-.013a3.108,3.108,0,1,0-4.831,0l0,.013-.187,1.142H1.2a.173.173,0,0,1-.171-.171V18.277a.173.173,0,0,1,.171-.171H16.065a.173.173,0,0,1,.171.171Z"
                                                                                transform="translate(0 -17.081)"
                                                                                fill="#B5C5DB" />
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
                                                                    <div
                                                                        class="course-card__hints--text fs-12 fw-bold text-white">
                                                                       <?php if($category_course->enterprise_name=='Admin'){ echo "Lead Academy";}else{ echo $category_course->enterprise_name." "."Academy";}?>
                                                                        <?php //echo (!empty($category_course->enterprise_name) ? $category_course->enterprise_name : ''); ?>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <!-- <tr>
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
                                                                        $course_wise_lesson = $this->Course_model->course_wise_lesson( $category_course->course_id);
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
                                                                            echo  ' '.$hours."hr"." ".$minutes ."m" ;
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr> -->
                                                    </tbody>
                                                </table>
                                                <!--End Course Hints-->
                                                <div
                                                    class="align-items-center d-flex fs-12 justify-content-between pt-1 text-white w-100">
                                                    <div class="d-flex align-items-center">
                                                        <div class="course-card__hints--icon me-3">
                                                            <svg id="clock_1_" data-name="clock (1)"
                                                                xmlns="http://www.w3.org/2000/svg" width="16.706"
                                                                height="16.706" viewBox="0 0 16.706 16.706">
                                                                <path id="Path_13" data-name="Path 13"
                                                                    d="M8.353,0a8.353,8.353,0,1,0,8.353,8.353A8.363,8.363,0,0,0,8.353,0Zm0,15.662a7.309,7.309,0,1,1,7.309-7.309,7.317,7.317,0,0,1-7.309,7.309Z"
                                                                    fill="#B5C5DB" />
                                                                <path id="Path_14" data-name="Path 14"
                                                                    d="M208.838,83.118h-1.044v5.437l3.285,3.285.738-.738-2.979-2.979Z"
                                                                    transform="translate(-199.963 -79.985)"
                                                                    fill="#B5C5DB" />
                                                            </svg>
                                                        </div>
                                                        <div class="course-card__hints--text fs-12 fw-bold text-white">
                                                            <?php 
                                                                $course_wise_lesson = $this->Course_model->course_wise_lesson( $category_course->course_id);
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
                                                                    echo  ' '.$hours." hrs"." ".$minutes ." min" ;
                                                                ?>
                                                        </div>
                                                    </div>
                                                    <div class="course-like d-flex align-items-center">
                                                        <i class="fas fa-graduation-cap fs-15 me-1 "
                                                            style="color:#B5C5DB"></i>
                                                        <div class="d-block">
                                                            <div class="reviews fs-12 fw-bold text-white"><?php 
                                                            $studentCount = $this->db->where('product_id', $category_course->course_id)->get('invoice_details')->num_rows();
                                                                //echo  html_escape($studentCount?$studentCount:0)
                                                                echo number_format($studentCount?$studentCount:0); 
                                                            ?></div>
                                                        </div>
                                                    </div>

                                                    <!--Start Star Rating-->
                                                    <div class="star-rating__wrap d-flex align-items-center ">
                                                        <i class="fas fa-star me-1 text-warning"
                                                            style="color:#B5C5DB"></i>
                                                        <div class="d-block">
                                                            <div class="reviews fs-12 fw-bold text-white">
                                                                <?php echo average_ratings_number($category_course->course_id,$enterprise_id);?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End Course Card Body-->
                                            
                                            <!--Start Course Card Hover Content-->
                                            <div class="course-card__hover--content">
                                                <img src="<?php echo base_url(!empty($category_course->hover_thumbnail) ? $category_course->hover_thumbnail :default_600_400()); ?>"
                                                    class="course-card__hover--content___img">
                                                <!--Start Video Icon With Popup Youtube-->
                                                <?php if($category_course->url){ ?>

                                                <a class="course-card__hover--content___icon popup-youtube"
                                                    href="<?php echo (!empty($category_course->url)? $category_course->url : ''); ?>"
                                                    autoplay>
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/Playicon.png'); ?>"
                                                        class="img-fluid" alt="">
                                                </a>
                                                <?php } ?>
                                                <!--End Video Icon With Popup Youtube-->
                                             
                                                <h3
                                                    class="bottom-0 course-card__hover--content___text d-block fs-15 mb-0 position-absolute text-capitalize text-decoration-none text-white">
                                                    <a href="<?php echo base_url($enterprise_shortname. '/course-details/'. $category_course->course_id); ?>"
                                                        class="text-decoration-none text-white"><?php echo (!empty($category_course->name) ? $category_course->name : ''); ?></a>
                                                </h3>
                                            </div>
                                        </div>

                                    <?php 
                                    $course_types = json_decode($category_course->course_type); 
                                    $checked_purchase = $this->db->where('customer_id',$user_id)->where('product_id', $category_course->course_id)->where('status',1)->get('invoice_details')->row();
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
                                                                for="flexRadioDefault2_<?php echo $category_course->course_id?>">
                                                                <span class="course_price_cart">Course Price
                                                                    <span class="text-success">
                                                                    </span>
                                                                </span>
                                                                <span class="align-items-center d-flex  rounded text-center">
                                                                    <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                                        <?php echo (($category_course->is_offer == 1) ? number_format($category_course->offer_courseprice) : number_format($category_course->price)); ?></span>
                                                                    <?php if(!empty($category_course->is_discount==1)){?>
                                                                    <del
                                                                        class="fs-12 fw-bold text-muted2"><?php echo (($category_course->oldprice)?number_format($category_course->oldprice) :" "); ?></del>
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
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $category_course->course_id); ?>"
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
                                                    value="<?php echo $category_course->course_id;?>"
                                                    id="<?php echo $category_course->course_id;?>">
                                                <div class="align-items-center d-flex form-check ps-0">
                                                    <!-- <input class="form-check-input" type="radio" name="flexRadioDefault1_<?php echo $category_course->course_id?>" id="flexRadioDefault1_<?php echo $category_course->course_id?>"  onclick="subscriptionchecedRadio('<?php echo $category_course->course_id;?>')" > -->
                                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                                        name="flexRadioDefault1_<?php echo $category_course->course_id?>"
                                                        id="flexRadioDefault1_<?php echo $category_course->course_id?>"
                                                        onclick="subscriptionchecedRadio('<?php echo $category_course->course_id;?>')">
                                                    <label class="form-check-label fw-bold course_price_cart " 
                                                        for="flexRadioDefault1_<?php echo $category_course->course_id?>">
                                                        Subscription
                                                    </label>
                                                </div>
                                                <div class="form-check d-flex align-items-center ps-0">
                                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                                        name="flexRadioDefault2_<?php echo $category_course->course_id?>"
                                                        id="flexRadioDefault2_<?php echo $category_course->course_id?>"
                                                        onclick="coursechecedRadio('<?php echo $category_course->course_id;?>')"
                                                        checked>
                                                    <label
                                                        class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                                        style="width:100%;"
                                                        for="flexRadioDefault2_<?php echo $category_course->course_id?>" >
                                                        <span class="course_price_cart">Course Price
                                                            <span class="text-success">
                                                            </span>
                                                        </span>
                                                        <span class="align-items-center d-flex  rounded text-center">
                                                            <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                                <?php echo (($category_course->is_offer == 1) ? number_format($category_course->offer_courseprice) : number_format($category_course->price)); ?></span>
                                                            <?php if(!empty($category_course->is_discount==1)){?>
                                                                <del class="fs-12 fw-bold text-muted2"><?php echo (($category_course->oldprice)?number_format($category_course->oldprice) :" "); ?></del>
                                                            <?php }?>

                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-stretch mt-2"
                                                    id="course_purchase_<?php echo $category_course->course_id?>">
                                                    <div class="flex-grow-1 me-2 w-sub">
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $category_course->course_id); ?>"
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
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $category_course->course_id); ?>"
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
                                                    id="course_subscription_<?php echo $category_course->course_id?>">
                                                    <div class="flex-grow-1 me-2 w-sub">
                                                        <a href="<?php echo base_url($enterprise_shortname.'/subscription-details'); ?>"
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
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $category_course->course_id); ?>"
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
                                                <?php }elseif(in_array("3", $course_types) && in_array("4", $course_types)){?>
                                                <!-- <div class="d-flex justify-content-between align-items-stretch ">
                                                        <div class="flex-grow-1 me-1">
                                                            <button type="button" class="btn btn-dark-cerulean w-100">
                                                                <i data-feather="shopping-cart" class="me-1"></i>
                                                                Subscription
                                                            </button>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $category_course->course_id); ?>" class="btn btn-dark-cerulean w-100">
                                                                <i data-feather="info" class="me-1"></i>
                                                                Details
                                                            </a>
                                                        </div>
                                                    </div> -->
                                                <?php }elseif(in_array("1", $course_types)){?>
                                                <div class="align-items-center d-flex form-check ps-0">
                                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                                        name="flexRadioDefault1_<?php echo $category_course->course_id?>"
                                                        id="flexRadioDefault1_<?php echo $category_course->course_id?>"
                                                        onclick="subscriptionchecedRadio('<?php echo $category_course->course_id;?>')"
                                                        disabled>
                                                    <label class="form-check-label fw-bold opa-half course_price_cart"
                                                        for="flexRadioDefault1">
                                                        Subscription
                                                    </label>
                                                </div>
                                                <div class="form-check d-flex align-items-center ps-0">
                                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                                        name="flexRadioDefault2_<?php echo $category_course->course_id?>"
                                                        id="flexRadioDefault2_<?php echo $category_course->course_id?>"
                                                        onclick="coursechecedRadio('<?php echo $category_course->course_id;?>')"
                                                        checked>
                                                    <label
                                                        class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                                         style="width:100%"
                                                        for="flexRadioDefault2_<?php echo $category_course->course_id?>">
                                                        <span class="course_price_cart">Course Price <span class="text-success"></span>
                                                        </span>
                                                        <span class="align-items-center d-flex  rounded text-center">
                                                            <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                                <?php echo (($category_course->is_offer == 1) ? number_format($category_course->offer_courseprice) : number_format($category_course->price)); ?></span>
                                                            <?php if(!empty($category_course->is_discount==1)){?> 
                                                            <del class="fs-12 fw-bold text-muted2"><?php echo (($category_course->oldprice)?number_format($category_course->oldprice) :" "); ?></del>
                                                          <?php }?>
                                                        </span>

                                                    </label>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-stretch mt-2">
                                                    <div class="flex-grow-1 me-2 w-sub">
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $category_course->course_id); ?>"
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
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $category_course->course_id); ?>"
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
                                                <?php }elseif(in_array("2", $course_types)){?>
                                                <div class="align-items-center d-flex form-check ps-0">
                                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                                        name="flexRadioDefault1_<?php echo $category_course->course_id?>"
                                                        id="flexRadioDefault1_<?php echo $category_course->course_id?>"
                                                        onclick="subscriptionchecedRadio('<?php echo $category_course->course_id;?>')"
                                                        checked>
                                                    <label class="form-check-label fw-bold course_price_cart"
                                                        for="flexRadioDefault1_<?php echo $category_course->course_id?>">
                                                        Subscription
                                                    </label>
                                                </div>
                                                <div class="form-check d-flex align-items-center ps-0 ">
                                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                                        name="flexRadioDefault2_<?php echo $category_course->course_id?>"
                                                        id="flexRadioDefault2_<?php echo $category_course->course_id?>"
                                                        onclick="coursechecedRadio('<?php echo $category_course->course_id;?>')"
                                                        disabled>
                                                    <label
                                                        class="align-items-center d-flex form-check-label fw-bold justify-content-between opa-half"
                                                        style="width: calc(100% - 25px);" for="flexRadioDefault2">
                                                        <span class="course_price_cart">Course Price <span class="text-success"></span></span>
                                                    </label>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-stretch mt-2">
                                                    <div class="flex-grow-1 me-2 w-sub">
                                                        <a href="<?php echo base_url($enterprise_shortname.'/subscription-details'); ?>"
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
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $category_course->course_id); ?>"
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
                                                <?php }elseif(in_array("3", $course_types)){?>
                                                <div class="align-items-center d-flex form-check ps-0">
                                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                                        name="flexRadioDefault1_<?php echo $category_course->course_id?>"
                                                        id="flexRadioDefault1_<?php echo $category_course->course_id?>"
                                                        onclick="subscriptionchecedRadio('<?php echo $category_course->course_id;?>')"
                                                        disabled>
                                                    <label class="form-check-label fw-bold opa-half course_price_cart"
                                                        for="flexRadioDefault1">
                                                        Subscription
                                                    </label>
                                                </div>
                                                <div class="align-items-center d-flex form-check ps-0">
                                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                                        name="flexRadioDefault2_<?php echo $category_course->course_id?>"
                                                        id="flexRadioDefault2_<?php echo $category_course->course_id?>"
                                                        onclick="coursechecedRadio('<?php echo $category_course->course_id;?>')"
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
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $category_course->course_id); ?>"
                                                            class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                            <span class="shopping me-1 shopping_icon position-relative">
                                                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                                    style="width: 14px;">
                                                            </span>
                                                            <span class="text-center w-100 fw-bold fs-13"> Enroll Free </span>
                                                        </a>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $category_course->course_id); ?>"
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

                                                <?php }elseif(in_array("4", $course_types)){?>
                                                <div class="align-items-center d-flex form-check ps-0">
                                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                                        name="flexRadioDefault1_<?php echo $category_course->course_id?>"
                                                        id="flexRadioDefault1_<?php echo $category_course->course_id?>"
                                                        onclick="subscriptionchecedRadio('<?php echo $category_course->course_id;?>')"
                                                        disabled>
                                                    <label class="form-check-label fw-bold opa-half course_price_cart"
                                                        for="flexRadioDefault1">
                                                        Subscription
                                                    </label>
                                                </div>
                                                <div class="align-items-center d-flex form-check ps-0">
                                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                                        name="flexRadioDefault2_<?php echo $category_course->course_id?>"
                                                        id="flexRadioDefault2_<?php echo $category_course->course_id?>"
                                                        onclick="coursechecedRadio('<?php echo $category_course->course_id;?>')"
                                                        disabled>
                                                    <label
                                                        class="align-items-center d-flex form-check-label fw-bold justify-content-between opa-half"
                                                        for="flexRadioDefault2_<?php echo $category_course->course_id?>">
                                                        <span class="course_price_cart">Course Price</span>
                                                        <span
                                                            class="bg-danger d-flex px-2 rounded text-center text-white">
                                                            <!-- Govt -->
                                                        </span>
                                                    </label>
                                                    <span class="badge bg-success me-1 float-end ms-auto"> Govt</span>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-stretch mt-2">
                                                    <div class="flex-grow-1 me-2 w-sub">
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $category_course->course_id); ?>"
                                                            class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                            <span class="shopping me-1 shopping_icon position-relative">
                                                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                                    style="width: 14px;">
                                                            </span>
                                                            <span class="text-center w-100 fw-bold fs-13"> Govt </span>
                                                        </a>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $category_course->course_id); ?>"
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
                                                <?php }else{?>
                                                No Allow this type
                                                <?php  }?>
                                            </div>
                                            <?php }?>

                                        </div>   

                                    <!--Start End Card Hover Content-->
                                    </div>
                                    <!--End Course Card-->
                                </div>
                            <?php }}else{?>
                             <p>Your Search Item  Not Found</p>
                            <?php }?>
                            </div>
                            <?php 
                  
                            if($categorycourse_count >1){ 
                            ?>
                       
                            <!-- <div class="text-center mt-5 firstbutton removebuton_<?php echo (!empty($category_course->id) ? $category_course->id : '');?>">
                                <div id="home_course_load<?php echo (!empty($category_course->id) ? $category_course->id : '');?>">
                                    <button type="button"
                                        onClick="loadmore_data(<?php echo (!empty($category_course->id) ? $category_course->id : '');?>);"
                                        class="btn btn-lg btn-dark-cerulean home_course_load"
                                        id="<?php echo (!empty($category_course->id) ? $category_course->id : '');?>">
                                        Browse more Courses
                                        <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="28.56" height="15.666"
                                            viewBox="0 0 28.56 15.666">
                                            <path id="right-arrow_3_" data-name="right-arrow (3)"
                                                d="M20.727,107.5l-1.272,1.272,5.661,5.661H0v1.8H25.116l-5.661,5.661,1.272,1.272,7.833-7.833Z"
                                                transform="translate(0 -107.5)" fill="#fff"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div> -->
                            <?php } ?>
                        </div>
                        </div>
                </div>
            </div>
        </div>
    <script>

$( document ).ready(function() {
        //    subscription button hide 
    $( ".hideClass" ).each(function( index ) {
      var p_course_id=$("#p_course_id_"+index).val(); 
      $("#course_subscription_"+p_course_id).first().hide();
      $('#course_subscription_'+p_course_id).first().removeClass('d-flex');
    });
});
    </script>