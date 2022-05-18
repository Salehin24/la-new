<?php 
$user_id = $this->session->userdata('user_id');
$user_type = $this->session->userdata('user_type');
?>
<!--Start Main Background Video Header -->
<header class="main-header header-video_bg position-relative overflow-hidden w-100 py-md-5">
    <!--<div class="overlay"></div>-->
    <!--Start Header Background video-->
    <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
        <source
            src="<?php echo base_url(!empty($get_sliderdata->background_video_url) ? $get_sliderdata->background_video_url : 'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/media/Greenwich-University.mp4'); ?>"
            type="video/mp4">
    </video>
    <!--End Header Background video-->
    <div class="container-lg position-relative text-white py-5">
        <div class="text-center pt-5 py-md-5">
            <div class="header-logo mb-5 pt-5">
                <img src="<?php echo base_url(!empty($get_sliderdata->slider_logo) ? $get_sliderdata->slider_logo : 'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/slider-logo.png'); ?>"
                    class="img-fluid" alt="">
                    <?php //if(!empty($get_sliderinfo->slider_logo)){ echo html_escape($get_sliderinfo->slider_logo); } ?>
                    
            </div>
            <h2 class="fw-medium h3 text-uppercase">
                <?php echo (!empty($get_sliderdata->title) ? $get_sliderdata->title : 'Inspiring Knowledge, Education Minds'); ?>
            </h2>
            <div class="header-btn l mt-5 text-uppercase" style="letter-spacing: 2px;">
                <a href="<?php echo base_url($enterprise_shortname . '/comming-soon'); ?>"
                    class="btn btn-dark-cerulean btn-lg mb-2 mb-sm-0">Programs & Degrees</a>
                <a href="<?php echo base_url($enterprise_shortname . '/comming-soon'); ?>"
                    class="btn btn-dark-cerulean btn-lg mb-2 mb-sm-0">Partnership With Lead Academy</a>
            </div>
        </div>
        <div class="row align-items-center justify-content-center text-center text-sm-start mt-5">
            <!-- <div class="col-md-5"> -->
            <!-- <h2 class="h1 fw-semi-bold mb-4">
                    <?php echo (!empty($get_sliderdata->subtitle) ? $get_sliderdata->subtitle : 'Unlimited Access To World Class Online Learning'); ?>
                </h2> -->
            <!-- <ul class="list-unstyled">
                    <li class="h6 mb-3"><svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="19.549"
                            height="14.356" viewBox="0 0 19.549 14.356">
                            <path id="Path_8" data-name="Path 8"
                                d="M19.262,68.284a.977.977,0,0,0-1.382,0L6.169,79.994l-4.5-4.5A.977.977,0,0,0,.286,76.875l5.192,5.192a.978.978,0,0,0,1.382,0l12.4-12.4A.977.977,0,0,0,19.262,68.284Z"
                                transform="translate(0 -67.997)" fill="#fff" />
                        </svg>
                        <?php echo (!empty($get_sliderdata->slider_point_one) ? $get_sliderdata->slider_point_one : 'Get unlimited access to 4,000+ of our top courses'); ?>
                    </li>
                    <li class="h6 mb-3"><svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="19.549"
                            height="14.356" viewBox="0 0 19.549 14.356">
                            <path id="Path_8" data-name="Path 8"
                                d="M19.262,68.284a.977.977,0,0,0-1.382,0L6.169,79.994l-4.5-4.5A.977.977,0,0,0,.286,76.875l5.192,5.192a.978.978,0,0,0,1.382,0l12.4-12.4A.977.977,0,0,0,19.262,68.284Z"
                                transform="translate(0 -67.997)" fill="#fff" />
                        </svg>
                        <?php echo (!empty($get_sliderdata->slider_point_two) ? $get_sliderdata->slider_point_two : 'Explore a variety of fresh topics'); ?>
                    </li>
                    <li class="h6 mb-3"><svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="19.549"
                            height="14.356" viewBox="0 0 19.549 14.356">
                            <path id="Path_8" data-name="Path 8"
                                d="M19.262,68.284a.977.977,0,0,0-1.382,0L6.169,79.994l-4.5-4.5A.977.977,0,0,0,.286,76.875l5.192,5.192a.978.978,0,0,0,1.382,0l12.4-12.4A.977.977,0,0,0,19.262,68.284Z"
                                transform="translate(0 -67.997)" fill="#fff" />
                        </svg>
                        <?php echo (!empty($get_sliderdata->slider_point_three) ? $get_sliderdata->slider_point_three : 'Find the right instructor for you'); ?>
                    </li>
                </ul> -->
            <!-- </div> -->
            <!-- <div class="col-md-5">
                <div class="header-video">
                    <a class="popup-youtube position-relative"
                        href="<?php echo (!empty($get_sliderdata->short_video_url) ? $get_sliderdata->short_video_url : 'http://www.youtube.com/watch?v=0O2aH4XLbto'); ?>">
                        <img src="<?php echo base_url((!empty($get_sliderdata->picture) ? $get_sliderdata->picture : 'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/header-video.png')); ?>"
                            class="img-fluid" alt="">
                            <div class="banner-video_icon position-absolute start-50 top-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="92" height="92" viewBox="0 0 92 92">
                            <g id="Ellipse_2" data-name="Ellipse 2" fill="none" stroke="#fff" stroke-width="3">
                            <circle cx="46" cy="46" r="46" stroke="none" />
                            <circle cx="46" cy="46" r="44.5" fill="none" />
                            </g>
                            <g id="Polygon_1" data-name="Polygon 1" transform="translate(63 32) rotate(90)" fill="none">
                            <path d="M14.5,0,29,25H0Z" stroke="none" />
                            <path d="M 14.5 5.979442596435547 L 5.208076477050781 22 L 23.79192352294922 22 L 14.5 5.979442596435547 M 14.5 0 L 29 25 L 0 25 L 14.5 0 Z" stroke="none" fill="#fff" />
                            </g>
                            </svg>
                            </div>
                    </a>
                </div>
            </div> -->
        </div>
    </div>
</header>
<div class="header2 header-img_bg bg-img position-relative py-73"
    data-image-src="<?php echo base_url(html_escape(!empty($get_sliderdata->subtitle_image) ? "$get_sliderdata->subtitle_image" : 'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/library.jpg')); ?>">
    <div class="container">
        <div class="row position-relative align-items-center header2_innner">
            <div class="col-lg-4">
                <h2 class="fw-medium h1 mb-0 text-white">
                    <?php echo (!empty($get_sliderdata->subtitle) ? $get_sliderdata->subtitle : 'Unlimited Access To World Class Online Learning'); ?>
                </h2>
            </div>
            <div class="col-lg-6 offset-lg-1">
                <div class="header-video banner_video">
                    <a class="popup-youtube position-relative"
                        href="<?php echo (!empty($get_sliderdata->short_video_url) ? $get_sliderdata->short_video_url: 'http://www.youtube.com/watch?v=0O2aH4XLbto'); ?>">
                        <img src="<?php echo base_url((!empty($get_sliderdata->picture) ? $get_sliderdata->picture : 'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/header-video.png')); ?>"
                            class="img-fluid" alt="">
                        <div class="banner-video_icon position-absolute start-50 top-50">
                            <svg xmlns="http://www.w3.org/2000/svg" width="92" height="92" viewBox="0 0 92 92">
                                <g id="Ellipse_2" data-name="Ellipse 2" fill="none" stroke="#fff" stroke-width="3">
                                    <circle cx="46" cy="46" r="46" stroke="none" />
                                    <circle cx="46" cy="46" r="44.5" fill="none" />
                                </g>
                                <g id="Polygon_1" data-name="Polygon 1" transform="translate(63 32) rotate(90)"
                                    fill="none">
                                    <path d="M14.5,0,29,25H0Z" stroke="none" />
                                    <path
                                        d="M 14.5 5.979442596435547 L 5.208076477050781 22 L 23.79192352294922 22 L 14.5 5.979442596435547 M 14.5 0 L 29 25 L 0 25 L 14.5 0 Z"
                                        stroke="none" fill="#fff" />
                                </g>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Main Background Video Header -->
<!--Start Course Content-->
<!-- bg-alice-blue -->
<div class="py-5 pt-lg-220 ">
    <div class="container-lg">
        <div class="row">
            <div class="col-12">
                <div class="text-center mb-5">
                    <h3 class="fw-bold mb-0 text-dark-cerulean">EXPLORE COURSES</h3>
                </div>
                <div class="d-sm-flex text-center">
                    <div class="dropdown category-dropdown mb-3 mb-sm-0 me-sm-2">
                        <button class="btn btn-dark-cerulean btn-shadow dropdown-toggle" type="button"
                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            All Category
                        </button>
                        <ul class="dropdown-menu animate slideIn" aria-labelledby="dropdownMenuButton1">
                            <?php foreach($get_category as $category){ ?>
                            <li>
                                <!-- <a class="dropdown-item" href="javascript:void(0)"
                                    onclick="get_explorecourse('dynamic', '<?php echo $category->category_id; ?>', '<?php echo $category->id; ?>')">
                                    <?php //echo (!empty($category->name) ? $category->name : ''); ?>
                                </a> -->
                                <a class="dropdown-item"
                                    href="<?php 
                                echo base_url($enterprise_shortname . '/category-course/' . html_escape($category->category_id)); ?>">
                                    <?php echo (!empty($category->name) ? $category->name : ''); ?>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs course-tabs border-0" role="tablist" style="display: none">
                        <li class="nav-item"><a class="nav-link active" href="#tab_1" role="tab" data-bs-toggle="tab"
                                onclick="get_explorecourse('popular', '', '4')">Most
                                Popular</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_2" role="tab" data-bs-toggle="tab"
                                onclick="get_explorecourse('newest', '', '3')">Newest</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="#tab_3" role="tab" data-bs-toggle="tab"
                                onclick="get_explorecourse('free', '', '3')">Free</a></li> -->
                        <li class="nav-item"><a class="nav-link" href="#tab_5" role="tab" data-bs-toggle="tab"
                                onclick="get_explorecourse('recomended','', '1')">Recommended</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_6" role="tab" data-bs-toggle="tab"
                                onclick="get_explorecourse('bestseller','', '2')">Best Seller</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tab_4" role="tab" data-bs-toggle="tab"
                                onclick="get_explorecourse('govt', '', '4')">Govt.</a></li>
                        <?php 
                        foreach($get_popularcartegory as $popularcartegory){ ?>
                        <li class="nav-item"><a class="nav-link" href="#tab_<?php echo $popularcartegory->id; ?>"
                                role="tab"
                                onclick="get_explorecourse('dynamic', '<?php echo $popularcartegory->category_id; ?>', '<?php echo $popularcartegory->id; ?>')"
                                data-bs-toggle="tab"><?php echo $popularcartegory->name; ?></a></li>
                        <?php } ?>

                    </ul>
                </div>
                <!--Start Course Search-->
                <div class="course-search input-group mb-4 mt-3">
                    <input type="text" class="form-control bg-white typeahead " placeholder="Search For Course"
                        aria-label="Recipient's username" aria-describedby="button-addon2" id="items">
                    <button class="btn btn-dark-cerulean btn-shadow" type="button" id="button-addon2"
                        onclick="typeahead_explore_search()">
                        <svg id="search_4_" data-name="search (4)" xmlns="http://www.w3.org/2000/svg" width="24.894"
                            height="24.894" viewBox="0 0 24.894 24.894">
                            <g id="Group_16" data-name="Group 16" transform="translate(3.743 5.396)">
                                <g id="Group_15" data-name="Group 15">
                                    <path id="Path_5" data-name="Path 5"
                                        d="M80.108,111.245a.919.919,0,0,0-1.3,0,6.286,6.286,0,0,0-1.8,5.1.92.92,0,0,0,.914.828c.031,0,.062,0,.092,0a.92.92,0,0,0,.824-1.007,4.453,4.453,0,0,1,1.268-3.612A.919.919,0,0,0,80.108,111.245Z"
                                        transform="translate(-76.978 -110.976)" fill="#fff" />
                                </g>
                            </g>
                            <g id="Group_18" data-name="Group 18">
                                <g id="Group_17" data-name="Group 17">
                                    <path id="Path_6" data-name="Path 6"
                                        d="M10.516,0A10.516,10.516,0,1,0,21.032,10.516,10.528,10.528,0,0,0,10.516,0Zm0,19.192a8.676,8.676,0,1,1,8.676-8.676A8.686,8.686,0,0,1,10.516,19.192Z"
                                        fill="#fff" />
                                </g>
                            </g>
                            <g id="Group_20" data-name="Group 20" transform="translate(16.371 16.371)">
                                <g id="Group_19" data-name="Group 19">
                                    <path id="Path_7" data-name="Path 7"
                                        d="M344.962,343.663l-6.684-6.684a.92.92,0,0,0-1.3,1.3l6.684,6.684a.92.92,0,0,0,1.3-1.3Z"
                                        transform="translate(-336.709 -336.71)" fill="#fff" />
                                </g>
                            </g>
                        </svg>
                    </button>
                </div>
                <!--End Course Search-->
                <!-- Tab panes -->
                <div class="tab-content mt-2" style="display: none">
                    <div role="tabpanel" class="tab-pane fade show tabidload active" id="tab_1">
                        <!-- gx-3 gy-4 justify-content-center row -->
                        <div class="">
                            <div class="row justify-content-center gx-3 gy-4 loadexplorecourse" id="alldata">
                                <?php 
                                if($get_popularcourse){
                                    $s=0;
                                        $carts = $this->cart->contents();
                                        $carddata=[];
                                        // get course id from add to cart 
                                        foreach($carts as $item){
                                            $carddata[]= $item['id'];
                                        }
                                        
                                foreach($get_popularcourse as $popularcourse){ 
                                ?>
                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 hideClass"
                                    id="<?php echo  $popularcourse->id ;?>">
                                    <!--Start Course Card-->
                                    <div
                                        class="course-card course-card-shadow rounded-6 bg-white position-relative overflow-hidden">
                                        <div class="position-relative overflow-hidden bg-prussian-blue">
                                            <!--Start Course Image-->
                                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $popularcourse->course_id); ?>"
                                                class="course-card_img">
                                                <img src="<?php echo base_url(!empty($popularcourse->picture) ? $popularcourse->picture : default_600_400()); ?>"
                                                    class="img-fluid w-100" alt="">
                                            </a>
                                            <!--End Course Image-->
                                            <div
                                                class="align-items-center top-0 d-flex fs-12 position-absolute px-3 py-2 start-0 text-white w-100 z-index-2">
                                                <input type="hidden" value="<?php echo $popularcourse->course_id;?>"
                                                    id="course_id">
                                                <input type="hidden" value="<?php echo $user_id;?>" id="student_id">
                                                <input type="hidden" value="<?php echo $user_type;?>" id="user_type">
                                                <span class="badge-new  me-1">Most Popular</span>

                                                <span
                                                    class="badge-business"><?php echo html_escape($popularcourse->category_name);?></span>
                                                <span id="savecourse<?php echo $popularcourse->course_id; ?>"
                                                    class="ms-auto">
                                                    <?php
                                                $coursesaved_checked = $this->Frontend_model->coursesaved_checked($user_id,$popularcourse->course_id);
                                                if (!$coursesaved_checked){
                                                    if ($user_type == 4) {?>
                                                    <img onclick="get_coursesaveloop(1, '<?php echo $popularcourse->course_id; ?>')"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-1.png'); ?>"
                                                        class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                                    <?php } else { 
                                                     if($user_type != 5){
                                                    ?>
                                                    <img onclick="coursesavecheck()"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-1.png'); ?>"
                                                        class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                                    <?php }}
                                                }else {
                                                    ?>
                                                    <img onclick="get_coursesaveloop(0, '<?php echo $popularcourse->course_id; ?>')"
                                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-2.png'); ?>"
                                                        class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                                    <?php } ?>
                                                </span>
                                            </div>
                                            <?php if(!empty($popularcourse->is_discount==1)){ ?>
                                            <span
                                                class="px-0 badge m-3   position-absolute start-0 text-white   z-index-2 polygon-shape"
                                                style="top:25px">
                                                <span class="d-block fs-13 mb-1">Off</span>
                                                <span
                                                    class="fs-15 fw-bold"><?php  echo (($popularcourse->discount) ? $popularcourse->discount :''); ?><?php if($popularcourse->discount_type==2){ echo "%";}else{ echo " ";}?></span>
                                            </span>
                                            <?php }?>

                                            <!--Start Course Card Body-->
                                            <div
                                                class="bg-prussian-blue course-card_body course_middle px-3 py-2 text-white py-12">
                                                <!--Start Course Title-->
                                                <h3 class="course-card__course--title  mb-0 text-capitalize">
                                                    <a href="<?php echo base_url($enterprise_shortname. '/course-details/'. $popularcourse->course_id); ?>"
                                                        class="text-decoration-none text-white"><?php echo (!empty($popularcourse->name) ? $popularcourse->name : ''); ?></a>
                                                </h3>
                                                <!--End Course Title-->
                                                <div class="course-card__instructor d-flex align-items-center">
                                                    <div class="card__instructor--name my-2">
                                                        <a class="text-capitalize instructor-name"
                                                            href="<?php echo base_url($enterprise_shortname.'/instructor-profile-show/'.$popularcourse->faculty_id); ?>"><?php echo (!empty($popularcourse->instructor_name) ? $popularcourse->instructor_name : ''); ?></a>
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
                                                                                if (@$popularcourse->course_level == 1) {?>
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="bar-custom me-2">
                                                                                <span class="fill"></span>
                                                                                <span></span>
                                                                                <span></span>
                                                                            </div>
                                                                        </div>
                                                                        <?php } elseif (@$popularcourse->course_level == 2) {?>
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="bar-custom me-2">
                                                                                <span class="fill"></span>
                                                                                <span class="fill"></span>
                                                                                <span></span>
                                                                            </div>
                                                                        </div>
                                                                        <?php } elseif (@$popularcourse->course_level == 3) {?>
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
                                                                            if($popularcourse->course_level == 1){
                                                                                
                                                                                echo "Beginner Level";
                                                                            }elseif($popularcourse->course_level == 2){
                                                                                echo "Intermediate Level";
                                                                            }elseif($popularcourse->course_level == 3){
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
                                                                        <?php if($popularcourse->enterprise_name=='Admin'){ echo "Lead Academy";}else{ echo $popularcourse->enterprise_name." "."Academy";}?>
                                                                        <?php //echo (!empty($popularcourse->enterprise_name) ? $popularcourse->enterprise_name : ''); ?>
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
                                                                        $course_wise_lesson = $this->Course_model->course_wise_lesson( $popularcourse->course_id);
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
                                                                $course_wise_lesson = $this->Course_model->course_wise_lesson( $popularcourse->course_id);
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
                                                            $studentCount = $this->db->where('product_id', $popularcourse->course_id)->get('invoice_details')->num_rows();
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
                                                                <?php echo average_ratings_number($popularcourse->course_id,$enterprise_id);?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End Course Card Body-->
                                            <!--Start Course Card Hover Content-->
                                            <div class="course-card__hover--content">
                                                <img src="<?php echo base_url(!empty($popularcourse->hover_thumbnail) ? $popularcourse->hover_thumbnail :default_600_400()); ?>"
                                                    class="course-card__hover--content___img">
                                                <!--Start Video Icon With Popup Youtube-->
                                                <?php if($popularcourse->url){ ?>

                                                <a class="course-card__hover--content___icon popup-youtube"
                                                    href="<?php echo (!empty($popularcourse->url)? $popularcourse->url : ''); ?>"
                                                    autoplay>
                                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/Playicon.png'); ?>"
                                                        class="img-fluid" alt="">
                                                </a>
                                                <?php } ?>
                                                <!--End Video Icon With Popup Youtube-->

                                                <h3
                                                    class="bottom-0 course-card__hover--content___text d-block fs-15 mb-0 position-absolute text-capitalize text-decoration-none text-white">
                                                    <a href="<?php echo base_url($enterprise_shortname. '/course-details/'. $popularcourse->course_id); ?>"
                                                        class="text-decoration-none text-white"><?php echo (!empty($popularcourse->name) ? $popularcourse->name : ''); ?></a>
                                                </h3>
                                            </div>
                                        </div>
                                        <?php 
                                        $course_types = json_decode($popularcourse->course_type);
                                        $checked_purchase = $this->db->where('customer_id',$user_id)->where('product_id', $popularcourse->course_id)->where('status',1)->get('invoice_details')->row();
                                        ?>
                                        <div class="course-card_footer g-2 px-3 py-12">
                                            <?php 
                                            // check purchase or subscription 
                                            if($checked_purchase){?>
                                            <div class="d-block">
                                                <div class="align-items-center d-flex form-check ps-0">
                                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                                        name="flexRadioDefault1_<?php echo $popularcourse->course_id?>"
                                                        id="flexRadioDefault1_<?php echo $popularcourse->course_id?>"
                                                        onclick="subscriptionchecedRadio('<?php echo $popularcourse->course_id;?>')"
                                                        disabled>
                                                    <label class="form-check-label fw-bold opa-half course_price_cart"
                                                        for="flexRadioDefault1">
                                                        Subscription
                                                    </label>
                                                </div>
                                                <div class="align-items-center d-flex form-check ps-0">
                                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                                        name="flexRadioDefault2_<?php echo $popularcourse->course_id?>"
                                                        id="flexRadioDefault2_<?php echo $popularcourse->course_id?>"
                                                        onclick="coursechecedRadio('<?php echo $popularcourse->course_id;?>')"
                                                        disabled>
                                                    <label
                                                        class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                                        style="width:100%;"
                                                        for="flexRadioDefault2_<?php echo $popularcourse->course_id?>">
                                                        <span class="course_price_cart">Course Price
                                                            <span class="text-success">
                                                            </span>
                                                        </span>
                                                        <span class="align-items-center d-flex  rounded text-center">
                                                            <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                                <?php echo (($popularcourse->is_offer == 1) ? number_format($popularcourse->offer_courseprice) : number_format($popularcourse->price)); ?></span>
                                                            <?php if(!empty($popularcourse->is_discount==1)){?>
                                                            <del
                                                                class="fs-12 fw-bold text-muted2"><?php echo (($popularcourse->oldprice)?number_format($popularcourse->oldprice) :" "); ?></del>
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
                                                            <span
                                                                class="text-center w-100 fw-bold fs-13">Enrolled</span>
                                                        </a>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $popularcourse->course_id); ?>"
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
                                            <!-- before purchase  -->
                                            <!-- add to cart  -->
                                            <input type="hidden" name="course_id"
                                                id="course_id_<?php echo html_escape($popularcourse->course_id); ?>"
                                                value="<?php echo html_escape($popularcourse->course_id); ?>">
                                            <input type="hidden" name="course_name"
                                                id="course_name_<?php echo html_escape($popularcourse->course_id); ?>"
                                                value="<?php echo html_escape($popularcourse->name); ?>">
                                            <input type="hidden" name="slug" id="slug_<?php echo html_escape($popularcourse->course_id); ?>"
                                                value="<?php echo html_escape($popularcourse->slug); ?>">
                                            <input type="hidden" name="qty" id="qty" value="1">
                                            <input type="hidden" name="price"
                                                id="price_<?php echo html_escape($popularcourse->course_id); ?>"
                                                value="<?php if($popularcourse->is_offer == 1){ echo $popularcourse->offer_courseprice; }else{ echo $popularcourse->price; } ?>">
                                            <input type="hidden" name="old_price"
                                                id="old_price_<?php echo html_escape($popularcourse->course_id); ?>"
                                                value="<?php echo html_escape($popularcourse->oldprice); ?>">
                                            <input type="hidden" name="picture"
                                                id="picture_<?php echo html_escape($popularcourse->course_id); ?>"
                                                value="<?php echo html_escape($popularcourse->picture); ?>">
                                            <input type="hidden" name="is_course_type" id="iscourse_type" value="0">
                                                <!-- add to cart  -->
                                            <div class="d-block">
                                                <?php if (in_array("1", $course_types) && in_array("2", $course_types)) {?>
                                                
                                                <input type="hidden" class="course"
                                                    value="<?php echo $popularcourse->course_id;?>"
                                                    id="<?php echo $popularcourse->course_id;?>">
                                                <div class="align-items-center d-flex form-check ps-0">
                                                    <!-- <input class="form-check-input" type="radio" name="flexRadioDefault1_<?php echo $popularcourse->course_id?>" id="flexRadioDefault1_<?php echo $popularcourse->course_id?>"  onclick="subscriptionchecedRadio('<?php echo $popularcourse->course_id;?>')" > -->
                                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                                        name="flexRadioDefault1_<?php echo $popularcourse->course_id?>"
                                                        id="flexRadioDefault1_<?php echo $popularcourse->course_id?>"
                                                        onclick="subscriptionchecedRadio('<?php echo $popularcourse->course_id;?>')">
                                                    <label class="form-check-label fw-bold course_price_cart "
                                                        for="flexRadioDefault1_<?php echo $popularcourse->course_id?>">
                                                        Subscription
                                                    </label>
                                                </div>
                                                <div class="form-check d-flex align-items-center ps-0">
                                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                                        name="flexRadioDefault2_<?php echo $popularcourse->course_id?>"
                                                        id="flexRadioDefault2_<?php echo $popularcourse->course_id?>"
                                                        onclick="coursechecedRadio('<?php echo $popularcourse->course_id;?>')"
                                                        checked>
                                                    <label
                                                        class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                                        style="width:100%;"
                                                        for="flexRadioDefault2_<?php echo $popularcourse->course_id?>">
                                                        <span class="course_price_cart">Course Price
                                                            <span class="text-success">
                                                            </span>
                                                        </span>
                                                        <span class="align-items-center d-flex  rounded text-center">
                                                            <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                                <?php echo (($popularcourse->is_offer == 1) ? number_format($popularcourse->offer_courseprice) : number_format($popularcourse->price)); ?></span>
                                                            <?php if(!empty($popularcourse->is_discount==1)){?>
                                                            <del
                                                                class="fs-12 fw-bold text-muted2"><?php echo (($popularcourse->oldprice)?number_format($popularcourse->oldprice) :" "); ?></del>
                                                            <?php }?>

                                                        </span>
                                                    </label>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-stretch mt-2"
                                                    id="course_purchase_<?php echo $popularcourse->course_id?>">
                                                    <div class="flex-grow-1 me-2 w-sub">
                                                         <?php //echo base_url($enterprise_shortname.'/course-details/'. $popularcourse->course_id); ?>
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14 <?php if($carddata[$s] == $popularcourse->course_id){ echo "cart_in_disable";}?>" id="cart_in_disable<?php echo $popularcourse->course_id;?>">
                                                            <span class="shopping me-1 shopping_icon position-relative">
                                                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                                    style="width: 14px;">
                                                            </span>
                                                            
                                                            <?php if($carddata[$s] == $popularcourse->course_id){?>
                                                            <span class="text-center w-100 fw-bold fs-13" >Cart in
                                                            </span>
                                                            <?php }else{?>
                                                            <span class="text-center w-100 fw-bold fs-13" onclick="addtocart('<?php echo html_escape($popularcourse->course_id); ?>')" id="cart_in_<?php echo $popularcourse->course_id?>"> Add To Cart
                                                            </span>
                                                            <?php }?>
                                                        </a>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $popularcourse->course_id); ?>"
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
                                                    id="course_subscription_<?php echo $popularcourse->course_id?>">
                                                    <div class="flex-grow-1 me-2 w-sub">
                                                        <a href="<?php echo base_url($enterprise_shortname.'/subscription-details'); ?>"
                                                            class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                            <span class="shopping me-1 shopping_icon position-relative">
                                                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                                    style="width: 14px;">
                                                            </span>
                                                            <span class="text-center w-100 fw-bold fs-13"> Get Stared
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $popularcourse->course_id); ?>"
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
                                                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $popularcourse->course_id); ?>" class="btn btn-dark-cerulean w-100">
                                                                <i data-feather="info" class="me-1"></i>
                                                                Details
                                                            </a>
                                                        </div>
                                                    </div> -->
                                                <?php }elseif(in_array("1", $course_types)){?>
                                                <div class="align-items-center d-flex form-check ps-0">
                                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                                        name="flexRadioDefault1_<?php echo $popularcourse->course_id?>"
                                                        id="flexRadioDefault1_<?php echo $popularcourse->course_id?>"
                                                        onclick="subscriptionchecedRadio('<?php echo $popularcourse->course_id;?>')"
                                                        disabled>
                                                    <label class="form-check-label fw-bold opa-half course_price_cart"
                                                        for="flexRadioDefault1">
                                                        Subscription
                                                    </label>
                                                </div>
                                                <div class="form-check d-flex align-items-center ps-0">
                                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                                        name="flexRadioDefault2_<?php echo $popularcourse->course_id?>"
                                                        id="flexRadioDefault2_<?php echo $popularcourse->course_id?>"
                                                        onclick="coursechecedRadio('<?php echo $popularcourse->course_id;?>')"
                                                        checked>
                                                    <label
                                                        class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                                        style="width:100%"
                                                        for="flexRadioDefault2_<?php echo $popularcourse->course_id?>">
                                                        <span class="course_price_cart">Course Price <span
                                                                class="text-success"></span>
                                                        </span>
                                                        <span class="align-items-center d-flex  rounded text-center">
                                                            <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                                <?php echo (($popularcourse->is_offer == 1) ? number_format($popularcourse->offer_courseprice) : number_format($popularcourse->price)); ?></span>
                                                            <?php if(!empty($popularcourse->is_discount==1)){?>
                                                            <del
                                                                class="fs-12 fw-bold text-muted2"><?php echo (($popularcourse->oldprice)?number_format($popularcourse->oldprice) :" "); ?></del>
                                                            <?php }?>
                                                        </span>

                                                    </label>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-stretch mt-2">
                                                    <div class="flex-grow-1 me-2 w-sub">
                                                    <?php //echo base_url($enterprise_shortname.'/course-details/'. $popularcourse->course_id); ?>
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14 <?php if($carddata[$s] == $popularcourse->course_id){ echo "cart_in_disable";}?>" id="cart_in_disable<?php echo $popularcourse->course_id;?>">
                                                            <span class="shopping me-1 shopping_icon position-relative">
                                                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                                    style="width: 14px;">
                                                            </span>
                                                            <?php d($carddata);?>
                                                            <?php  if($carddata[$s] == $popularcourse->course_id){?>
                                                            <span class="text-center w-100 fw-bold fs-13" >Cart in
                                                            </span>
                                                            <?php }else{?>
                                                            <span class="text-center w-100 fw-bold fs-13" onclick="addtocart('<?php echo html_escape($popularcourse->course_id); ?>')" id="cart_in_<?php echo $popularcourse->course_id?>"> Add To Cart</span>
                                                             <?php }?> sdfgasdfg
                                                        </a>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $popularcourse->course_id); ?>"
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
                                                        name="flexRadioDefault1_<?php echo $popularcourse->course_id?>"
                                                        id="flexRadioDefault1_<?php echo $popularcourse->course_id?>"
                                                        onclick="subscriptionchecedRadio('<?php echo $popularcourse->course_id;?>')"
                                                        checked>
                                                    <label class="form-check-label fw-bold course_price_cart"
                                                        for="flexRadioDefault1_<?php echo $popularcourse->course_id?>">
                                                        Subscription
                                                    </label>
                                                </div>
                                                <div class="form-check d-flex align-items-center ps-0 ">
                                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                                        name="flexRadioDefault2_<?php echo $popularcourse->course_id?>"
                                                        id="flexRadioDefault2_<?php echo $popularcourse->course_id?>"
                                                        onclick="coursechecedRadio('<?php echo $popularcourse->course_id;?>')"
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
                                                        <a href="<?php echo base_url($enterprise_shortname.'/subscription-details'); ?>"
                                                            class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                            <span class="shopping me-1 shopping_icon position-relative">
                                                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                                    style="width: 14px;">
                                                            </span>
                                                            <span class="text-center w-100 fw-bold fs-13"> Get Stared
                                                            </span>
                                                        </a>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $popularcourse->course_id); ?>"
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
                                                        name="flexRadioDefault1_<?php echo $popularcourse->course_id?>"
                                                        id="flexRadioDefault1_<?php echo $popularcourse->course_id?>"
                                                        onclick="subscriptionchecedRadio('<?php echo $popularcourse->course_id;?>')"
                                                        disabled>
                                                    <label class="form-check-label fw-bold opa-half course_price_cart"
                                                        for="flexRadioDefault1">
                                                        Subscription
                                                    </label>
                                                </div>
                                                <div class="align-items-center d-flex form-check ps-0">
                                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                                        name="flexRadioDefault2_<?php echo $popularcourse->course_id?>"
                                                        id="flexRadioDefault2_<?php echo $popularcourse->course_id?>"
                                                        onclick="coursechecedRadio('<?php echo $popularcourse->course_id;?>')"
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
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $popularcourse->course_id); ?>"
                                                            class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                            <span class="shopping me-1 shopping_icon position-relative">
                                                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                                    style="width: 14px;">
                                                            </span>
                                                            <span class="text-center w-100 fw-bold fs-13"> Enroll Free </span>
                                                        </a>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $popularcourse->course_id); ?>"
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
                                                        name="flexRadioDefault1_<?php echo $popularcourse->course_id?>"
                                                        id="flexRadioDefault1_<?php echo $popularcourse->course_id?>"
                                                        onclick="subscriptionchecedRadio('<?php echo $popularcourse->course_id;?>')"
                                                        disabled>
                                                    <label class="form-check-label fw-bold opa-half course_price_cart"
                                                        for="flexRadioDefault1">
                                                        Subscription
                                                    </label>
                                                </div>
                                                <div class="align-items-center d-flex form-check ps-0">
                                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                                        name="flexRadioDefault2_<?php echo $popularcourse->course_id?>"
                                                        id="flexRadioDefault2_<?php echo $popularcourse->course_id?>"
                                                        onclick="coursechecedRadio('<?php echo $popularcourse->course_id;?>')"
                                                        disabled>
                                                    <label
                                                        class="align-items-center d-flex form-check-label fw-bold justify-content-between opa-half"
                                                        for="flexRadioDefault2_<?php echo $popularcourse->course_id?>">
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
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $popularcourse->course_id); ?>"
                                                            class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                            <span class="shopping me-1 shopping_icon position-relative">
                                                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                                    style="width: 14px;">
                                                            </span>
                                                            <span class="text-center w-100 fw-bold fs-13"> Govt </span>
                                                        </a>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $popularcourse->course_id); ?>"
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
                                <?php 
                                      $s++;
                                        } 
                                    } 
                                ?>
                            </div>

                        </div>
                    </div>
                </div>
                <input type="hidden" id="course_type" value="popular">
                <input type="hidden" id="category_id" value="">
                <?php 
                    $this->db->select('*');
                    $this->db->from('course_tbl');
                    $this->db->where('enterprise_id', $enterprise_id);
                    $this->db->where('tagstatus',4);
                    $this->db->where('status', 1);
                    $this->db->where('is_livecourse', 0);
                    $query = $this->db->get()->num_rows();

                // if($query >8){ 
                ?>
                <!-- <div class="text-center mt-5 firstbutton removebuton_<?php echo (!empty($popularcourse->id) ? $popularcourse->id : '');?>">
                    <div id="home_course_load<?php echo (!empty($popularcourse->id) ? $popularcourse->id : '');?>">
                        <button type="button"
                            onClick="loadmore_data(<?php echo (!empty($popularcourse->id) ? $popularcourse->id : '');?>);"
                            class="btn btn-lg btn-dark-cerulean home_course_load"
                            id="<?php echo (!empty($popularcourse->id) ? $popularcourse->id : '');?>">
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
                <div class="text-center mt-5 firstbutton">
                    <a href="<?php echo base_url($enterprise_shortname. '/allcourse/'); ?>"
                        class="btn btn-lg btn-dark-cerulean">
                        Browse more Courses
                        <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="28.56" height="15.666"
                            viewBox="0 0 28.56 15.666">
                            <path id="right-arrow_3_" data-name="right-arrow (3)"
                                d="M20.727,107.5l-1.272,1.272,5.661,5.661H0v1.8H25.116l-5.661,5.661,1.272,1.272,7.833-7.833Z"
                                transform="translate(0 -107.5)" fill="#fff"></path>
                        </svg>
                    </a>
                </div>
                <?php //} ?>
            </div>
        </div>
    </div>
</div>
<!--End Course Content-->
<!--Start Brand Logo-->

<div class="brand-logo-content bg-alice-blue py-5">
    <div class="container-lg">
        <div class="text-center mb-5">
            <h3 class="fw-bold mb-0"><?php echo display('we_collaborate_with'); ?></h3>
        </div>
        <div class="collaborate2-carousel owl-carousel text-center">
            <?php 
                    if($company_list){ 
                    foreach($company_list as $company){
                        $myString = $company->picture;
                        $array = explode('.',$company->picture);
                        $extension = end($array);
                        // style="pointer-events: none;"
                ?>
            <div class="brand_item">
                <a href="<?php echo ($company->link)?$company->link:'javascript:void(0)';?>" target="_blank">

                    <?php if($extension=='svg'){?>
                    <object data="<?php echo base_url($company->picture); ?>" width="100%" height="100%"
                        style="pointer-events: none;"> </object>

                    <?php }else{?>
                    <img src="<?php echo base_url(!empty($company->picture) ? $company->picture : 'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/brand-logo/01.png'); ?>"
                        alt="">
                    <?php }?>
                </a>
                <?php //print_r($extension);//print_r($dd[1]);  ?>
            </div>
            <?php }}?>

        </div>
    </div>
</div>
<!--End Brand Logo-->
<div class="bg-white py-5">
    <div class="container-lg">
        <div class="row mt-5">

            <div class="col-lg-6 mb-5 pe-xl-5">
                <h3 class="fw-bold mb-5 text-center text-lg-start text-uppercase">Learn Anything, Anywhere
                    And Accelerate <span class="text-navy-blue">Your Future</span></h3>
                <a href="<?php echo base_url($enterprise_shortname. '/allcourse/'); ?>">
                    <img src="<?php echo base_url(html_escape((!empty($get_appseeting->lead_featured_image) ? "$get_appseeting->lead_featured_image" : 'application/modules/frontend/views/themes/'.html_escape(get_activethemes()->name).'/assets/img/learn.png'))); ?>"
                        class="img-fluid" alt="">
                </a>
            </div>
            <div class="col-lg-6">

                <div class="row g-3">
                    <!-- d-flex -->
                    <?php 
                              
                $list= $this->db->select('a.featuredin_id, a.name,a.summary, a.link, b.picture')
                ->from('featuredin_tbl a')
                ->join('picture_tbl b', 'b.from_id = a.featuredin_id', 'left')
                ->where('a.enterprise_id', $enterprise_id)
                ->where('a.type',1)
                ->order_by('a.ordering', 'asc')
                ->limit('4')
                ->get()->result();
                // print_r();
            //   $list= $this->db->select("*")->from('featuredin_tbl')->where('type',1)->order_by('id','asc')->limit('3')->get()->result();
               foreach($list as $featuredin){
                    $array = explode('.',$featuredin->picture);
                    $extension = end($array);
                ?>
                    <div class="col-12 col-sm-6 text-center d-flex">
                        <div class="shadow p-4 bg-alice-blue w-100">
                            <div class="icon mb-3">
                                <a href="<?php echo ($featuredin->link)?$featuredin->link:'javascript:void(0)';?>"
                                    target="_blank" class="text-dark d-block">
                                    <?php if($extension=='svg'){?>
                                    <object data="<?php echo base_url($featuredin->picture); ?>" width="100%"
                                        height="100%" style="pointer-events: none;"> </object>
                                    <?php }else{?>
                                    <img src="<?php echo base_url((!empty($featuredin->picture)?$featuredin->picture:'')); ?>"
                                        class="img-fluid" alt="">
                                    <?php }?>
                                </a>
                            </div>
                            <h4 class="h5 fw-bold"><a
                                    href="<?php echo base_url($enterprise_shortname . '/comming-soon'); ?>"
                                    class="text-center text-dark"><?php echo $featuredin->name;?></a></h4>
                            <p class="mb-0"><?php echo $featuredin->summary;?>
                            </p>
                        </div>
                    </div>
                    <?php }?>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="brand-logo-content bg-alice-blue py-5">
    <div class="container-lg">
        <div class="text-center mb-5">
            <h3 class="fw-bold mb-0">Featured In</h3>
        </div>
        <div class="collaborate2-carousel owl-carousel text-center">
            <?php 
                            if(!empty($featuredin_list)){
                            foreach($featuredin_list as $featuredin){
                            $array = explode('.',$featuredin->picture);
                            $extension = end($array);
                        ?>
            <div class="brand_item">
                <a href="<?php echo ($featuredin->link)?$featuredin->link:'javascript:void(0)';?>"
                    <?php if($featuredin->link){ ?>target="_blank" <?php } ?>>
                    <?php //if($extension=='svg'){?>
                    <!-- <object data="<?php echo base_url($featuredin->picture); ?>" width="100%" height="100%"  ></object> -->
                    <?php //}else{?>
                    <img src="<?php echo base_url((!empty($featuredin->picture)?$featuredin->picture:'')); ?>" alt="">
                    <?php //}?>
                </a>
            </div>
            <?php 
            }
            } 
            ?>
        </div>
    </div>
</div>


<!--End Brand Logo-->

<!--Start Counter-->
<?php 
$coursecount=$this->db->where('status!=',3)->where('is_draft',0)->where('enterprise_id',$enterprise_id)->get('course_tbl')->num_rows();
$totalStudentcount=$this->db->where('status',1)->where('enterprise_id',$enterprise_id)->get('students_tbl')->num_rows();$courseCompleteStudent=$this->db->where('status',1)->where('complete_status',1)->where('enterprise_id',$enterprise_id)
->get('invoice_details')->num_rows();
?>
<div class="counter-content pt-5 pb-4">
    <div class="container-lg">
        <div class="text-center mb-5">
            <h3 class="fw-bold mb-0 text-uppercase">Strength in Numbers</h3>

        </div>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-3 mb-4 text-center border-end">
                        <h3 class="fw-bold h1 mb-1"><span class="counter d-inline-block">
                                <?php echo !empty($get_appseeting->learner_count) ? $get_appseeting->learner_count : ''; ?><?php //echo $totalStudentcount;?></span>
                        </h3>
                        <div>Learners & counting</div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3 mb-4 text-center border-end">
                        <h3 class="fw-bold h1 mb-1"><span class="counter d-inline-block">
                                <?php echo !empty($get_appseeting->total_course) ? $get_appseeting->total_course : ''; ?><?php //echo  $coursecount;?></span>
                        </h3>
                        <div>Total courses</div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3 mb-4 text-center border-end">
                        <h3 class="fw-bold h1 mb-1"><span class="counter d-inline-block">
                                <?php echo !empty($get_appseeting->language_count) ? $get_appseeting->language_count : ''; ?></span>
                        </h3>
                        <div>Languages</div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3 mb-4 text-center">
                        <h3 class="fw-bold h1 mb-1"><span class="counter d-inline-block">
                                <?php echo !empty($get_appseeting->successfully_students) ? $get_appseeting->successfully_students : ''; ?><?php //echo  $courseCompleteStudent;?></span>
                        </h3>
                        <div>Successful students</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Counter-->
<!--Start Testimonial-->
<div class="testimonial-content py-5">
    <div class="text-center mb-5">
        <div class="">Testimonials</div>
        <h3 class="fw-bold mb-0">What Our Learners Are Saying</h3>
    </div>
    <div class="container-lg">
        <div class="testimonial-carousel owl-carousel owl-theme">
            <?php if($get_testimonials){ 
                foreach($get_testimonials as $testimonial){

            ?>
            <div class="testimonial-box rounded-20 p-4 p-md-5 p-lg-4 p-xl-5">
                <div class="">
                    <img src="<?php echo base_url(!empty($testimonial->company_image) ? $testimonial->company_image:''); ?>"
                        alt="" class="img-fluid">
                </div>
                <br>
                <div class="customer-ratting mb-3">
                    <?php if($testimonial->rating_number==5){?>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <?php }elseif($testimonial->rating_number==4){?>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>

                    <?php }elseif($testimonial->rating_number==3){?>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>

                    <?php }elseif($testimonial->rating_number==2){?>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <?php }else{?>
                    <i class="fas fa-star"></i>
                    <?php }?>
                </div>
                <div class="quote-text">
                    <?php echo (!empty($testimonial->description) ? $testimonial->description : ''); ?></div>
                <div class="avatar d-flex align-items-center mt-4">
                    <div class="avatar-img me-3">
                        <img src="<?php echo base_url(!empty(get_picturebyid($testimonial->user_id)->picture) ? get_picturebyid($testimonial->user_id)->picture : default_image()); ?>"
                            alt="">
                    </div>
                    <div class="avatar-text">
                        <h5 class="avatar-name mb-1">
                            <?php echo (get_studentinfo($testimonial->user_id)?get_studentinfo($testimonial->user_id)->name:'');?>
                        </h5>
                        <div class="avatar-designation text-muted">
                            <?php echo (!empty($testimonial->designation) ? $testimonial->designation : ''); ?></div>
                    </div>

                </div>

            </div>
            <?php 
               } 
             } 
           ?>
        </div>
    </div>
</div>
<!--End Testimonial-->
<!--Start Pricing Table-->
<?php 
if($get_appseeting){
if($get_appseeting->is_ready_subscription == 1){ ?>
<div class="pricing-content py-5">
    <div class="container-lg">
        <div class="text-center mb-5">
            <h3 class="fw-bold mb-1">Ready To Start? </h3>
            <!-- <div class="">Save 30% an annual plan.we support bKASH/ Nagad for an individual<br> annual plan only.Any
                Question ? <a href="#">Contact Us</a></div> -->
        </div>
        <div class="row justify-content-center">
            <div class="col-xxl-10">
                <div class="pricing-container">
                    <div class="pricing-switcher">
                        <div class="fieldset d-inline-flex position-relative">
                            <input type="radio" name="duration-1" value="monthly" id="monthly-1" checked>
                            <label for="monthly-1">Monthly</label>
                            <input type="radio" name="duration-1" value="yearly" id="yearly-1">
                            <label for="yearly-1">Yearly</label>
                            <span class="switch position-absolute"></span>
                        </div>
                    </div>

                    <ul
                        class="bounce-invert d-flex g-3 justify-content-center list-unstyled mb-0 mt-5 pricing-list row">
                        <?php 
                        $free= $this->db->select("*")->from("subscription_tbl")->where("duration",3)->where("status",1)->where("enterprise_id",1)->order_by('id','desc')->limit('1')->get()->row();
                        if( $free){
                        $course_free=json_decode($free->course_sub_content);
                        ?>
                        <li class="col-sm-6 col-md-6 col-lg-4 d-flex">
                            <ul class="pricing-wrappers list-unstyled pricing-features  text-start">
                                <li class="d-flex flex-wrap h-100 align-content-between">
                                    <header class="pricing-header text-center pt-5 pb-4 w-100">
                                        <h2 class="mb-0"><?php echo $free->title?$free->title:'';?></h2>
                                        <div class="price">
                                            <span class="value fw-semi-bold">Free</span>
                                        </div>
                                    </header>
                                    <div class="pricing-body w-100">
                                        <ul class="list-unstyled pricing-features px-5 text-start">
                                            <?php foreach($course_free as $course_content){?>
                                            <li>
                                                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="12.574"
                                                    height="9.234" viewBox="0 0 12.574 9.234">
                                                    <path id="Path_8" data-name="Path 8"
                                                        d="M12.389,68.182a.629.629,0,0,0-.889,0L3.968,75.714l-2.9-2.9a.629.629,0,0,0-.889.889l3.34,3.34a.629.629,0,0,0,.889,0l7.977-7.977A.629.629,0,0,0,12.389,68.182Z"
                                                        transform="translate(0 -67.997)" fill="#fff"></path>
                                                </svg>
                                                <?php echo html_escape($course_content);?>
                                            </li>
                                            <?php }?>

                                        </ul>
                                    </div>
                                    <footer class="pricing-footer w-100">
                                        <?php  if($user_type==4){?>
                                        <a class="select d-inline-flex justify-content-center align-items-center"
                                            href="javascript:void(0);">
                                            <div class="btn-icon d-flex align-items-center justify-content-center me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15.793" height="15.793"
                                                    viewBox="0 0 15.793 15.793">
                                                    <path id="Path_357" data-name="Path 357"
                                                        d="M15.3,1.922,13.87.491a1.679,1.679,0,0,0-2.372,0L.851,11.139a.471.471,0,0,0-.128.243L.008,15.246a.463.463,0,0,0,.539.539l3.864-.716a.471.471,0,0,0,.243-.128L15.3,4.294A1.676,1.676,0,0,0,15.3,1.922ZM1.04,14.753l.433-2.338,1.9,1.9Zm3.287-.792L1.833,11.466l9.106-9.107,2.494,2.494ZM14.647,3.639l-.56.56L11.593,1.705l.56-.56a.752.752,0,0,1,1.063,0l1.431,1.431A.751.751,0,0,1,14.647,3.639Z"
                                                        transform="translate(0 0)" fill="#fff"></path>
                                                </svg>
                                            </div>
                                            Already enrolled
                                        </a>
                                        <?php }else{ ?>
                                        <a class="select d-inline-flex justify-content-center align-items-center"
                                            href="<?php echo base_url($enterprise_shortname.'/student-signup');?>">
                                            <div class="btn-icon d-flex align-items-center justify-content-center me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15.793" height="15.793"
                                                    viewBox="0 0 15.793 15.793">
                                                    <path id="Path_357" data-name="Path 357"
                                                        d="M15.3,1.922,13.87.491a1.679,1.679,0,0,0-2.372,0L.851,11.139a.471.471,0,0,0-.128.243L.008,15.246a.463.463,0,0,0,.539.539l3.864-.716a.471.471,0,0,0,.243-.128L15.3,4.294A1.676,1.676,0,0,0,15.3,1.922ZM1.04,14.753l.433-2.338,1.9,1.9Zm3.287-.792L1.833,11.466l9.106-9.107,2.494,2.494ZM14.647,3.639l-.56.56L11.593,1.705l.56-.56a.752.752,0,0,1,1.063,0l1.431,1.431A.751.751,0,0,1,14.647,3.639Z"
                                                        transform="translate(0 0)" fill="#fff"></path>
                                                </svg>
                                            </div>
                                            Enroll
                                        </a>
                                        <?php }?>

                                    </footer>
                                </li>
                            </ul>
                        </li>
                        <?php }?>
                        <li class="col-sm-6 col-md-6 col-lg-4 exclusive d-flex">
                            <?php 
                              $monthly= $this->db->select("*")->from("subscription_tbl")->where("duration",1)->where("status",1)->where("enterprise_id",1)->order_by('id','desc')->limit('1')->get()->result();
                              $yearly= $this->db->select("*")->from("subscription_tbl")->where("duration",2)->where("status",1)->where("enterprise_id",1)->order_by('id','desc')->limit('1')->get()->result();
                            ?>
                            <ul class="pricing-wrapper list-unstyled position-relative">


                                <?php
                                if(!empty($monthly)){
                                 foreach($monthly as $value){
                                ?>

                                <li data-type="monthly" class="is-visible d-flex flex-wrap h-100 align-content-between">
                                    <?php if($value->oldprice){ ?>
                                    <h6 class=" p-2 position-absolute rounded-pill start-50 text-capitalize text-center translate-middle w-sub text-white"
                                        style="background-color:#fe0000;">Limited time only</h6>
                                    <?php }?>
                                    <header class="pricing-header text-center pt-5 pb-4 w-100">
                                        <h2><?php echo html_escape($value->title);?></h2>
                                        <?php if($value->oldprice){ ?>
                                        <h6 class="mx-auto p-2 rounded text-capitalize text-center text-warning w-sub"
                                            style="background-color: #15243a;">Before :BDT
                                            <del><?php echo number_format($value->oldprice);?></del>/month
                                        </h6>
                                        <!-- <span>End Time <p id="example"></p></span> -->
                                        <?php }?>
                                        <div class="align-items-center d-flex justify-content-center price">
                                            <span class="currency fs-5 fw-bold mt-0">BDT</span>
                                            <span
                                                class="fw-bold value"><?php echo html_escape(number_format($value->price)); ?></span>
                                            <span
                                                class="duration fw-bold text-lowercase text-white"><?php if($value->duration==1){ echo "Month";}?></span>
                                        </div>
                                        <!-- <p class="mb-0"><?php echo html_escape($value->title);?></p> -->
                                    </header>
                                    <div class="pricing-body w-100">
                                        <?php 
                                         if($value->course_sub_content){
                                             $course_content=json_decode($value->course_sub_content);
                                          }
                                        ?>
                                        <ul class="list-unstyled pricing-features px-5 text-start">
                                            <?php foreach($course_content as $contentval){?>
                                            <li>
                                                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="12.574"
                                                    height="9.234" viewBox="0 0 12.574 9.234">
                                                    <path id="Path_8" data-name="Path 8"
                                                        d="M12.389,68.182a.629.629,0,0,0-.889,0L3.968,75.714l-2.9-2.9a.629.629,0,0,0-.889.889l3.34,3.34a.629.629,0,0,0,.889,0l7.977-7.977A.629.629,0,0,0,12.389,68.182Z"
                                                        transform="translate(0 -67.997)" fill="#fff"></path>
                                                </svg>
                                                <?php echo html_escape($contentval);?>
                                            </li>
                                            <?php }?>
                                        </ul>
                                    </div>
                                    <footer class="pricing-footer w-100">
                                        <a class="select d-inline-flex justify-content-center align-items-center"
                                            href="<?php echo base_url($enterprise_shortname.'/subscription-details'); ?>">
                                            <div class="btn-icon d-flex align-items-center justify-content-center me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15.793" height="15.793"
                                                    viewBox="0 0 15.793 15.793">
                                                    <path id="Path_357" data-name="Path 357"
                                                        d="M15.3,1.922,13.87.491a1.679,1.679,0,0,0-2.372,0L.851,11.139a.471.471,0,0,0-.128.243L.008,15.246a.463.463,0,0,0,.539.539l3.864-.716a.471.471,0,0,0,.243-.128L15.3,4.294A1.676,1.676,0,0,0,15.3,1.922ZM1.04,14.753l.433-2.338,1.9,1.9Zm3.287-.792L1.833,11.466l9.106-9.107,2.494,2.494ZM14.647,3.639l-.56.56L11.593,1.705l.56-.56a.752.752,0,0,1,1.063,0l1.431,1.431A.751.751,0,0,1,14.647,3.639Z"
                                                        transform="translate(0 0)" fill="#fff"></path>
                                                </svg>
                                            </div>
                                            Subscribe
                                        </a>
                                    </footer>
                                </li>
                                <?php } } if(!empty($yearly)){
                                  foreach($yearly as $values){     
                                ?>
                                <li data-type="yearly" class="is-hidden d-flex flex-wrap h-100 align-content-between">
                                    <?php if($values->oldprice){ ?>
                                    <h6 class=" p-2 position-absolute rounded-pill start-50 text-capitalize text-center translate-middle w-sub text-white"
                                        style="background-color:#fe0000;">Limited time only</h6>
                                    <?php }?>
                                    <header class="pricing-header text-center pt-5 pb-4 w-100">
                                        <h2><?php echo html_escape($values->title);?></h2>
                                        <?php if($values->oldprice){ ?>
                                        <h6 class="mx-auto p-2 rounded text-capitalize text-center text-warning w-sub"
                                            style="background-color: #15243a;">Before :BDT
                                            <del><?php echo number_format($values->oldprice);?></del>/year
                                        </h6>
                                        <!-- <span>End Time <p id="example"></p></span> -->
                                        <?php }?>
                                        <div class="align-items-center d-flex justify-content-center price">
                                            <span class="currency fs-5 fw-bold mt-0">BDT</span>
                                            <span
                                                class="fw-bold value"><?php echo html_escape(number_format($values->price)); ?></span>
                                            <span
                                                class="duration fw-bold text-lowercase text-white"><?php if($values->duration==2){ echo "YR";}?></span>
                                        </div>
                                        <!-- <p class="mb-0">Per Month / billed Monthly</p> -->
                                    </header>
                                    <div class="pricing-body w-100">
                                        <ul class="list-unstyled pricing-features px-5 text-start">
                                            <?php 
                                            if($values->course_sub_content){
                                                $coursecontent=json_decode($values->course_sub_content);
                                                }
                                            foreach($coursecontent as $contentval){
                                            ?>
                                            <li>
                                                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="12.574"
                                                    height="9.234" viewBox="0 0 12.574 9.234">
                                                    <path id="Path_8" data-name="Path 8"
                                                        d="M12.389,68.182a.629.629,0,0,0-.889,0L3.968,75.714l-2.9-2.9a.629.629,0,0,0-.889.889l3.34,3.34a.629.629,0,0,0,.889,0l7.977-7.977A.629.629,0,0,0,12.389,68.182Z"
                                                        transform="translate(0 -67.997)" fill="#fff"></path>
                                                </svg>
                                                <?php echo html_escape($contentval); ?>
                                            </li>
                                            <?php }?>
                                        </ul>
                                    </div>
                                    <footer class="pricing-footer w-100">
                                        <a class="select d-inline-flex justify-content-center align-items-center"
                                            href="<?php echo base_url($enterprise_shortname.'/subscription-details'); ?>">
                                            <div class="btn-icon d-flex align-items-center justify-content-center me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15.793" height="15.793"
                                                    viewBox="0 0 15.793 15.793">
                                                    <path id="Path_357" data-name="Path 357"
                                                        d="M15.3,1.922,13.87.491a1.679,1.679,0,0,0-2.372,0L.851,11.139a.471.471,0,0,0-.128.243L.008,15.246a.463.463,0,0,0,.539.539l3.864-.716a.471.471,0,0,0,.243-.128L15.3,4.294A1.676,1.676,0,0,0,15.3,1.922ZM1.04,14.753l.433-2.338,1.9,1.9Zm3.287-.792L1.833,11.466l9.106-9.107,2.494,2.494ZM14.647,3.639l-.56.56L11.593,1.705l.56-.56a.752.752,0,0,1,1.063,0l1.431,1.431A.751.751,0,0,1,14.647,3.639Z"
                                                        transform="translate(0 0)" fill="#fff"></path>
                                                </svg>
                                            </div>
                                            Subscribe
                                        </a>
                                    </footer>
                                </li>
                                <?php }}?>
                            </ul>
                        </li>
                        <?php 
                        $enterprise_sub= $this->db->select("*")->from("subscription_tbl")->where("duration",4)->where("status",1)->where("enterprise_id",1)->order_by('id','desc')->limit('1')->get()->row();
                        if($enterprise_sub){
                        if($enterprise_sub->course_sub_content){
                          $course_enterprise_sub=json_decode($enterprise_sub->course_sub_content);
                          }
                        ?>
                        <li class="col-sm-8 col-md-7 col-lg-4 d-flex">
                            <ul class="pricing-wrappers list-unstyled position-relative ">
                                <li class="d-flex flex-wrap h-100 align-content-between">
                                    <header class="pricing-header text-center pt-5 pb-4 w-100">

                                        <!-- <div class="price">
                                            <span class="currency fw-medium">$</span>
                                            <span class="value fw-semi-bold">90</span>
                                            <span class="duration">mo</span>
                                        </div> -->
                                        <div class="price">
                                            <span class="fs-1 fw-bold lh-md2">Enterprise <br> Package</span>
                                        </div>


                                    </header>
                                    <div class="pricing-body w-100">
                                        <ul class="list-unstyled pricing-features px-5 text-start">
                                            <?php foreach($course_enterprise_sub as $enterprise_content){?>
                                            <li>
                                                <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="12.574"
                                                    height="9.234" viewBox="0 0 12.574 9.234">
                                                    <path id="Path_8" data-name="Path 8"
                                                        d="M12.389,68.182a.629.629,0,0,0-.889,0L3.968,75.714l-2.9-2.9a.629.629,0,0,0-.889.889l3.34,3.34a.629.629,0,0,0,.889,0l7.977-7.977A.629.629,0,0,0,12.389,68.182Z"
                                                        transform="translate(0 -67.997)" fill="#fff"></path>
                                                </svg>
                                                <?php echo $enterprise_content;?>
                                            </li>
                                            <?php }?>
                                        </ul>
                                    </div>
                                    <footer class="pricing-footer w-100">
                                        <a class="select d-inline-flex justify-content-center align-items-center"
                                            href="<?php echo base_url($enterprise_shortname . '/contact'); ?>">
                                            <div class="btn-icon d-flex align-items-center justify-content-center me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15.793" height="15.793"
                                                    viewBox="0 0 15.793 15.793">
                                                    <path id="Path_357" data-name="Path 357"
                                                        d="M15.3,1.922,13.87.491a1.679,1.679,0,0,0-2.372,0L.851,11.139a.471.471,0,0,0-.128.243L.008,15.246a.463.463,0,0,0,.539.539l3.864-.716a.471.471,0,0,0,.243-.128L15.3,4.294A1.676,1.676,0,0,0,15.3,1.922ZM1.04,14.753l.433-2.338,1.9,1.9Zm3.287-.792L1.833,11.466l9.106-9.107,2.494,2.494ZM14.647,3.639l-.56.56L11.593,1.705l.56-.56a.752.752,0,0,1,1.063,0l1.431,1.431A.751.751,0,0,1,14.647,3.639Z"
                                                        transform="translate(0 0)" fill="#fff"></path>
                                                </svg>
                                            </div>
                                            Contact Us
                                        </a>
                                    </footer>
                                </li>

                            </ul>
                        </li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center mt-5">
            <?php echo !empty($get_appseeting->subscription_savetitle) ? $get_appseeting->subscription_savetitle : ''; ?>
            <br> <?php echo display('any_question');?>
            ? <a href="<?php echo base_url($enterprise_shortname . '/contact'); ?>">Contact Us</a>
        </div>
    </div>
</div>
<?php 
}
}
 ?>
<!--End Pricing Table-->
<div class="mb-5 overflow-hidden position-relative">
    <div class="container-lg">
        <div class="align-items-center bg-alice-blue mx-0 row p-5 rounded position-relative">
            <div class="col-md-6">
                <h2 class="fs-1 fw-semi-bold mb-4 text-dark-cerulean"><?php echo display('any_questions');?></h2>
                <p class="fs-5">
                    <?php echo !empty($get_appseeting->anyquestion_title) ? $get_appseeting->anyquestion_title : ''; ?>
                </p>
                <a href="<?php echo base_url($enterprise_shortname . '/contact'); ?>"
                    class="btn btn-dark-cerulean btn-lg mt-3"><?php echo display('need_a_consultation')?></a>
            </div>
            <div class="col-md-6 text-center">
                <!-- <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . ''); ?>" class='img-fluid' alt=""> -->
                <img src="<?php echo base_url(html_escape(!empty($get_appseeting->anyquestion_picture) ? "$get_appseeting->anyquestion_picture" : 'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/extra-img/questions.png')); ?>"
                    class="img-fluid" alt="">
            </div>
        </div>
    </div>
</div>




<script>
// var finalEventDt = new Date("2021-11-30 15:37:25").getTime();

// var x = setInterval(function() {

//     var now = new Date().getTime();

//     var delay_total = finalEventDt - now;

//     var days = Math.floor(delay_total / (1000 * 60 * 60 * 24));
//     var hours = Math.floor((delay_total % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//     var minutes = Math.floor((delay_total % (1000 * 60 * 60)) / (1000 * 60));
//     var seconds = Math.floor((delay_total % (1000 * 60)) / 1000);

//     document.getElementById("example").innerHTML = days + "d " + hours + "h " +
//         minutes + "m " + seconds + "s ";

//     if (delay_total < 0) {
//         clearInterval(x);
//         document.getElementById("example").innerHTML = "EXPIRED";
//     }
// }, 1000);
</script>