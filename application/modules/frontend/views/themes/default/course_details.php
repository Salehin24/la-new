<style>
.preview-accordion .accordion-button::after{
    display: none;
}
</style>
<?php
$course_id = $get_coursedetails->course_id;
$session_id = $this->session->userdata('session_id');
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
$name = $this->session->userdata('name');
$fullname = $this->session->userdata('fullname');
$name = (($name) ? "$name" : "$fullname");
$email = $this->session->userdata('email');
$enterprise_id = $enterprise_id;
date_default_timezone_set("Asia/Dhaka");
$pid = '';
if (!empty($check_course_purchase->product_id)) {
    $pid = $check_course_purchase->product_id;
}
//echo $course_id." ". $session_id. " ". $user_type ." ". $user_id ." ".$name. " ". $fullname. " ".$email;die();

$studentCount = $this->db->where('product_id', $get_coursedetails->course_id)->get('invoice_details')->num_rows();
?>
<input type="hidden" id="course_id" name="course_id" value="<?php echo (!empty($course_id) ? $course_id : ''); ?>">
<input type="hidden" id="student_id" name="student_id" value="<?php echo $user_id; ?>">
<!--Start Course Preview Header-->

<div class="hero-header text-white position-relative bg-img hero2"
    data-image-src="<?php echo base_url(!empty($get_coursedetails->cover_thumbnail) ? $get_coursedetails->cover_thumbnail : 'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/header-bg-02.jpg'); ?>">
    <div class="container-lg hero-header_wrap position-relative">
        <!--Start Breadcrumb-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-uppercase">
                <li class="breadcrumb-item"><a
                        href="<?php echo base_url($enterprise_shortname . '/category-course/' . $get_coursedetails->category_id); ?>"
                        class="text-white"><?php echo (!empty($get_coursedetails->category_name) ? $get_coursedetails->category_name : ''); ?></a>
                </li>
                <li class="breadcrumb-item"><a href="javascript:void(0)"
                        class="text-white"><?php echo (!empty($get_coursedetails->name) ? $get_coursedetails->name : ''); ?></a>
                </li>
                <!-- <li class="breadcrumb-item text-white active" aria-current="page">The Art Of Filmmaking And Editing</li> -->
            </ol>
        </nav>
        <!--End Breadcrumb-->
        <!--Start Video Icon With Popup Youtube-->
        <div class="text-center my-3 my-md-5 <?php if(empty($get_coursedetails->url)){ echo 'pt-5';}?>">
            <?php if(!empty($get_coursedetails->url)){?>
            <a class="course-preview__play---icon d-inline-block popup-youtube"
                href="<?php echo (!empty($get_coursedetails->url) ? $get_coursedetails->url : ''); ?>">
                <i data-feather="play-circle" class="course-preview__play---icon d-inline-block"></i>
            </a>
            <?php  }?>
        </div>
        <!--End Video Icon With Popup Youtube-->
        <?php // d($get_coursedetails); ?>
        <div class="row align-items-end">
            <div class="col col-title">
                <h1 class="fw-semi-bold mb-3">
                    <?php echo (!empty($get_coursedetails->name) ? $get_coursedetails->name : ''); ?></h1>
                <div class="row g-4 align-items-center">
                    <div class="col-auto">
                        <div class="avatar d-flex align-items-center">
                            <div class="avatar-img me-3">
                                <?php
                                $faculty_picture = get_picturebyid($get_coursedetails->faculty_id);
                                ?>
                                <img src="<?php echo base_url(!empty($faculty_picture) ? $faculty_picture->picture : default_image()); ?>"
                                    alt="">
                            </div>
                            <div class="avatar-text">
                                <div class="avatar-designation text-white-50 mb-1 fw-bold"><?php echo display('instructor'); ?>
                                </div>
                                <h5 class="h6 avatar-name mb-0">
                                    <a href="<?php echo base_url($enterprise_shortname.'/instructor-profile-show/'. $get_coursedetails->faculty_id); ?>"
                                        class="text-white">
                                        <?php echo (!empty($get_coursedetails->faculty_id) ? (get_userinfo($get_coursedetails->faculty_id)->name) : ''); ?>
                                    </a>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="">
                            <div class="text-white-50 mb-1">Course Level</div>
                            <div class="d-flex align-items-center">
                                <?php
                                if (@$get_coursedetails->course_level == 1) {?>
                                <div class="d-flex align-items-center">
                                    <div class="bar-custom me-2">
                                        <span class="fill"></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <span>beginner </span>
                                </div>
                                <?php } elseif (@$get_coursedetails->course_level == 2) {?>
                                <div class="d-flex align-items-center">
                                    <div class="bar-custom me-2">
                                        <span class="fill"></span>
                                        <span class="fill"></span>
                                        <span></span>
                                    </div>
                                    <span>Intermediate</span>
                                </div>
                                <?php } elseif (@$get_coursedetails->course_level == 3) {?>
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
                    <?php 
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
                    ?>
                    <div class="col-auto">
                        <div class="">
                            <div class="text-white-50 mb-1">Duration</div>
                            <div class="d-flex align-items-center">

                                <svg class="course-hints_icon me-1" id="clock_1_" data-name="clock (1)"
                                    xmlns="http://www.w3.org/2000/svg" width="16.706" height="16.706"
                                    viewBox="0 0 16.706 16.706">
                                    <path id="Path_13" data-name="Path 13"
                                        d="M8.353,0a8.353,8.353,0,1,0,8.353,8.353A8.363,8.363,0,0,0,8.353,0Zm0,15.662a7.309,7.309,0,1,1,7.309-7.309,7.317,7.317,0,0,1-7.309,7.309Z"
                                        fill="#fff" />
                                    <path id="Path_14" data-name="Path 14"
                                        d="M208.838,83.118h-1.044v5.437l3.285,3.285.738-.738-2.979-2.979Z"
                                        transform="translate(-199.963 -79.985)" fill="#fff" />
                                </svg>
                                <span><?php echo $hours . ":" . $minutes . ":" . $seconds; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="">
                            <div class="text-white-50 mb-1">Rating</div>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <?php //echo //avg_rating($course_id,$enterprise_id);?>
                                <?php   average_ratings_number($course_id,$enterprise_id);?>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div>
                            <div class="text-white-50 mb-1">Students</div>
                            <div class="d-flex align-items-center">
                                <i data-feather="user" class="course-hints_icon me-1"></i><span
                                    class=""><?php echo (!empty($studentCount)?$studentCount:'0') ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-auto">
                <div class="align-items-end g-3 justify-content-md-end row mt-3 mt-xl-0">
                    <div class="col-sm-auto">
                        <div class="d-md-flex save-share-wrap">
                            <span id="savecourse<?php echo $get_coursedetails->course_id; ?>" class="text-center">
                                <?php
                            if(!$coursesaved_checked) {
                                if ($user_type == 4) { 
                                    ?>

                                <a href="javascript:void(0)"
                                    onclick="get_coursesave(1, '<?php echo $get_coursedetails->course_id; ?>')"
                                    class="text-center">
                                    <!-- <i data-feather="bookmark" class="bookmark-icon" style="font-size: 30px;"></i> -->
                                    <i class="far fa-bookmark " style="cursor: pointer;font-size: 30px;"></i>
                                    <div>Save</div>
                                </a>
                                <?php } else { 
                                    if($user_type !=5){
                                    ?>
                                <a href="javascript:void(0)" onclick="coursesavecheck()" class="text-center">
                                    <!-- <i data-feather="bookmark" class="bookmark-icon" style="font-size: 30px;"></i> -->
                                    <i class="far fa-bookmark " style="cursor: pointer;font-size: 30px;"></i>
                                    <div>Save</div>
                                </a>
                                <?php
                                    }
                                }
                            } else {
                                ?>
                                <a href="javascript:void(0)"
                                    onclick="get_coursesave(0, '<?php echo $get_coursedetails->course_id; ?>')"
                                    class="text-center">
                                    <i class="bookmark-icon fa-bookmark fas  "
                                        style="cursor: pointer;font-size: 30px;"></i>
                                    <!-- <i data-feather="bookmark" class="bookmark-icon" style="font-size: 30px;" style="fill: #07477D"></i> -->
                                    <div>Save</div>
                                </a>
                                <?php } ?>

                            </span>
                            <a href="https://www.facebook.com/sharer.php?u=<?php echo base_url($enterprise_shortname . '/course-details/' .$get_coursedetails->course_id); ?>"
                                target="_blank" title="Facebook Share" class="text-center ms-md-3"
                                data-bs-toggle="modal" data-bs-target="#shareModal">
                                <i data-feather="share-2" class="share-icon"></i>
                                <div>Share</div>
                            </a>
                        </div>
                    </div>
                    <input type="hidden" name="course_id"
                        id="course_id_<?php echo html_escape($get_coursedetails->course_id); ?>"
                        value="<?php echo html_escape($get_coursedetails->course_id); ?>">
                    <input type="hidden" name="course_name"
                        id="course_name_<?php echo html_escape($get_coursedetails->course_id); ?>"
                        value="<?php echo html_escape($get_coursedetails->name); ?>">
                    <input type="hidden" name="slug" id="slug_<?php echo html_escape($get_coursedetails->course_id); ?>"
                        value="<?php echo html_escape($get_coursedetails->slug); ?>">
                    <input type="hidden" name="qty" id="qty" value="1">
                    <input type="hidden" name="price"
                        id="price_<?php echo html_escape($get_coursedetails->course_id); ?>"
                        value="<?php if($get_coursedetails->is_offer == 1){ echo $get_coursedetails->offer_courseprice; }else{ echo $get_coursedetails->price; } ?>">
                    <input type="hidden" name="old_price"
                        id="old_price_<?php echo html_escape($get_coursedetails->course_id); ?>"
                        value="<?php echo html_escape($get_coursedetails->oldprice); ?>">
                    <input type="hidden" name="picture"
                        id="picture_<?php echo html_escape($get_coursedetails->course_id); ?>"
                        value="<?php echo html_escape($get_coursedetails->picture); ?>">
                    <input type="hidden" name="is_course_type" id="iscourse_type" value="0">
                    <?php
                    if($user_type==5){?>
                    <div class="col-6 col-sm-auto text-center">
                        <div
                            class="price-area d-xl-flex align-items-xl-center justify-content-xl-center text-center text-xl-start">
                            <div class="purchase-price fs-2">
                                <div class="main-price align-items-center d-flex">
                                    <span class="currency fs-5 fw-semi-bold mt-0">BDT </span>
                                    <span class="fw-bold  ms-1">
                                        <?php echo (($get_coursedetails->is_offer == 1) ? number_format($get_coursedetails->offer_courseprice) :number_format($get_coursedetails->price)); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="product-price ms-2">
                            <?php if(!empty($get_coursedetails->is_discount==1)){?>
                                <del class="prev-price">
                                    <span class="hidden position-absolute overflow-hidden">Previous
                                        price</span><?php echo (!empty($get_coursedetails->oldprice) ? number_format($get_coursedetails->oldprice) : ''); ?></del>
                                <?php }?>
                                <!-- <div class="legal text-danger">Save $100</div> -->
                            </div>
                        </div>
                        <!-- <button type="button" 
                            class="btn btn-light btn-lg fw-medium text-navy-blue w-100"></button> -->
                        <!-- <small class="d-block mt-1">get lifetime access of this course </small> -->
                    </div>

                    <?php 
                    }else{
                    if ($pid != $course_id) {
                    $course_types = json_decode($get_coursedetails->course_type);
                    if (in_array("1", $course_types)) {
                    ?>
                    <div class="col-6 col-sm-auto text-center">
                        <div
                            class="price-area d-xl-flex align-items-xl-center justify-content-xl-center text-center text-xl-start">
                            <div class="purchase-price fs-2">
                                <div class="main-price align-items-center d-flex">
                                    <span class="currency fs-5 fw-semi-bold mt-0">BDT </span>
                                    <span class="fw-bold ms-1">
                                        <?php echo (($get_coursedetails->is_offer == 1) ? number_format($get_coursedetails->offer_courseprice) : number_format($get_coursedetails->price)); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="product-price ms-2">
                
                            <?php if(!empty($get_coursedetails->is_discount==1)){?>
                                <del class="prev-price"><span class="hidden position-absolute overflow-hidden">Previous
                                        price</span><?php //echo (!empty($get_coursedetails->oldprice) ? '৳': ''); ?><?php echo (!empty($get_coursedetails->oldprice) ? number_format($get_coursedetails->oldprice) : ''); ?></del>
                                <!-- <div class="legal text-danger">Save $100</div> -->
                                <?php }?>
                            </div>
                        </div>
                        <button type="button" onclick="addtocart('<?php echo html_escape($course_id); ?>')"
                            class="btn btn-light btn-lg fw-medium text-navy-blue w-100">Purchase</button>
                        <!-- <small class="d-block mt-1">get lifetime access of this course </small> -->
                    </div>
                    <?php
                    }
                    if (in_array("2", $course_types)) {
                        $subscription_course_count = 0;
                        $subscription_data=$this->db->select('*')
                                                ->from('subscription_tbl a')
                                                ->join('subscription_course_tbl b', 'b.subscription_id = a.subscription_id')
                                                ->where('course_id',$course_id)
                                                ->get()
                                                ->row(); 
                        //if($subscription_data){              
                        //$subscription_course_count = $this->db->where('subscription_id',$subscription_data->subscription_id)->get('subscription_course_tbl')->num_rows();
                                               
                        ?>
                    <div class="col-6 col-sm-auto text-center">
                        <div
                            class="price-area d-xl-flex align-items-xl-center justify-content-xl-center text-center text-xl-start">
                            <div class="purchase-price fs-2">
                                <div class="main-price">
                                    <span class="currency fs-5 fw-bold mt-0">

                                    </span>
                                    <span class="fw-bold">
                                        <?php //echo (!empty($subscription_data->price) ? $subscription_data->price : '');?>
                                    </span>
                                </div>
                            </div>
                            <div class="product-price ms-2">
                                <!-- <del class="prev-price">
                                    <span class="hidden position-absolute overflow-hidden">Previous
                                        price</span>৳1,299</del> -->
                                <!-- <div class="legal text-danger">Save $100</div> -->
                            </div>
                        </div>
                        <a href="<?php echo base_url($enterprise_shortname.'/subscription-details'); ?>"
                            class="btn btn-light btn-lg fw-medium text-navy-blue w-100">
                            Subscribe</a>
                        <!-- <small class="d-block mt-1 text-danger"> Total : -->
                        <!-- <b><?php echo $subscription_course_count; ?></b> course</small> -->
                        <?php //}else{?>
                        <script>
                        // $('document').ready(function(){
                        //     toastrErrorMsg("This Course is not added in subscription package");
                        // });
                        </script>
                        <?php //}?>
                    </div>
                    <?php }if (in_array("3", $course_types)) { ?>
                    <input type="hidden" id="course_type" value="3">
                    <div class="col-6 col-sm-auto text-center">
                        <div class="price-area">
                            <div class="product-price ms-2">
                                <del class="prev-price">
                                    <span class="hidden position-absolute overflow-hidden"></span></del>
                            </div>
                        </div>
                        <a href="javascript:void(0)"
                            onclick="addtomycourse('<?php echo html_escape($get_coursedetails->course_id); ?>')"
                            class="btn btn-light btn-lg fw-medium text-navy-blue w-100">Enroll Free</a>
                        <small class="d-block mt-1 text-danger"> </small>

                    </div>
                    <?php } if (in_array("4", $course_types)) {?>
                    <input type="hidden" id="course_type" value="5">
                    <div class="col-6 col-sm-auto text-center">
                        <div class="price-area">
                            <div class="product-price ms-2">
                                <del class="prev-price">
                                    <span class="hidden position-absolute overflow-hidden"></del>
                            </div>
                        </div>
                        <a href="javascript:void(0)"
                            onclick="addtomycourse('<?php echo html_escape($get_coursedetails->course_id); ?>')"
                            class="btn btn-light btn-lg fw-medium text-navy-blue w-100">Enrol Gov Course</a>
                        <small class="d-block mt-1 text-danger"></small>

                    </div>
                    <?php } }else{ ?>
                    <div class="col-6 col-sm-auto text-center">
                        <h5 class="font-weight-bold mb-3 text-warning"><?php echo display('already_purchased'); ?></h5>
                    </div>
                    <?php } }?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Course Preview Header-->
<!-- Navigation-->
<!-- navbar_top  -->
<div class="bg-dark-cerulean sticky-nav" id="secNavbar">
    <div class="container-lg">
        <ul class="nav" id="navbarResponsive">
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger active" href="#overview">Overview</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#preRequisites">Pre-requisites</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#learnings">Outcome</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#lessons">Lessons</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#instructor">Instructor</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#reviews">Reviews</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#studentWork">Student Work</a>
            </li>
            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#faq">F.A.Q</a>
            </li>
            <li class="nav-item ms-auto">
                <?php if(!empty($get_coursedetails->syllabus)){?>
                <a class="nav-link"
                    href="<?php echo (!empty($get_coursedetails->syllabus) ? base_url($get_coursedetails->syllabus) : 'javascript:void(0)') ?>"
                    <?php echo (!empty($get_coursedetails->syllabus) ? 'download' : ''); ?>>
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-download">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    Syllabus
                </a>
                <?php } ?>
            </li>
        </ul>
    </div>
</div>
<div class="bg-alice-blue pt-5">
    <div class="container-lg">
        <div class="row">
            <div class="col-md-8 sticky-content">
                <!--Start card-->
                <div class="card border-0 rounded-0 shadow-sm mb-3 page-section" id="overview">
                    <div class="card-body p-4 p-xl-5">
                        <!--Start Section Header-->
                        <div class="section-header mb-4">
                            <h4 class="h5">About this Course</h4>
                            <div class="section-header_divider"></div>
                        </div>
                        <!--End Section Header-->
                        <p>
                            <?php //echo htmlspecialchars_decode(word_limiter(!empty($get_coursedetails->description) ? $get_coursedetails->description : ''),100); 
                            
                            $limited_word = word_limiter(!empty($get_coursedetails->description) ? $get_coursedetails->description : '',70);
                             echo htmlspecialchars_decode(!empty($limited_word) ? $limited_word : '');
                            ?>
                        </p>
                    </div>
                </div>
                <!--End card-->
                <!--Start Card-->
                <div class="card border-0 rounded-0 shadow-sm mb-3 page-section" id="preRequisites">
                    <div class="card-body p-4 p-xl-5">
                        <!--Start Section Header-->
                        <div class="section-header mb-4">
                            <h4 class="h5"><?php echo display('pre_requisites'); ?></h4>
                            <div class="section-header_divider"></div>
                        </div>
                        <!--End Section Header-->
                        <div class="row">
                            <?php
                            $get_requirements = json_decode($get_coursedetails->requirements);
                            if($get_requirements[0]){
                            foreach ($get_requirements as $requirement) {
                                ?>
                            <div class="col-sm-6 col-md-6">
                                <p class="benifit-checked"><i class="fas fa-check"> </i>
                                    <?php echo (!empty($requirement) ? $requirement : ''); ?></p>
                            </div>
                            <?php
                             }
                             } ?>
                        </div>
                    </div>
                </div>
                
                <!--End card-->
                <!--Start card-->
                <div class="card border-0 rounded-0 shadow-sm mb-3 page-section" id="learnings">
                    <div class="card-body p-4 p-xl-5">
                        <!--Start Section Header-->
                        <div class="section-header mb-4">
                            <h4 class="h5"><?php echo display('what_will_i_learn'); ?></h4>
                            <div class="section-header_divider"></div>
                        </div>
                        <!--End Section Header-->
                        <div class="row">
                            <?php
                            $get_benifits = json_decode($get_coursedetails->benifits);
                            foreach ($get_benifits as $benifit) {
                                ?>
                            <div class="col-sm-6 col-md-6">
                                <p class="benifit-checked"><i class="fas fa-check"> </i>
                                    <?php echo (!empty($benifit) ? $benifit : ''); ?></p>
                            </div>
                            <?php }
                            ?>
                        </div>
                    </div>
                </div>
                <!--End card-->
                <!--Start card-->
                <div class="card border-0 rounded-0 shadow-sm mb-3 page-section" id="lessons">
                    <div class="card-body p-4 p-xl-5">
                        <!--Start Section Header-->
                        <div class="section-header mb-4">
                            <h4 class="h5"><?php echo display('topics_for_this_course'); ?>
                                <span class="h5 float-end">
                                    <?php                   
                             echo $get_totalcoursetime->totallesson." Lessons,  ";           
                           $dayseconds= $get_totalcoursetime->coursetime;
                                    function secondsToWords($dayseconds) {
                                        /*** number of days ***/
                                        $days = (int)($dayseconds / 86400);
                                        /*** if more than one day ***/
                                        $plural = $days > 1 ? 'days' : 'day';
                                        /*** number of hours ***/
                                        $hours = (int)(($dayseconds - ($days * 86400)) / 3600);
                                        /*** number of mins ***/
                                        $mins = (int)(($dayseconds - $days * 86400 - $hours * 3600) / 60);
                                        /*** number of seconds ***/
                                        $secs = (int)($dayseconds - ($days * 86400) - ($hours * 3600) - ($mins * 60));
                                        /*** return the string ***/
                                        echo  sprintf("%d hr %d min", $hours,$mins);
                                    }
                                    if(!empty($dayseconds)){
                                     secondsToWords($dayseconds);
                                    }else{
                                       echo  "0 hr 0 min 0 s";
                                    }
                                    ?>
                                    <span>
                            </h4>
                            <div class="section-header_divider"></div>
                        </div>
                        <!--End Section Header-->
                        <div class="accordion course-content_accordion topics-accordion" id="CourseContent">
                            <?php
                            $sl = 0;
                            $get_sections = get_sections($course_id, $enterprise_id);
                            
                            foreach ($get_sections as $section) {
                                $course_section_wise_lesson = $this->Course_model->course_section_wise_lesson($course_id, $section->section_id, $enterprise_id);
                                $lecturecount = count($course_section_wise_lesson);
                                $seconds = 0;
                                $lesson_order=0;
                                foreach ($course_section_wise_lesson as $singletime) {
                                    list($hour, $minute, $second) = explode(':', html_escape($singletime->duration));
                                    $seconds += $hour * 3600;
                                    $seconds += $minute * 60;
                                    $seconds += $second;
                                }
                                $hours = floor($seconds / 3600);
                                $seconds -= $hours * 3600;
                                $minutes = floor($seconds / 60);
                                $seconds -= $minutes * 60;
                                $sl++;
                                ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="PanelHeadingOne">
                                    <button
                                        class="accordion-button <?php if($sl=='1'){echo "" ;}else{ echo "collapsed";}?>"
                                        type="button" data-bs-toggle="collapse"
                                        data-bs-target="#section_<?php echo $sl; ?>"
                                        aria-expanded="<?php if($sl==1){echo 'true';}else{ echo "false";}?>"
                                        aria-controls="section_<?php echo $sl; ?>">
                                        <span><?php echo html_escape($section->section_name); ?></span> <span
                                            class="lesson-time ms-auto"><span><?php echo $lecturecount; ?>
                                                <?php echo display('lectures'); ?></span>&nbsp;•&nbsp;<span>
                                                <?php echo $hours . ":" . $minutes . ":" . $seconds; ?></span></span>
                                    </button>
                                </h2>
                                <div id="section_<?php echo $sl; ?>" class="accordion-collapse collapse <?php
                                    if ($sl == 1) {
                                        echo 'show';
                                    }
                                    ?>" aria-labelledby="PanelHeadingOne">
                                    <div class="accordion-body accordion-body py-3 px-4 px-md-0 px-lg-4">
                                        <div class="accordion course-content_accordion--sub"
                                            id="accordionPanelsStayOpenExample">
                                            <?php foreach ($course_section_wise_lesson as $lesson) { ?>
                                            <div class="accordion-item border-0">
                                                <div class="d-flex mb-3 mb-md-2 mb-lg-3">
                                                    <span> <?php echo ++$lesson_order?>.&nbsp;</span>
                                                    <?php if ($lesson->lesson_type == 1) { ?>
                                                    <div class="flex-shrink-1 me-3 me-md-2 me-lg-3">
                                                        <i data-feather="play-circle" class="accordion-icon"></i>
                                                    </div>
                                                    <?php } else { ?>
                                                    <div class="flex-shrink-1 me-3 me-md-2 me-lg-3">
                                                        <i data-feather="file-text" class="accordion-icon"></i>
                                                    </div>
                                                    <?php } ?>
                                                    <div class="w-100">
                                                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                                            <button
                                                                class="accordion-button fs-13 text-muted fw-normal pt-1 pb-0 px-0 collapsed"
                                                                type="button">
                                                                <?php if ($lesson->lesson_type == 1 && $lesson->is_preview == 1) { ?>
                                                                <a href="javascript:void(0)"
                                                                    onclick="showCoursePreview('<?php echo $course_id; ?>', '<?php echo $lesson->lesson_id; ?>')"><?php echo html_escape($lesson->lesson_name); ?></a>
                                                                <?php } else { ?>
                                                                <a
                                                                    href="javascript:void(0)"><?php echo html_escape($lesson->lesson_name); ?></a>
                                                                <?php } ?>
                                                                <?php if ($lesson->lesson_type == 1) { ?>
                                                                    
                                                                <span class="course-duration ms-auto">
                                                                    <?php if($lesson->is_preview == 1){ ?> 
                                                                        <a href="javascript:void(0)" onclick="showCoursePreview('<?php echo $course_id; ?>', '<?php echo $lesson->lesson_id; ?>')">
                                                                        <u> Preview </u> &nbsp;
                                                                        </a>
                                                                    <?php } ?>
                                                                    <?php echo html_escape($lesson->duration); ?>
                                                                </span>
                                                                <?php } ?>
                                                            </button>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>

                        </div>
                        <!--Start Course Preview Modal -->
                        <div class="course-preview__modal modal" id="coursePreviewModal" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body text-white p-4" id="courseinfo">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Course Preview Modal -->
                    </div>
                </div>
                <!--End card-->
                <div class="card border-0 rounded-0 shadow-sm mb-3 page-section">
                    <div class="card-body p-4 p-xl-5">
                        <!-- <div class="container-lg"> -->
                            <!-- <div class="card border-0 shadow-sm rounded-0"> -->
                                    <div class="section-header mb-4">
                                        <h4 class="h5">Course Contents</h4>
                                        <div class="section-header_divider"></div>
                                    </div>
                                    <div class="row">
                                        <div class="mt-2 d-flex col-md-6">
                                            <label for="" class="mb-2 mb-md-0 "><i data-feather="clipboard" class="fs-2 m-1"></i><?php $count_down=$this->db->select("*")->from("course_resource_tbl")->where('course_id',$get_coursedetails->course_id)->where('lesson_id',null)->get()->num_rows();  echo ($count_down?$count_down:'0');?> Course resource files</label>
                                        </div>
                                        <div class="mt-2 d-flex col-md-6">
                                            <label for="" class=" mb-2 mb-md-0 "><i data-feather="package" class="fs-2 m-1"></i><?php $lessoncount_down=$this->db->select("*")->from("course_resource_tbl")->where('course_id',$get_coursedetails->course_id)->where('lesson_id !=',null)->get()->num_rows();  echo ($lessoncount_down?$lessoncount_down:'0');?> Lesson resource files</label>
                                        </div>
                                        <div class="mt-2 d-flex col-md-6">
                                            <label for="" class=" mb-2 mb-md-0 "><i data-feather="briefcase" class="fs-2 m-1"></i><?php $total_quiz=$this->db->select("*")->from("assign_courseexam_tbl")->where('course_id',$get_coursedetails->course_id)->get()->num_rows();  echo ($total_quiz?$total_quiz:'0');?> Quizs</label>
                                        </div>
                                        <div class="mt-2 d-flex col-md-6">
                                            <label for="" class="mb-2 mb-md-0 "><i data-feather="film" class="fs-2 m-1"></i> <?php $totalassignment=$this->db->where('course_id',$course_id)->get('project_assingment')->num_rows(); echo ($totalassignment?$totalassignment:'0');?> Projects</label>
                                        </div>
                                    </div>
                            <!-- </div> -->
                        <!-- </div> -->
                    </div>
                </div>


                <!--Start card-->
                <div class="card border-0 rounded-0 shadow-sm mb-3" id="instructor">
                    <div class="card-body p-4 p-xl-5">
                        <!--Start Section Header-->
                        <div class="section-header mb-4">
                            <h4 class="h5"><?php echo display('meet_your_instructor'); ?></h4>
                            <div class="section-header_divider"></div>
                        </div>
                        <!--End Section Header-->
                        <div class="avatar d-flex mb-3">
                            <div class="avatar-img me-3">
                                <img src="<?php echo base_url(!empty($faculty_picture) ? $faculty_picture->picture : default_image()); ?>"
                                    alt="">
                            </div>
                            <div class="avatar-text">
                                <h5 class="instructor-name mb-1 fs-6">
                                    <a
                                        href="<?php echo base_url($enterprise_shortname.'/instructor-profile-show/'.$get_coursedetails->faculty_id); ?>"><?php echo (!empty($get_coursedetails->faculty_id) ? get_userinfo($get_coursedetails->faculty_id)->name : ''); ?>
                                    </a>
                                </h5>
                                <p class="instructor-designation">
                                    <?php  echo (!empty($get_coursedetails->designation) ?$get_coursedetails->designation : ''); ?><br>
                                </p>
                                <ul class="list-unstyled">
                                    <li class="mb-1"><i class="fas fa-star text-warning me-1"></i>
                                        <?php echo (!empty($instructor_rating)?number_format($instructor_rating,2):'0'); ?>
                                        Instructor
                                        Rating
                                    </li>
                                    <li class="mb-1"><i class="fas fa-award text-warning me-1"></i>
                                        <?php echo $this->db->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl') ?>
                                        Reviews</li>
                                    <li class="mb-1"><i class="fas fa-user-graduate text-warning me-1"></i>
                                        <?php echo (!empty($total_student)?$total_student:'0'); ?>
                                        Students</li>
                                    <li class="mb-1"><i
                                            class="fas fa-book-open text-warning me-1"></i><?php echo (!empty($get_coursedetails->course_count)?$get_coursedetails->course_count:'0'); ?>
                                        <?php echo display('courses'); ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="">
                            <?php  
                             $biography = word_limiter(!empty($get_coursedetails->biography) ?$get_coursedetails->biography:'',70);
                             echo htmlspecialchars_decode(!empty($biography) ? $biography : '');
                            //echo (!empty($get_coursedetails->biography) ?$get_coursedetails->biography : ''); ?>
                        </div>
                        <?php if($check_followinginstructor){?>
                        <button class="btn btn-danger btn-sm text-white"
                            onclick="studentUnfollowInstructor('<?php echo $check_followinginstructor->id; ?>')">Unfollow</button>
                        <?php }else{ ?>
                        <button class="btn btn-warning btn-sm text-white"
                            onclick="studentFollowInstructor('<?php echo $get_coursedetails->faculty_id; ?>')">Follow
                            This Instructor</button>
                        <?php } ?>
                    </div>
                </div>
                <!--End card-->
            </div>
            <div class="col-md-4 ps-xl-5 sticky-content">
                <div class="sidebar-block bg-img text-white mb-3 p-4"
                    data-image-src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/sidebar-bg-01.jpg'); ?>">
                    <!--Start Section Header-->
                    <div class="section-header mb-4">
                        <h4 class="h5">Language</h4>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            <!-- <div
                                class="sidebar-round-progress bg-seagull d-flex justify-content-center align-items-center fs-5 fw-semi-bold">
                                32%</div> -->
                        </div>
                        <?php if(!empty($get_coursedetails)){?>
                        <div class="flex-grow-1 ms-3 text-left">
                            <a
                                class="text-white"><?php echo strtoupper((!empty($get_coursedetails->language)?$get_coursedetails->language:'')) ;?></a>
                        </div>
                        <?php }?>
                    </div>
                    <!-- <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="sidebar-round-progress bg-moody-blue d-flex justify-content-center align-items-center fs-5 fw-semi-bold">
                                28%</div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            got a tangible career benefit from this course
                        </div>
                    </div> -->
                </div>

                <!-- <div class="sidebar-block bg-img text-white mb-3 p-4"
                    data-image-src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/sidebar-bg-01.jpg'); ?>">
                    <div class="section-header mb-4">
                        <h4 class="h5">Who this course is for?</h4>
                        <div class="section-header_divider"></div>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0"></div>
                        <?php if(!empty($get_coursedetails->course_isfor)){?>
                        <div class="flex-grow-1 ms-3 text-left">
                            <a
                                class="text-white"><?php echo strtoupper((!empty($get_coursedetails->course_isfor)?$get_coursedetails->course_isfor:'')) ;?></a>
                        </div>
                        <?php }?>
                    </div>
                </div> -->

                <div class="sidebar-block bg-img text-white mb-3 p-4"
                    data-image-src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/sidebar-bg-01.jpg'); ?>">
                    <!--Start Section Header-->
                    <div class="section-header mb-4">
                        <h4 class="h5">Learner Career Outcomes</h4>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <?php 
                        $career_outcomes = json_decode($get_coursedetails->career_outcomes);
                        if($career_outcomes[0]){
                    ?>
                    <ul class="mb-0 ps-4">
                        <?php
                            foreach ($career_outcomes as $outcome) {
                                ?>
                        <li class="mb-1">
                            <!-- <a href="https:<?php echo $outcome; ?>" class="text-white" target="_new"> -->
                            <span class="text-white"><?php echo $outcome; ?></span>
                          <!-- </a> -->
                        </li>
                        <?php
                            }
                        ?>
                        <?php //echo (!empty($get_coursedetails->related_resource)?$get_coursedetails->related_resource:'') ;?>
                    </ul>
                    <?php } ?>
                    <!-- <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            <div
                                class="sidebar-round-progress bg-seagull d-flex justify-content-center align-items-center fs-5 fw-semi-bold">
                                32%</div>
                        </div>
                        <?php //if(!empty($get_coursedetails)){?>
                        <div class="flex-grow-1 ms-3">
                            <p><?php //echo (!empty($get_coursedetails->career_outcomes)?$get_coursedetails->career_outcomes:'') ;?>
                            </p>
                        </div>
                        <?php //}?>
                    </div> -->
                    <!-- <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div
                                class="sidebar-round-progress bg-moody-blue d-flex justify-content-center align-items-center fs-5 fw-semi-bold">
                                28%</div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            got a tangible career benefit from this course
                        </div>
                    </div> -->
                </div>
                <div class="sidebar-block bg-midnight-express text-white mb-3 p-4">
                    <!--Start Section Header-->
                    <div class="section-header mb-4">
                        <h4 class="h5">Skills you will gain</h4>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <!--Start Tags-->
                    <div class="tags">
                        <?php
                        $skillsgain = json_decode($get_coursedetails->skillsgain);
                       
                        if ($skillsgain[0]) {
                            $bgcolor_classes = ['bg-navy-blue', 'bg-navy-blue', 'bg-endeavour', 'bg-resolution-blue', 'bg-dark-cerulean', 'bg-prussian-blue', 'bg-electric-indigo'];
                        //    echo $bgcolor_classes[rand(0,6)];die();
                            foreach ($skillsgain as $skill) {
                                ?>
                        <!-- <a href="#" class="tag-link text-white text-decoration-none d-inline-block mb-1 px-3 py-2 <?php // echo $bgcolor_classes[rand(0, 6)]; ?>"> -->
                            
                            <span  class="tag-link text-white text-decoration-none d-inline-block mb-1 px-3 py-2 <?php echo $bgcolor_classes[rand(0, 6)]; ?>" ><?php echo $skill; ?></span>
                        <!-- </a> -->
                        <?php
                           }
                         }
                        ?>
                        <?php //echo (!empty($get_coursedetails->course_result)?$get_coursedetails->course_result:'') ;?>
                    </div>
                    <!--End Tags-->
                </div>
                <div class="sidebar-block bg-img text-white mb-3 p-4"
                    data-image-src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/sidebar-bg-02.jpg'); ?>">
                    <!--Start Section Header-->
                    <div class="section-header mb-4">
                        <h4 class="h5">Related Resources</h4>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <?php 
                        $related_resources = json_decode($get_coursedetails->related_resource);
                        if($related_resources[0]){
                    ?>
                    <ul class="mb-0 ps-4">
                        <?php
                            foreach ($related_resources as $related) {
                                ?>
                        <li class="mb-1">
                            <a href="<?php echo $related; ?>" class="text-white"
                                target="_new"><?php echo $related; ?></a>
                        </li>
                        <?php
                            }
                        ?>
                        <?php //echo (!empty($get_coursedetails->related_resource)?$get_coursedetails->related_resource:'') ;?>
                    </ul>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</div>



<!--Start Feedback-->
<div class="bg-alice-blue py-4">
    <div class="container-lg">
        <div class="card border-0 shadow-sm rounded-0" id="reviews">
            <div class="card-body p-4">
                <!--Start Section Header-->
                <div class="section-header mb-4">
                    <h4 class="h5">Student Feedback</h4>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
                <div class="row">
                    <div class="col-md-4 col-lg-4 text-center">
                        <div class="d-inline-block px-5 py-4 rating-block rounded-3 shadow text-center">
                            <div class="rating-point mb-3 text-center">
                                <h3 class="display-1 fw-light mb-0 fw-semi-bold">
                                    <?php   average_ratings_number($course_id,$enterprise_id);?></h3>
                                <div class="text-warning">
                                    <?php  echo avg_rating($course_id,$enterprise_id);?>
                                </div>
                            </div>
                            <div>
                                <?php //echo $this->db->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl') ?>
                                Course Ratings</div>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-8">
                        <table class="table table-borderless mb-0 white-space-nowrap">
                            <?php 
                              $five =IndivisualRating($course_id,$enterprise_id,5);
                              $four =IndivisualRating($course_id,$enterprise_id,4);
                              $three=IndivisualRating($course_id,$enterprise_id,3);
                              $two  =IndivisualRating($course_id,$enterprise_id,2);
                              $one  =IndivisualRating($course_id,$enterprise_id,1);
                             $total=$this->db->select('SUM(rating) AS total_ratings')->from('rating_tbl')->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->get()->row();
                              
                             $fivecount=$this->db->where('rating',5)->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl');
                             $fourcount=$this->db->where('rating',4)->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl');
                             $threecount=$this->db->where('rating',3)->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl');
                             $twocount=$this->db->where('rating',2)->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl');
                             $onecount=$this->db->where('rating',1)->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl');
                             $totalRating=$this->db->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl');
                             
                              $avg_count=$fivecount+$fourcount+$threecount+$twocount+$onecount;
                            //  echo  $avg_count/5;
                             ?>
                            <tbody>
                                <tr>
                                    <td width="70%" class="align-middle">
                                        <div class="rating-percent">
                                            <div class="progress">
                                                <div class="progress-bar bg-warning progress-bar-striped"
                                                    role="progressbar"
                                                    style="width: <?php  echo (($fivecount?$fivecount:0)*100)/($totalRating?$totalRating:1);//if(!empty($total->total_ratings)){echo round($five*100/$total->total_ratings);}?>%"
                                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td width="10%" class="align-middle">
                                        <div class="rating-quantity">
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star text-warning fs-4"></i>
                                        </div>
                                    </td>
                                    <td width="20%" class="align-middle">
                                        <div class="user-rating text-muted">
                                            <?php echo number_format((($fivecount?$fivecount:0)*100)/($totalRating?$totalRating:1),2);//if(!empty($total->total_ratings)){  echo round($five*100/$total->total_ratings);}?>%
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="70%" class="align-middle">
                                        <div class="rating-percent">
                                            <div class="progress">
                                                <div class="progress-bar bg-warning progress-bar-striped"
                                                    role="progressbar"
                                                    style="width: <?php  echo number_format((($fourcount?$fourcount:0)*100)/($totalRating?$totalRating:1),2);//if(!empty($total->total_ratings)){ echo round($four*100/$total->total_ratings);}?>%"
                                                    aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td width="10%" class="align-middle">
                                        <div class="rating-quantity">
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star fs-4" style="color:#ffe6ad;"></i>
                                        </div>
                                    </td>
                                    <td width="20%" class="align-middle">
                                        <div class="user-rating text-muted">
                                            <?php echo number_format((($fourcount?$fourcount:0)*100)/($totalRating?$totalRating:1),2);//if(!empty($total->total_ratings)){ echo round($four*100/$total->total_ratings);}?>%
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="70%" class="align-middle">
                                        <div class="rating-percent">
                                            <div class="progress">
                                                <div class="progress-bar bg-warning progress-bar-striped"
                                                    role="progressbar"
                                                    style="width: <?php echo number_format((($threecount?$threecount:0)*100)/($totalRating?$totalRating:1),2);//if(!empty($total->total_ratings)){ echo round($three*100/$total->total_ratings);}?>%"
                                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td width="10%" class="align-middle">
                                        <div class="rating-quantity">
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star fs-4" style="color:#ffe6ad;"></i>
                                            <i class="fas fa-star fs-4" style="color:#ffe6ad;"></i>
                                        </div>
                                    </td>
                                    <td width="20%" class="align-middle">
                                        <div class="user-rating text-muted">
                                            <?php echo number_format((($threecount?$threecount:0)*100)/($totalRating?$totalRating:1),2);//if(!empty($total->total_ratings)){ echo round($three*100/$total->total_ratings);}?>%
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="70%" class="align-middle">
                                        <div class="rating-percent">
                                            <div class="progress">
                                                <div class="progress-bar bg-warning progress-bar-striped"
                                                    role="progressbar"
                                                    style="width: <?php echo number_format((($twocount?$twocount:0)*100)/($totalRating?$totalRating:1),2);//if(!empty($total->total_ratings)){echo round($two*100/$total->total_ratings);}?>%"
                                                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td width="10%" class="align-middle">
                                        <div class="rating-quantity">
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star text-warning fs-4"></i>
                                            <i class="fas fa-star fs-4 " style="color:#ffe6ad;"></i>
                                            <i class="fas fa-star fs-4 " style="color:#ffe6ad;"></i>
                                            <i class="fas fa-star fs-4 " style="color:#ffe6ad;"></i>
                                        </div>
                                    </td>
                                    <td width="20%" class="align-middle">
                                        <div class="user-rating text-muted">
                                            <?php echo number_format((($twocount?$twocount:0)*100)/($totalRating?$totalRating:1),2); //if(!empty($total->total_ratings)){ echo round($two*100/$total->total_ratings);}?>%
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="70%" class="align-middle">
                                        <div class="rating-percent">
                                            <div class="progress">
                                                <div class="progress-bar bg-warning progress-bar-striped"
                                                    role="progressbar"
                                                    style="width: <?php echo number_format((($onecount?$onecount:0)*100)/($totalRating?$totalRating:1),2);//if(!empty($total->total_ratings)){echo  round($one*100/$total->total_ratings);}?>%"
                                                    aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td width="10%" class="align-middle">
                                        <div class="rating-quantity">
                                            <i class="fas fa-star text-warning fs-4" style="color:#ffe6ad;"></i>
                                            <i class="fas fa-star fs-4" style="color:#ffe6ad;"></i>
                                            <i class="fas fa-star fs-4" style="color:#ffe6ad;"></i>
                                            <i class="fas fa-star fs-4" style="color:#ffe6ad;"></i>
                                            <i class="fas fa-star fs-4" style="color:#ffe6ad;"></i>
                                        </div>
                                    </td>
                                    <td width="20%" class="align-middle">
                                        <div class="user-rating text-muted">
                                            <?php echo number_format((($onecount?$onecount:0)*100)/($totalRating?$totalRating:1),2);//if(!empty($total->total_ratings)){ echo  round($one*100/$total->total_ratings);}?>%
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php 
           // rating_review
            foreach ($rating_review as $review) {
            ?>
            <div class="card-footer bg-white p-4">
                <div class="row">
                    <div class="col-12 col-sm-auto">
                        <div class="avatar d-flex align-items-center">
                            <div class="avatar-img me-3">
                                <img src="<?php echo base_url(html_escape(($review->picture) ? "$review->picture" : 'application/modules/frontend/views/themes/'.html_escape(get_activethemes()->name).'/assets/img/default.png')); ?>"
                                    alt="">
                            </div>
                            <div class="avatar-text">
                                <h5 class="avatar-name mb-1">
                                    <?php echo (!empty($review->name) ? $review->name : ''); ?>
                                </h5>
                                <div class="avatar-designation text-muted">

                                    <?php
                                  
                                  $last_activatiy=strtotime($review->review_date) ;
                                    $current_time=strtotime(date('Y-m-d H:i:s'));
                                    $time_diff=$current_time-$last_activatiy;
                                    $sec     =  $time_diff;
                                    $min     = round($time_diff / 60 );
                                    $hrs     = round($time_diff  / 3600);
                                    $days    = round($time_diff / 86400 );
                                    $weeks   = round( $time_diff / 604800);
                                    $mnths   = round( $time_diff / 2600640 );
                                    $yrs     = round( $time_diff / 31207680 );
                                      
                                    

                                    if($sec <= 60) {
                                   echo "$sec seconds ago";
                                    }else if($min <= 60) {
                                    if($min==1) {
                                    echo "one minute ago";
                                    }
                                    else {
                                    echo "$min minutes ago";
                                    }
                                    }
                                    // Check for hours
                                    else if($hrs <= 24) {
                                    if($hrs == 1) {
                                    echo "an hour ago";
                                    }
                                    else {
                                    echo "$hrs hours ago";
                                    }
                                    }
                                    // Check for days
                                    else if($days <= 7) {
                                    if($days == 1) {
                                    echo "Yesterday";
                                    }
                                    else {
                                    echo "$days days ago";
                                    }
                                    }
                                    // Check for weeks
                                    else if($weeks <= 4.3) {
                                    if($weeks == 1) {
                                    echo "a week ago";
                                    }
                                    else {
                                    echo "$weeks weeks ago";
                                    }
                                    }
                                    // Check for months
                                    else if($mnths <= 12) {
                                    if($mnths == 1) {
                                    echo "a month ago";
                                    }
                                    else {
                                    echo "$mnths months ago";
                                    }
                                    }
                                    // Check for years
                                    else {
                                    if($yrs == 1) {
                                    echo "one year ago";
                                    }
                                    else {
                                    echo "$yrs years ago";
                                    }
                                    }
                                    ?>

                                </div>
                                <div><?php if($review->rating==1){?>
                                    <i class="fas fa-star text-warning"></i>
                                    <?php }elseif($review->rating==2){ ?>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <?php }elseif($review->rating==3){ ?>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <?php }elseif($review->rating==4){ ?>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <?php }else{ ?>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <i class="fas fa-star text-warning"></i>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mt-3 mt-sm-0">
                        <p><?php echo (!empty($review->comments) ? $review->comments : ''); ?></p>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>









    </div>
</div>
<!--End Feedback-->
<!--Start Student Work-->
<div class="bg-alice-blue py-4" id="studentWork">
    <?php 
        $project=$this->db->select('*')->from('project_tbl a')->where('a.enterprise_id', $enterprise_id)->where('project_type',1)->where('project_status',1)->where('a.course_id',$course_id)->where('type',1)->order_by('a.id',"desc")->limit('4')->get()->result_array();
         if(!empty($project)){
        ?>
    <div class="container-lg">
        <!--Start Section Header-->
        <div class="section-header mb-4">
            <h4>Student Work</h4>
            <div class="section-header_divider"></div>
            <!-- <button type="button" class="btn btn-outline-dark-cerulean text-uppercase rounded-0 mt-2">UPLOAD TO
                GALLERY</button> -->
        </div>

        <!--End Section Header-->
        <div class="row  g-4" id="project_load_more">
            <!-- <div  id="project_load_more"> -->
            <input type="hidden" id="course_id" value="<?php echo $course_id;?>">
            <?php 
                foreach($project as $project_list){
            ?>
            <div class="col-sm-6 col-md-4 col-lg-3">
                <!--Start Gallery Card-->
                <a href="<?php echo base_url($enterprise_shortname . '/project-view/' . $project_list['project_id']); ?>"
                    class="gallery-card bg-white d-block text-dark text-decoration-none">
                    <figure class="gallery-card_img zoom-in-hover mb-0">
                        <img src="<?php echo base_url(!empty($project_list['coverpic']) ? $project_list['coverpic'] : default_600_400()); ?>"
                            class="img-fluid" alt="">
                    </figure>
                    <div class="gallery-card_body py-3 px-3">
                        <div class="d-flex justify-content-between">
                            <span><?php echo html_escape($project_list['title']);?></span>
                            <span class="">
                                <i class="fas fa-thumbs-up me-1"></i>
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="17.107" height="15.113"
                                    viewBox="0 0 17.107 15.113">
                                    <path id="Path_504" data-name="Path 504"
                                        d="M15.859,31.321a4.309,4.309,0,0,0-6.88.5,6.559,6.559,0,0,0-.426.69,6.553,6.553,0,0,0-.426-.69,4.309,4.309,0,0,0-6.88-.5A5.185,5.185,0,0,0,0,34.765a6.35,6.35,0,0,0,1.749,4.167,38.937,38.937,0,0,0,4.377,4.09c.662.564,1.347,1.148,2.075,1.785l.022.019a.5.5,0,0,0,.66,0l.022-.019c.729-.638,1.413-1.221,2.076-1.785a38.931,38.931,0,0,0,4.377-4.09,6.35,6.35,0,0,0,1.749-4.167A5.185,5.185,0,0,0,15.859,31.321ZM10.331,42.258c-.571.486-1.158.987-1.777,1.525-.619-.538-1.207-1.039-1.777-1.525C3.3,39.3,1,37.338,1,34.765a4.185,4.185,0,0,1,1-2.781,3.346,3.346,0,0,1,2.544-1.145A3.379,3.379,0,0,1,7.31,32.4a5.942,5.942,0,0,1,.767,1.526.5.5,0,0,0,.953,0A5.943,5.943,0,0,1,9.8,32.4a3.308,3.308,0,0,1,5.31-.412,4.185,4.185,0,0,1,1,2.781C16.1,37.338,13.808,39.3,10.331,42.258Z"
                                        transform="translate(0 -29.836)" fill="#5f5f5f" />
                                </svg> -->
                                <?php echo get_projectlikecount($project_list['project_id'], $enterprise_id); ?> likes
                            </span>
                        </div>
                        <span class="mt-1 d-block">
                            <i class="far fa-comment me-1"></i>
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
                            </svg> -->
                            <?php echo get_projectcommentcount($project_list['project_id'], $enterprise_id); ?> comments
                        </span>
                    </div>
                </a>
                <!--End Gallery Card-->
            </div>
            <?php }?>
            <!-- </div> -->
        </div>
        <div
            class="text-center mt-5 firstbutton removebuton_<?php echo (!empty($project_list['id']) ? $project_list['id'] : '');?>">
            <div id="home_course_load<?php echo (!empty($project_list['id']) ? $project_list['id'] : '');?>">
                <button type="button"
                    onClick="project_loadmore_data(<?php echo (!empty($project_list['id']) ? $project_list['id'] : '');?>);"
                    class="btn btn-lg btn-dark-cerulean home_course_load"
                    id="<?php echo (!empty($project_list['id']) ? $project_list['id'] : '');?>">
                    Browse more
                    <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="28.56" height="15.666"
                        viewBox="0 0 28.56 15.666">
                        <path id="right-arrow_3_" data-name="right-arrow (3)"
                            d="M20.727,107.5l-1.272,1.272,5.661,5.661H0v1.8H25.116l-5.661,5.661,1.272,1.272,7.833-7.833Z"
                            transform="translate(0 -107.5)" fill="#fff"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <?php }?>
</div>
<!--End Student Work-->

<!--Start F.A.Q-->
<div class="bg-alice-blue py-4" id="faq">
    <?php if ($get_faqs) { ?>
    <div class="container-lg">
        <!--Start Section Header-->
        <div class="section-header mb-4">
            <h4><?php echo display('frequently_asked_questions'); ?></h4>
            <div class="section-header_divider"></div>
        </div>
        <!--End Section Header-->
        <div class="row">
            <!--<div class="col-sm-12 col-md-12">-->
            <div class="accordion faq-accordion" id="faqAccordion1">
                <div class="row">
                    <?php
                        $sl = 0;
                        foreach ($get_faqs as $faq) {
                            $question=json_decode($faq->question);
                            $answer=json_decode($faq->answer);
                            //  print_r($answer);
                            $s=0;
                            foreach($question as $qus){ 
                                $sl++;
                            ?>
                    <div class="col-md-6">
                        <div class="accordion-item border-0 shadow-sm mb-2">
                            <h2 class="accordion-header" id="headingOne">
                                <button
                                    class="accordion-button fw-medium <?php if($sl=='1'){echo "" ;}else{ echo "collapsed";}?>"
                                    type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_<?php echo $sl; ?>"
                                    aria-expanded="<?php if($sl==1){echo 'true';}else{ echo "false";}?>"
                                    aria-controls="collapseOne">
                                    <strong>
                                        <?php echo (!empty( $qus) ?  $qus : ''); ?>
                                    </strong>
                                </button>
                            </h2>
                            <div id="collapse_<?php echo $sl; ?>"
                                class="accordion-collapse collapse <?php echo (($sl == '1') ? 'show' : ''); ?>"
                                aria-labelledby="headingOne" data-bs-parent="#faqAccordion1">
                                <div class="accordion-body">
                                    <?php echo (!empty($answer[$s]) ? $answer[$s] : ''); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        $s++;
                    }
                }
            ?>
                </div>
            </div>
            <!--</div>-->
            <!--            <div class="col-sm-6 col-md-6">
                            <div class="accordion faq-accordion" id="faqAccordion2">
                                <div class="accordion-item border-0 shadow-sm mb-2">
                                    <h2 class="accordion-header" id="headingFive">
                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                            he generated Lorem Ipsum is therefore always?
                                        </button>
                                    </h2>
                                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                                         data-bs-parent="#faqAccordion2">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by default, until
                                            the collapse plugin adds the appropriate classes that we use to style each element.
                                            These classes control the overall appearance, as well as the showing and hiding via CSS
                                            transitions. You can modify any of this with custom CSS or overriding our default
                                            variables. It's also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0 shadow-sm mb-2">
                                    <h2 class="accordion-header" id="headingSix">
                                        <button class="accordion-button fw-medium" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                            The standard chunk of Lorem Ipsum used since?
                                        </button>
                                    </h2>
                                    <div id="collapseSix" class="accordion-collapse collapse show" aria-labelledby="headingSix"
                                         data-bs-parent="#faqAccordion2">
                                        <div class="accordion-body">
                                            <strong>This is the second item's accordion body.</strong> It is hidden by default,
                                            until the collapse plugin adds the appropriate classes that we use to style each
                                            element. These classes control the overall appearance, as well as the showing and hiding
                                            via CSS transitions. You can modify any of this with custom CSS or overriding our
                                            default variables. It's also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0 shadow-sm mb-2">
                                    <h2 class="accordion-header" id="headingSeven">
                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                            Lorem Ipsum is therefore always free from repetition?
                                        </button>
                                    </h2>
                                    <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                                         data-bs-parent="#faqAccordion2">
                                        <div class="accordion-body">
                                            <strong>This is the third item's accordion body.</strong> It is hidden by default, until
                                            the collapse plugin adds the appropriate classes that we use to style each element.
                                            These classes control the overall appearance, as well as the showing and hiding via CSS
                                            transitions. You can modify any of this with custom CSS or overriding our default
                                            variables. It's also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0 shadow-sm mb-2">
                                    <h2 class="accordion-header" id="headingEight">
                                        <button class="accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                            Various versions have evolved over the years?
                                        </button>
                                    </h2>
                                    <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight"
                                         data-bs-parent="#faqAccordion2">
                                        <div class="accordion-body">
                                            <strong>This is the third item's accordion body.</strong> It is hidden by default, until
                                            the collapse plugin adds the appropriate classes that we use to style each element.
                                            These classes control the overall appearance, as well as the showing and hiding via CSS
                                            transitions. You can modify any of this with custom CSS or overriding our default
                                            variables. It's also worth noting that just about any HTML can go within the
                                            <code>.accordion-body</code>, though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
        </div>
    </div>
    <?php } ?>
</div>
<!--End F.A.Q-->




<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <?php if ($get_facultycourse) { ?>
        <div class="border-0 rounded-0  ">
            <div class="d-md-flex align-items-center justify-content-between mb-4">
                <!--Start Section Header-->
                <div class="section-header mb-4 mb-md-0">
                    <h4>More Courses by
                        <?php echo (!empty($get_coursedetails->faculty_id) ? (get_userinfo($get_coursedetails->faculty_id)->name) : ''); ?>
                    </h4>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
            </div>
            <div class="row ">
                <div class="viewe-carousel owl-carousel owl-theme ">
                    <?php
                   foreach ($get_facultycourse as $facultycourse) {
                ?>
                    <!--Start Course Card-->
                    <div
                        class="course-card course-card-shadow rounded-6 bg-white position-relative overflow-hidden hideClass">
                        <div class="position-relative overflow-hidden bg-prussian-blue">
                            <!-- <div class="position-relative"> -->
                            <!--Start Course Image-->
                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $facultycourse->course_id); ?>"
                                class="course-card_img">
                                <img src="<?php echo base_url(!empty($facultycourse->picture) ? $facultycourse->picture : default_600_400()); ?>"
                                    class="img-fluid w-100" alt="">
                            </a>
                            <!--End Course Image-->
                            <!--Start items badge-->
                            <div
                                class="align-items-center top-0 d-flex fs-12 position-absolute px-3 py-2 start-0 text-white w-100 z-index-2">
                                <?php 
                                    if($facultycourse->tagstatus==4){?>
                                <span class="badge-new  me-1">Most Popular</span>
                                <?php   
                                    }elseif($facultycourse->tagstatus==3){?>
                                <span class="badge-new  me-1">New</span>
                                <?php }elseif($facultycourse->tagstatus==1){?>
                                <span class="badge-new  me-1">Recomended</span>

                                <?php }elseif($facultycourse->tagstatus==2){?>
                                <span class="badge-new  me-1">Best Seller</span>
                                <?php  }?>
                                <span
                                    class="badge-business"><?php echo html_escape($facultycourse->category_name);?></span>
                                <span id="savecourse<?php echo $facultycourse->course_id; ?>" class="ms-auto">
                                    <?php
                                    $coursesaved_checked = $this->Frontend_model->coursesaved_checked($user_id,$facultycourse->course_id);
                                    if (!$coursesaved_checked){
                                        if ($user_type == 4) {?>
                                    <img onclick="get_coursesaveloop(1, '<?php echo $facultycourse->course_id; ?>')"
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
                                    <img onclick="get_coursesaveloop(0, '<?php echo $facultycourse->course_id; ?>')"
                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-2.png'); ?>"
                                        class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                    <?php } ?>
                                </span>
                            </div>
                            <?php if(!empty($facultycourse->is_discount==1)){ ?>
                            <span
                                class="px-0 badge m-3   position-absolute start-0 text-white   z-index-2 polygon-shape"
                                style="top:25px">
                                <span class="d-block fs-13 mb-1">Off</span>
                                <span
                                    class="fs-15 fw-bold"><?php  echo (($facultycourse->discount) ? $facultycourse->discount :''); ?><?php if($facultycourse->discount_type==2){ echo "%";}else{ echo " ";}?></span>
                            </span>
                            <?php }?>
                            <!--End items badge-->
                            <!-- </div> -->
                            <!--Start Course Card Body-->
                            <div class="bg-prussian-blue course-card_body course_middle px-3 py-2 text-white py-12">
                                <!--Start Course Title-->
                                <h3 class="course-card__course--title  mb-0 text-capitalize">
                                    <a href="<?php echo base_url($enterprise_shortname. '/course-details/'. $facultycourse->course_id); ?>"
                                        class="text-decoration-none text-white"><?php echo (!empty($facultycourse->name) ? $facultycourse->name : ''); ?></a>
                                </h3>
                                <!--End Course Title-->
                                <div class="course-card__instructor d-flex align-items-center">
                                    <div class="card__instructor--name my-2">
                                        <a class="text-capitalize instructor-name"
                                            href="<?php echo base_url($enterprise_shortname.'/instructor-profile-show/'.$facultycourse->faculty_id); ?>"><?php echo (!empty($facultycourse->instructor_name) ? $facultycourse->instructor_name : ''); ?></a>
                                    </div>
                                </div>
                                <!--Start Course Hints-->
                                <table class="course-card__hints table table-borderless table-sm text-white mb-0">
                                    <tbody>
                                        <tr>
                                            <td width="80" class="ps-0">
                                                <div class="d-flex align-items-center">
                                                    <div class="course-card__hints--icon me-3">
                                                        <?php
                                                                if (@$facultycourse->course_level == 1) {?>
                                                        <div class="d-flex align-items-center">
                                                            <div class="bar-custom me-2">
                                                                <span class="fill"></span>
                                                                <span></span>
                                                                <span></span>
                                                            </div>
                                                        </div>
                                                        <?php } elseif (@$facultycourse->course_level == 2) {?>
                                                        <div class="d-flex align-items-center">
                                                            <div class="bar-custom me-2">
                                                                <span class="fill"></span>
                                                                <span class="fill"></span>
                                                                <span></span>
                                                            </div>
                                                        </div>
                                                        <?php } elseif (@$facultycourse->course_level == 3) {?>
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
                                                            if($facultycourse->course_level == 1){
                                                                
                                                                echo "Beginner  Level";
                                                            }elseif($facultycourse->course_level == 2){
                                                                echo "Intermediate Level";
                                                            }elseif($facultycourse->course_level == 3){
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
                                                            width="17.26" height="14.926" viewBox="0 0 17.26 14.926">
                                                            <path id="Path_148" data-name="Path 148"
                                                                d="M16.065,17.081H1.2a1.2,1.2,0,0,0-1.2,1.2V28.364a1.2,1.2,0,0,0,1.2,1.2h8.67l-.262,1.6a.69.69,0,0,0,1.041.75l1.871-.985a.393.393,0,0,1,.248,0l1.871.985a.834.834,0,0,0,.388.1.656.656,0,0,0,.387-.123.726.726,0,0,0,.266-.728l-.262-1.6h.651a1.2,1.2,0,0,0,1.2-1.2V18.277A1.2,1.2,0,0,0,16.065,17.081ZM12.64,27.511a2.084,2.084,0,1,1,2.084-2.084A2.086,2.086,0,0,1,12.64,27.511Zm.6,2.5a1.383,1.383,0,0,0-1.2,0l-1.323.7.42-2.565a3.1,3.1,0,0,0,3.007,0l.164,1v.005l.256,1.56Zm2.994-1.651a.173.173,0,0,1-.171.171h-.819l-.187-1.142s0-.009,0-.013a3.108,3.108,0,1,0-4.831,0l0,.013-.187,1.142H1.2a.173.173,0,0,1-.171-.171V18.277a.173.173,0,0,1,.171-.171H16.065a.173.173,0,0,1,.171.171Z"
                                                                transform="translate(0 -17.081)" fill="#B5C5DB" />
                                                            <path id="Path_149" data-name="Path 149"
                                                                d="M43.246,60.243H31.631a.512.512,0,0,0,0,1.025H43.246a.512.512,0,0,0,0-1.025Z"
                                                                transform="translate(-28.993 -57.295)" fill="#B5C5DB" />
                                                            <path id="Path_150" data-name="Path 150"
                                                                d="M36.55,100.911H31.631a.512.512,0,0,0,0,1.025H36.55a.512.512,0,0,0,0-1.025Z"
                                                                transform="translate(-28.993 -95.184)" fill="#B5C5DB" />
                                                        </svg>
                                                    </div>
                                                    <div class="course-card__hints--text fs-12 fw-bold text-white">
                                                        <?php if($facultycourse->enterprise_name=='Admin'){ echo "Lead Academy";}else{ echo $facultycourse->enterprise_name." "."Academy";}?>

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
                                            <svg id="clock_1_" data-name="clock (1)" xmlns="http://www.w3.org/2000/svg"
                                                width="16.706" height="16.706" viewBox="0 0 16.706 16.706">
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
                                                $course_wise_lesson = $this->Course_model->course_wise_lesson( $facultycourse->course_id);
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
                                        <i class="fas fa-graduation-cap fs-15 me-1 " style="color:#B5C5DB"></i>
                                        <div class="d-block">
                                            <div class="reviews fs-12 fw-bold text-white"><?php 
                                            $studentCount = $this->db->where('product_id', $facultycourse->course_id)->get('invoice_details')->num_rows();
                                                //echo  html_escape($studentCount?$studentCount:0)
                                                echo number_format($studentCount?$studentCount:0); 
                                            ?></div>
                                        </div>
                                    </div>

                                    <!--Start Star Rating-->
                                    <div class="star-rating__wrap d-flex align-items-center ">
                                        <i class="fas fa-star me-1 text-warning" style="color:#B5C5DB"></i>
                                        <div class="d-block">
                                            <div class="reviews fs-12 fw-bold text-white">
                                                <?php echo average_ratings_number($facultycourse->course_id,$enterprise_id);?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Course Card Body-->

                            <!--Start Course Card Hover Content-->
                            <div class="course-card__hover--content">
                                <img src="<?php echo base_url(!empty($facultycourse->hover_thumbnail) ? $facultycourse->hover_thumbnail :default_600_400()); ?>"
                                    class="course-card__hover--content___img">
                                <!--Start Video Icon With Popup Youtube-->
                                <?php if($facultycourse->url){ ?>

                                <a class="course-card__hover--content___icon popup-youtube"
                                    href="<?php echo (!empty($facultycourse->url)? $facultycourse->url : ''); ?>"
                                    autoplay>
                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/Playicon.png'); ?>"
                                        class="img-fluid" alt="">
                                </a>
                                <?php } ?>
                                <!--End Video Icon With Popup Youtube-->

                                <h3
                                    class="bottom-0 course-card__hover--content___text d-block fs-15 mb-0 position-absolute text-capitalize text-decoration-none text-white">
                                    <a href="<?php echo base_url($enterprise_shortname. '/course-details/'. $facultycourse->course_id); ?>"
                                        class="text-decoration-none text-white"><?php echo (!empty($facultycourse->name) ? $facultycourse->name : ''); ?></a>
                                </h3>
                            </div>
                            <!--End Card Hover Content-->
                        </div>
                        <?php 
                        $course_types = json_decode($facultycourse->course_type);
                        $checked_purchase = $this->db->where('customer_id',$user_id)->where('product_id', $facultycourse->course_id)->where('status',1)->get('invoice_details')->row();
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
                                        <input class="me-1" style="width:21px;height:21px" type="radio" name="" id=""
                                        onclick="" disabled>
                                        <label class="align-items-center d-flex form-check-label fw-bold justify-content-between" style="width:100%;"
                                                for="flexRadioDefault2_<?php echo $facultycourse->course_id?>">
                                                <span class="course_price_cart">Course Price
                                                    <span class="text-success">
                                                    </span>
                                                </span>
                                                <span class="align-items-center d-flex  rounded text-center">
                                                    <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                        <?php echo (($facultycourse->is_offer == 1) ? number_format($facultycourse->offer_courseprice) : number_format($facultycourse->price)); ?></span>
                                                    <?php if(!empty($facultycourse->is_discount==1)){?>
                                                    <del
                                                        class="fs-12 fw-bold text-muted2"><?php echo (($facultycourse->oldprice)?number_format($facultycourse->oldprice) :" "); ?></del>
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
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $facultycourse->course_id); ?>"
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
                                <input type="hidden" class="course" value="<?php echo $facultycourse->course_id;?>"
                                    id="<?php echo $facultycourse->course_id;?>">
                                <div class="align-items-center d-flex form-check ps-0">
                                    <!-- <input class="form-check-input" type="radio" name="flexRadioDefault1_<?php echo $facultycourse->course_id?>" id="flexRadioDefault1_<?php echo $facultycourse->course_id?>"  onclick="subscriptionchecedRadio('<?php echo $facultycourse->course_id;?>')" > -->
                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                        name="flexRadioDefault1_<?php echo $facultycourse->course_id?>"
                                        id="flexRadioDefault1_<?php echo $facultycourse->course_id?>"
                                        onclick="subscriptionchecedRadio('<?php echo $facultycourse->course_id;?>')">
                                    <label class="form-check-label fw-bold course_price_cart "
                                        for="flexRadioDefault1_<?php echo $facultycourse->course_id?>">
                                        Subscription
                                    </label>
                                </div>
                                <div class="form-check d-flex align-items-center ps-0">
                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                        name="flexRadioDefault2_<?php echo $facultycourse->course_id?>"
                                        id="flexRadioDefault2_<?php echo $facultycourse->course_id?>"
                                        onclick="coursechecedRadio('<?php echo $facultycourse->course_id;?>')" checked>
                                    <label
                                        class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                        style="width:100%;"
                                        for="flexRadioDefault2_<?php echo $facultycourse->course_id?>">
                                        <span class="course_price_cart">Course Price
                                            <span class="text-success">
                                            </span>
                                        </span>
                                        <span class="align-items-center d-flex  rounded text-center">
                                            <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                <?php echo (($facultycourse->is_offer == 1) ? number_format($facultycourse->offer_courseprice) : number_format($facultycourse->price)); ?></span>
                                            <?php if(!empty($facultycourse->is_discount==1)){?>
                                            <del
                                                class="fs-12 fw-bold text-muted2"><?php echo (($facultycourse->oldprice)?number_format($facultycourse->oldprice) :" "); ?></del>
                                            <?php }?>

                                        </span>
                                    </label>
                                </div>
                                <div class="d-flex justify-content-between align-items-stretch mt-2"
                                    id="course_purchase_<?php echo $facultycourse->course_id?>">
                                    <div class="flex-grow-1 me-2 w-sub">
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $facultycourse->course_id); ?>"
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
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $facultycourse->course_id); ?>"
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
                                    id="course_subscription_<?php echo $facultycourse->course_id?>">
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
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $facultycourse->course_id); ?>"
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
                                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $facultycourse->course_id); ?>" class="btn btn-dark-cerulean w-100">
                                                <i data-feather="info" class="me-1"></i>
                                                Details
                                            </a>
                                        </div>
                                    </div> -->
                                <?php }elseif(in_array("1", $course_types)){?>
                                <div class="align-items-center d-flex form-check ps-0">
                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                        name="flexRadioDefault1_<?php echo $facultycourse->course_id?>"
                                        id="flexRadioDefault1_<?php echo $facultycourse->course_id?>"
                                        onclick="subscriptionchecedRadio('<?php echo $facultycourse->course_id;?>')"
                                        disabled>
                                    <label class="form-check-label fw-bold opa-half course_price_cart"
                                        for="flexRadioDefault1">
                                        Subscription
                                    </label>
                                </div>
                                <div class="form-check d-flex align-items-center ps-0">
                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                        name="flexRadioDefault2_<?php echo $facultycourse->course_id?>"
                                        id="flexRadioDefault2_<?php echo $facultycourse->course_id?>"
                                        onclick="coursechecedRadio('<?php echo $facultycourse->course_id;?>')" checked>
                                    <label
                                        class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                        style="width:100%"
                                        for="flexRadioDefault2_<?php echo $facultycourse->course_id?>">
                                        <span class="course_price_cart">Course Price <span class="text-success"></span>
                                        </span>
                                        <span class="align-items-center d-flex  rounded text-center">
                                            <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                <?php echo (($facultycourse->is_offer == 1) ? number_format($facultycourse->offer_courseprice) : number_format($facultycourse->price)); ?></span>
                                            <?php if(!empty($facultycourse->is_discount==1)){?>
                                            <del
                                                class="fs-12 fw-bold text-muted2"><?php echo (($facultycourse->oldprice)?number_format($facultycourse->oldprice) :" "); ?></del>
                                            <?php }?>
                                        </span>

                                    </label>
                                </div>
                                <div class="d-flex justify-content-between align-items-stretch mt-2">
                                    <div class="flex-grow-1 me-2 w-sub">
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $facultycourse->course_id); ?>"
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
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $facultycourse->course_id); ?>"
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
                                        name="flexRadioDefault1_<?php echo $facultycourse->course_id?>"
                                        id="flexRadioDefault1_<?php echo $facultycourse->course_id?>"
                                        onclick="subscriptionchecedRadio('<?php echo $facultycourse->course_id;?>')"
                                        checked>
                                    <label class="form-check-label fw-bold course_price_cart"
                                        for="flexRadioDefault1_<?php echo $facultycourse->course_id?>">
                                        Subscription
                                    </label>
                                </div>
                                <div class="form-check d-flex align-items-center ps-0 ">
                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                        name="flexRadioDefault2_<?php echo $facultycourse->course_id?>"
                                        id="flexRadioDefault2_<?php echo $facultycourse->course_id?>"
                                        onclick="coursechecedRadio('<?php echo $facultycourse->course_id;?>')" disabled>
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
                                            <span class="text-center w-100 fw-bold fs-13"> Subscription
                                            </span>
                                        </a>
                                    </div>
                                    <div class="flex-grow-1">
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $facultycourse->course_id); ?>"
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
                                        name="flexRadioDefault1_<?php echo $facultycourse->course_id?>"
                                        id="flexRadioDefault1_<?php echo $facultycourse->course_id?>"
                                        onclick="subscriptionchecedRadio('<?php echo $facultycourse->course_id;?>')"
                                        disabled>
                                    <label class="form-check-label fw-bold opa-half course_price_cart"
                                        for="flexRadioDefault1">
                                        Subscription
                                    </label>
                                </div>
                                <div class="align-items-center d-flex form-check ps-0">
                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                        name="flexRadioDefault2_<?php echo $facultycourse->course_id?>"
                                        id="flexRadioDefault2_<?php echo $facultycourse->course_id?>"
                                        onclick="coursechecedRadio('<?php echo $facultycourse->course_id;?>')" disabled>
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
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $facultycourse->course_id); ?>"
                                            class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                            <span class="shopping me-1 shopping_icon position-relative">
                                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                    style="width: 14px;">
                                            </span>
                                            <span class="text-center w-100 fw-bold fs-13"> Enroll Free </span>
                                        </a>
                                    </div>
                                    <div class="flex-grow-1">
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $facultycourse->course_id); ?>"
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
                                        name="flexRadioDefault1_<?php echo $facultycourse->course_id?>"
                                        id="flexRadioDefault1_<?php echo $facultycourse->course_id?>"
                                        onclick="subscriptionchecedRadio('<?php echo $facultycourse->course_id;?>')"
                                        disabled>
                                    <label class="form-check-label fw-bold opa-half course_price_cart"
                                        for="flexRadioDefault1">
                                        Subscription
                                    </label>
                                </div>
                                <div class="align-items-center d-flex form-check ps-0">
                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                        name="flexRadioDefault2_<?php echo $facultycourse->course_id?>"
                                        id="flexRadioDefault2_<?php echo $facultycourse->course_id?>"
                                        onclick="coursechecedRadio('<?php echo $facultycourse->course_id;?>')" disabled>
                                    <label
                                        class="align-items-center d-flex form-check-label fw-bold justify-content-between opa-half"
                                        for="flexRadioDefault2_<?php echo $facultycourse->course_id?>">
                                        <span class="course_price_cart">Course Price</span>
                                        <span class="bg-danger d-flex px-2 rounded text-center text-white">
                                            <!-- Govt -->
                                        </span>
                                    </label>
                                    <span class="badge bg-success me-1 float-end ms-auto"> Govt</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-stretch mt-2">
                                    <div class="flex-grow-1 me-2 w-sub">
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $facultycourse->course_id); ?>"
                                            class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                            <span class="shopping me-1 shopping_icon position-relative">
                                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                    style="width: 14px;">
                                            </span>
                                            <span class="text-center w-100 fw-bold fs-13"> Govt </span>
                                        </a>
                                    </div>
                                    <div class="flex-grow-1">
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $facultycourse->course_id); ?>"
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
                    </div>
                    <!--End Course Card-->
                    <?php }?>
                </div>
            </div>

        </div>
        <?php } ?>
    </div>
</div>



<!--End Instructor Course-->

<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <?php  
        $related_courses = json_decode($get_coursedetails->related_courseid);
        if ($related_courses) { ?>
        <div class="border-0 rounded-0">

            <div class="d-md-flex align-items-center justify-content-between mb-4">
                <!--Start Section Header-->
                <div class="section-header mb-4 mb-md-0">
                    <h4>Related Courses</h4>
                    <div class="section-header_divider"></div>
                </div>
                <!--End Section Header-->
            </div>
            <div class="row">
                <div class="viewe-carousel owl-carousel owl-theme">
                    <!--Start Course Card-->
                    <?php
                        foreach ($related_courses as $related) {
                            $course_info= $this->db->select("a.tagstatus,a.id,a.hover_thumbnail,a.is_new,a.course_id, a.faculty_id,a.discount_type,a.is_discount,a.discount, a.name, a.price, a.oldprice, a.summary, a.slug,a.course_level, a.url,a.course_type,a.offer_courseprice,a.is_offer,a.is_discount,a.discount, a.is_free, a.is_livecourse, a.enterprise_id,b.picture,c.category_id, c.name as category_name, d.name instructor_name,e.name enterprise_name")
                                                    ->from("course_tbl a")
                                                    ->join('picture_tbl b', 'b.from_id = a.course_id', 'left')
                                                    ->join('category_tbl c', 'c.category_id = a.category_id', 'left')
                                                    ->join('faculty_tbl d', 'd.faculty_id = a.faculty_id', 'left')
                                                    ->join('loginfo_tbl e', 'e.log_id = a.enterprise_id', 'left')
                                                    ->where('a.course_id', $related)
                                                    ->where('a.enterprise_id',$enterprise_id)
                                                    ->get()->row();
                        ?>
                    <div
                        class="course-card course-card-shadow rounded-6 bg-white position-relative overflow-hidden related_hideClass">
                        <div class="position-relative overflow-hidden bg-prussian-blue">
                            <!-- <div class="position-relative"> -->
                            <!--Start Course Image-->
                            <a href="<?php echo base_url($enterprise_shortname . '/course-details/' . $course_info->course_id); ?>"
                                class="course-card_img">
                                <img src="<?php echo base_url(!empty($course_info->picture) ? $course_info->picture : default_600_400()); ?>"
                                    class="img-fluid w-100" alt="">
                            </a>
                            <!--End Course Image-->
                            <!--Start items badge-->
                            <div
                                class="align-items-center top-0 d-flex fs-12 position-absolute px-3 py-2 start-0 text-white w-100 z-index-2">
                                <?php 
                                    if($course_info->tagstatus==4){?>
                                <span class="badge-new  me-1">Most Popular</span>
                                <?php   
                                    }elseif($course_info->tagstatus==3){?>
                                <span class="badge-new  me-1">New</span>
                                <?php }elseif($course_info->tagstatus==1){?>
                                <span class="badge-new  me-1">Recomended</span>

                                <?php }elseif($course_info->tagstatus==2){?>
                                <span class="badge-new  me-1">Best Seller</span>
                                <?php  }?>
                                <span
                                    class="badge-business"><?php echo html_escape($course_info->category_name);?></span>
                                <span id="savecourse<?php echo $course_info->course_id; ?>" class="ms-auto">
                                    <?php
                                    $coursesaved_checked = $this->Frontend_model->coursesaved_checked($user_id,$course_info->course_id);
                                    if (!$coursesaved_checked){
                                        if ($user_type == 4) {?>
                                    <img onclick="get_coursesaveloop(1, '<?php echo $course_info->course_id; ?>')"
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
                                    <img onclick="get_coursesaveloop(0, '<?php echo $course_info->course_id; ?>')"
                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-2.png'); ?>"
                                        class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                    <?php } ?>
                                </span>
                            </div>
                            <?php if(!empty($course_info->is_discount==1)){ ?>
                            <span
                                class="px-0 badge m-3   position-absolute start-0 text-white   z-index-2 polygon-shape"
                                style="top:25px">
                                <span class="d-block fs-13 mb-1">Off</span>
                                <span
                                    class="fs-15 fw-bold"><?php  echo (($course_info->discount) ? $course_info->discount :''); ?><?php if($course_info->discount_type==2){ echo "%";}else{ echo " ";}?></span>
                            </span>
                            <?php }?>
                            <!--End items badge-->
                            <!-- </div> -->
                            <!--Start Course Card Body-->
                            <div class="bg-prussian-blue course-card_body course_middle px-3 py-2 text-white py-12">
                                <!--Start Course Title-->
                                <h3 class="course-card__course--title  mb-0 text-capitalize">
                                    <a href="<?php echo base_url($enterprise_shortname. '/course-details/'. $course_info->course_id); ?>"
                                        class="text-decoration-none text-white"><?php echo (!empty($course_info->name) ? $course_info->name : ''); ?></a>
                                </h3>
                                <!--End Course Title-->
                                <div class="course-card__instructor d-flex align-items-center">
                                    <div class="card__instructor--name my-2">
                                        <a class="text-capitalize instructor-name"
                                            href="<?php echo base_url($enterprise_shortname.'/instructor-profile-show/'.$course_info->faculty_id); ?>"><?php echo (!empty($course_info->instructor_name) ? $course_info->instructor_name : ''); ?></a>
                                    </div>
                                </div>
                                <!--Start Course Hints-->
                                <table class="course-card__hints table table-borderless table-sm text-white mb-0">
                                    <tbody>
                                        <tr>
                                            <td width="80" class="ps-0">
                                                <div class="d-flex align-items-center">
                                                    <div class="course-card__hints--icon me-3">
                                                        <?php
                                                                if (@$course_info->course_level == 1) {?>
                                                        <div class="d-flex align-items-center">
                                                            <div class="bar-custom me-2">
                                                                <span class="fill"></span>
                                                                <span></span>
                                                                <span></span>
                                                            </div>
                                                        </div>
                                                        <?php } elseif (@$course_info->course_level == 2) {?>
                                                        <div class="d-flex align-items-center">
                                                            <div class="bar-custom me-2">
                                                                <span class="fill"></span>
                                                                <span class="fill"></span>
                                                                <span></span>
                                                            </div>
                                                        </div>
                                                        <?php } elseif (@$course_info->course_level == 3) {?>
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
                                                            if($course_info->course_level == 1){
                                                                
                                                                echo "beginner  Level";
                                                            }elseif($course_info->course_level == 2){
                                                                echo "Intermediate Level";
                                                            }elseif($course_info->course_level == 3){
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
                                                            width="17.26" height="14.926" viewBox="0 0 17.26 14.926">
                                                            <path id="Path_148" data-name="Path 148"
                                                                d="M16.065,17.081H1.2a1.2,1.2,0,0,0-1.2,1.2V28.364a1.2,1.2,0,0,0,1.2,1.2h8.67l-.262,1.6a.69.69,0,0,0,1.041.75l1.871-.985a.393.393,0,0,1,.248,0l1.871.985a.834.834,0,0,0,.388.1.656.656,0,0,0,.387-.123.726.726,0,0,0,.266-.728l-.262-1.6h.651a1.2,1.2,0,0,0,1.2-1.2V18.277A1.2,1.2,0,0,0,16.065,17.081ZM12.64,27.511a2.084,2.084,0,1,1,2.084-2.084A2.086,2.086,0,0,1,12.64,27.511Zm.6,2.5a1.383,1.383,0,0,0-1.2,0l-1.323.7.42-2.565a3.1,3.1,0,0,0,3.007,0l.164,1v.005l.256,1.56Zm2.994-1.651a.173.173,0,0,1-.171.171h-.819l-.187-1.142s0-.009,0-.013a3.108,3.108,0,1,0-4.831,0l0,.013-.187,1.142H1.2a.173.173,0,0,1-.171-.171V18.277a.173.173,0,0,1,.171-.171H16.065a.173.173,0,0,1,.171.171Z"
                                                                transform="translate(0 -17.081)" fill="#B5C5DB" />
                                                            <path id="Path_149" data-name="Path 149"
                                                                d="M43.246,60.243H31.631a.512.512,0,0,0,0,1.025H43.246a.512.512,0,0,0,0-1.025Z"
                                                                transform="translate(-28.993 -57.295)" fill="#B5C5DB" />
                                                            <path id="Path_150" data-name="Path 150"
                                                                d="M36.55,100.911H31.631a.512.512,0,0,0,0,1.025H36.55a.512.512,0,0,0,0-1.025Z"
                                                                transform="translate(-28.993 -95.184)" fill="#B5C5DB" />
                                                        </svg>
                                                    </div>
                                                    <div class="course-card__hints--text fs-12 fw-bold text-white">
                                                        <?php if($course_info->enterprise_name=='Admin'){ echo "Lead Academy";}else{ echo $course_info->enterprise_name." "."Academy";}?>
                                                        <?php //echo (!empty($course_info->enterprise_name) ? $course_info->enterprise_name : ''); ?>
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
                                                        $course_wise_lesson = $this->Course_model->course_wise_lesson( $course_info->course_id);
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
                                            <svg id="clock_1_" data-name="clock (1)" xmlns="http://www.w3.org/2000/svg"
                                                width="16.706" height="16.706" viewBox="0 0 16.706 16.706">
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
                                                $course_wise_lesson = $this->Course_model->course_wise_lesson( $course_info->course_id);
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
                                        <i class="fas fa-graduation-cap fs-15 me-1 " style="color:#B5C5DB"></i>
                                        <div class="d-block">
                                            <div class="reviews fs-12 fw-bold text-white"><?php 
                                            $studentCount = $this->db->where('product_id', $course_info->course_id)->get('invoice_details')->num_rows();
                                                //echo  html_escape($studentCount?$studentCount:0)
                                                echo number_format($studentCount?$studentCount:0); 
                                            ?></div>
                                        </div>
                                    </div>

                                    <!--Start Star Rating-->
                                    <div class="star-rating__wrap d-flex align-items-center ">
                                        <i class="fas fa-star me-1 text-warning" style="color:#B5C5DB"></i>
                                        <div class="d-block">
                                            <div class="reviews fs-12 fw-bold text-white">
                                                <?php echo average_ratings_number($course_info->course_id,$enterprise_id);?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End Course Card Body-->

                            <!--Start Course Card Hover Content-->
                            <div class="course-card__hover--content">
                                <img src="<?php echo base_url(!empty($course_info->hover_thumbnail) ? $course_info->hover_thumbnail :default_600_400()); ?>"
                                    class="course-card__hover--content___img">
                                <!--Start Video Icon With Popup Youtube-->
                                <?php if($course_info->url){ ?>

                                <a class="course-card__hover--content___icon popup-youtube"
                                    href="<?php echo (!empty($course_info->url)? $course_info->url : ''); ?>" autoplay>
                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/Playicon.png'); ?>"
                                        class="img-fluid" alt="">
                                </a>
                                <?php } ?>
                                <!--End Video Icon With Popup Youtube-->

                                <h3
                                    class="bottom-0 course-card__hover--content___text d-block fs-15 mb-0 position-absolute text-capitalize text-decoration-none text-white">
                                    <a href="<?php echo base_url($enterprise_shortname. '/course-details/'. $course_info->course_id); ?>"
                                        class="text-decoration-none text-white"><?php echo (!empty($course_info->name) ? $course_info->name : ''); ?></a>
                                </h3>
                            </div>
                            <!--End Card Hover Content-->
                        </div>

                        <?php $course_types = json_decode($course_info->course_type);
                        $checked_purchase = $this->db->where('customer_id',$user_id)->where('product_id', $course_info->course_id)->where('status',1)->get('invoice_details')->row();
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
                                        <label class="align-items-center d-flex form-check-label fw-bold justify-content-between" style="width:100%;"
                                                for="flexRadioDefault2_<?php echo $course_info->course_id?>">
                                                <span class="course_price_cart">Course Price
                                                    <span class="text-success">
                                                    </span>
                                                </span>
                                                <span class="align-items-center d-flex  rounded text-center">
                                                    <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                        <?php echo (($course_info->is_offer == 1) ? number_format($course_info->offer_courseprice) : number_format($course_info->price)); ?></span>
                                                    <?php if(!empty($course_info->is_discount==1)){?>
                                                    <del
                                                        class="fs-12 fw-bold text-muted2"><?php echo (($course_info->oldprice)?number_format($course_info->oldprice) :" "); ?></del>
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
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $course_info->course_id); ?>"
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
                                <input type="hidden" class="related_course"
                                    value="<?php echo $course_info->course_id;?>"
                                    id="<?php echo $course_info->course_id;?>">
                                <div class="align-items-center d-flex form-check ps-0">
                                    <!-- <input class="form-check-input" type="radio" name="flexRadioDefault1_<?php echo $course_info->course_id?>" id="flexRadioDefault1_<?php echo $course_info->course_id?>"  onclick="subscriptionchecedRadio('<?php echo $course_info->course_id;?>')" > -->
                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                        name="flexRadioDefault_11<?php echo $course_info->course_id;?>"
                                        id="flexRadioDefault11_<?php echo $course_info->course_id?>"
                                        onclick="subscriptionchecedRadios('<?php echo $course_info->course_id;?>')">
                                    <label class="form-check-label fw-bold course_price_cart "
                                        for="flexRadioDefault11_<?php echo $course_info->course_id?>">
                                        Subscription
                                    </label>
                                </div>
                                <div class="form-check d-flex align-items-center ps-0">
                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                        name="flexRadioDefault_21<?php echo $course_info->course_id;?>"
                                        id="flexRadioDefault21_<?php echo $course_info->course_id?>"
                                        onclick="coursechecedRadios('<?php echo $course_info->course_id;?>')" checked>
                                    <label
                                        class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                        style="width:100%;"
                                        for="flexRadioDefault21_<?php echo $course_info->course_id?>">
                                        <span class="course_price_cart">Course Price
                                            <span class="text-success">
                                            </span>
                                        </span>
                                        <span class="align-items-center d-flex  rounded text-center">
                                            <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                <?php echo (($course_info->is_offer == 1) ? number_format($course_info->offer_courseprice) : number_format($course_info->price)); ?></span>
                                            <?php if(!empty($course_info->is_discount==1)){?>
                                            <del
                                                class="fs-12 fw-bold text-muted2"><?php echo (($course_info->oldprice)?number_format($course_info->oldprice) :" "); ?></del>
                                            <?php }?>

                                        </span>
                                    </label>
                                </div>
                                <div class="d-flex justify-content-between align-items-stretch mt-2"
                                    id="course_purchases_<?php echo $course_info->course_id?>">
                                    <div class="flex-grow-1 me-2 w-sub">
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $course_info->course_id); ?>"
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
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $course_info->course_id); ?>"
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
                                    id="course_subscriptions_<?php echo $course_info->course_id?>">
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
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $course_info->course_id); ?>"
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
                                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $course_info->course_id); ?>" class="btn btn-dark-cerulean w-100">
                                                <i data-feather="info" class="me-1"></i>
                                                Details
                                            </a>
                                        </div>
                                    </div> -->
                                <?php }elseif(in_array("1", $course_types)){?>
                                <div class="align-items-center d-flex form-check ps-0">
                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                        name="flexRadioDefault1_<?php echo $course_info->course_id?>"
                                        id="flexRadioDefault1_<?php echo $course_info->course_id?>"
                                        onclick="subscriptionchecedRadio('<?php echo $course_info->course_id;?>')"
                                        disabled>
                                    <label class="form-check-label fw-bold opa-half course_price_cart"
                                        for="flexRadioDefault1">
                                        Subscription
                                    </label>
                                </div>
                                <div class="form-check d-flex align-items-center ps-0">
                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                        name="flexRadioDefault2_<?php echo $course_info->course_id?>"
                                        id="flexRadioDefault2_<?php echo $course_info->course_id?>"
                                        onclick="coursechecedRadio('<?php echo $course_info->course_id;?>')" checked>
                                    <label
                                        class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                        style="width:100%" for="flexRadioDefault2_<?php echo $course_info->course_id?>">
                                        <span class="course_price_cart">Course Price <span class="text-success"></span>
                                        </span>
                                        <span class="align-items-center d-flex  rounded text-center">
                                            <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                <?php echo (($course_info->is_offer == 1) ? number_format($course_info->offer_courseprice) : number_format($course_info->price)); ?></span>
                                            <?php if(!empty($course_info->is_discount==1)){?>
                                            <del
                                                class="fs-12 fw-bold text-muted2"><?php echo (($course_info->oldprice)?number_format($course_info->oldprice) :" "); ?></del>
                                            <?php }?>
                                        </span>

                                    </label>
                                </div>
                                <div class="d-flex justify-content-between align-items-stretch mt-2">
                                    <div class="flex-grow-1 me-2 w-sub">
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $course_info->course_id); ?>"
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
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $course_info->course_id); ?>"
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
                                        name="flexRadioDefault1_<?php echo $course_info->course_id?>"
                                        id="flexRadioDefault1_<?php echo $course_info->course_id?>"
                                        onclick="subscriptionchecedRadio('<?php echo $course_info->course_id;?>')"
                                        checked>
                                    <label class="form-check-label fw-bold course_price_cart"
                                        for="flexRadioDefault1_<?php echo $course_info->course_id?>">
                                        Subscription
                                    </label>
                                </div>
                                <div class="form-check d-flex align-items-center ps-0 ">
                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                        name="flexRadioDefault2_<?php echo $course_info->course_id?>"
                                        id="flexRadioDefault2_<?php echo $course_info->course_id?>"
                                        onclick="coursechecedRadio('<?php echo $course_info->course_id;?>')" disabled>
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
                                            <span class="text-center w-100 fw-bold fs-13"> Subscription
                                            </span>
                                        </a>
                                    </div>
                                    <div class="flex-grow-1">
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $course_info->course_id); ?>"
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
                                        name="flexRadioDefault1_<?php echo $course_info->course_id?>"
                                        id="flexRadioDefault1_<?php echo $course_info->course_id?>"
                                        onclick="subscriptionchecedRadio('<?php echo $course_info->course_id;?>')"
                                        disabled>
                                    <label class="form-check-label fw-bold opa-half course_price_cart"
                                        for="flexRadioDefault1">
                                        Subscription
                                    </label>
                                </div>
                                <div class="align-items-center d-flex form-check ps-0">
                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                        name="flexRadioDefault2_<?php echo $course_info->course_id?>"
                                        id="flexRadioDefault2_<?php echo $course_info->course_id?>"
                                        onclick="coursechecedRadio('<?php echo $course_info->course_id;?>')" disabled>
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
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $course_info->course_id); ?>"
                                            class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                            <span class="shopping me-1 shopping_icon position-relative">
                                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                    style="width: 14px;">
                                            </span>
                                            <span class="text-center w-100 fw-bold fs-13"> Enroll Free </span>
                                        </a>
                                    </div>
                                    <div class="flex-grow-1">
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $course_info->course_id); ?>"
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
                                        name="flexRadioDefault1_<?php echo $course_info->course_id?>"
                                        id="flexRadioDefault1_<?php echo $course_info->course_id?>"
                                        onclick="subscriptionchecedRadio('<?php echo $course_info->course_id;?>')"
                                        disabled>
                                    <label class="form-check-label fw-bold opa-half course_price_cart"
                                        for="flexRadioDefault1">
                                        Subscription
                                    </label>
                                </div>
                                <div class="align-items-center d-flex form-check ps-0">
                                    <input class="me-1" style="width:21px;height:21px" type="radio"
                                        name="flexRadioDefault2_<?php echo $course_info->course_id?>"
                                        id="flexRadioDefault2_<?php echo $course_info->course_id?>"
                                        onclick="coursechecedRadio('<?php echo $course_info->course_id;?>')" disabled>
                                    <label
                                        class="align-items-center d-flex form-check-label fw-bold justify-content-between opa-half"
                                        for="flexRadioDefault2_<?php echo $course_info->course_id?>">
                                        <span class="course_price_cart">Course Price</span>
                                        <span class="bg-danger d-flex px-2 rounded text-center text-white">
                                            <!-- Govt -->
                                        </span>
                                    </label>
                                    <span class="badge bg-success me-1 float-end ms-auto"> Govt</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-stretch mt-2">
                                    <div class="flex-grow-1 me-2 w-sub">
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $course_info->course_id); ?>"
                                            class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                            <span class="shopping me-1 shopping_icon position-relative">
                                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                    style="width: 14px;">
                                            </span>
                                            <span class="text-center w-100 fw-bold fs-13"> Govt </span>
                                        </a>
                                    </div>
                                    <div class="flex-grow-1">
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $course_info->course_id); ?>"
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
                    </div>
                    <?php }
                
                ?>
                    <!--End Course Card-->
                </div>
            </div>

        </div>
        <?php } ?>
    </div>
</div>

<div class="modal share-modal" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <h5 class="mb-3">Share This Course</h5>
                <!--Start Share Link Input-->
                <!-- <div class="share-input input-group mb-3">
                    <input type="text" class="form-control"
                        value="https://www.udemy.com/share/101W8Q/">
                    <button class="btn btn-outline-secondary px-4" type="button">Copy</button>
                </div> -->
                <!--End Share Link Input-->
                <!--Start Social Share-->
                <ul class="socail-share list-unstyled d-flex mb-0 justify-content-center">
                    <li><a href="https://www.facebook.com/sharer.php?u=<?php echo base_url($enterprise_shortname . '/course-details/' .$get_coursedetails->course_id); ?>"
                            target="_blank" class="d-block text-center me-3 text-muted">
                            <div class="socail-share_icon facebook"><i class="fab fa-facebook-f"></i></div>Facebook
                        </a></li>
                    <li><a href="https://twitter.com/share?text=<?php echo $get_coursedetails->name;?> &url=<?php echo base_url($enterprise_shortname.'/course-details/'.$get_coursedetails->course_id); ?> "
                            target="_blank" class="d-block text-center me-3 text-muted">
                            <div class="socail-share_icon twitter"><i class="fab fa-twitter"></i></div>Twitter
                        </a></li>
                    <li><a href="https://api.whatsapp.com/send?text=[<?php echo $get_coursedetails->name;?>] [<?php echo base_url($enterprise_shortname . '/course-details/' .$get_coursedetails->course_id); ?>]"
                            class="d-block text-center me-3 text-muted" target="_blank" rel="noopener">
                            <div class="socail-share_icon" style="background-color:#37b546;"><i class="fab fa-whatsapp"
                                    style="color:#fff;"></i></div>WhatsApp
                        </a></li>
                    <li><a href="mailto:?subject=<?php echo $get_coursedetails->name; ?> &body=<?php echo $get_coursedetails->description; ?> PLEASE VISIT THIS LINK:  <?php echo base_url($enterprise_shortname . '/course-details/' .$get_coursedetails->course_id); ?>" class="d-block text-center me-3 text-muted">
                            <div class="socail-share_icon envelope"><i class="far fa-envelope"></i></div>Email
                        </a></li>
                    <li>
                        <a href="https://www.facebook.com/dialog/send?link=<?php echo base_url($enterprise_shortname.'/course-details/'.$get_coursedetails->course_id); ?>&app_id=311161661010577&redirect_uri=<?php echo base_url($enterprise_shortname.'/course-details/'.$get_coursedetails->course_id); ?>"
                            target="_blank" class="fbmsg text-capitalize" style="color: #9ea4a9;">
                            <div class="socail-share_icon" style="background-color: #1976d2;"><i style="color: #fff;"
                                    class="fab fa-facebook-messenger"></i></div>Messenger
                        </a>
                        <!-- https://www.facebook.com/dialog/send?link=https%3A%2F%2Flead.academy&app_id=291494419107518&redirect_uri=https%3A%2F%2Fwww.lead.academy -->
                    </li>
                </ul>
                <!--End Social Share-->
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $(".related_hideClass .related_course").each(function(index) {
        var p_course_id = $(this).attr('id');
        $("#course_subscriptions_" + p_course_id).first().hide();
        $('#course_subscriptions_' + p_course_id).first().removeClass('d-flex');
    });
});


function coursechecedRadios(s) {
    if (!$('#flexRadioDefault21_' + s).is('.checked')) {
        $('#flexRadioDefault21_' + s).addClass('checked');
        $('#flexRadioDefault21_' + s).prop('checked', true);
        $('#flexRadioDefault21_' + s).val("1");


        $('#flexRadioDefault11_' + s).val("0");
        $('#flexRadioDefault11_' + s).removeClass('checked');
        $('#flexRadioDefault11_' + s).prop('checked', false);

        $("#course_subscriptions_" + s).hide();
        $('#course_subscriptions_' + s).removeClass('d-flex');
        $('#course_purchases_' + s).addClass('d-flex');
        $("#course_purchases_" + s).show();
    }

}

function subscriptionchecedRadios(s) {
    if (!$('#flexRadioDefault11_' + s).is('.checked')) {
        $('#flexRadioDefault11_' + s).addClass('checked');
        $('#flexRadioDefault11_' + s).prop('checked', true);
        $('#flexRadioDefault11_' + s).val("1");

        $('#flexRadioDefault21_' + s).val("0");
        $('#flexRadioDefault21_' + s).removeClass('checked');
        $('#flexRadioDefault21_' + s).prop('checked', false);
        $("#course_subscriptions_" + s).show();
        $('#course_subscriptions_' + s).addClass('d-flex');
        $('#course_purchases_' + s).removeClass('d-flex');
        $("#course_purchases_" + s).hide();
    }

}


//  //Scroll Triger
//     $('a.js-scroll-trigger[href*="#"]:not([href="#"])').on("click", function () {
//         if (location.pathname.replace(/^\//, "") === this.pathname.replace(/^\//, "") && location.hostname === this.hostname) {
//             var target = $(this.hash);
//             target = target.length ? target : $("[name=" + this.hash.slice(1) + "]");
//             if (target.length) {
//                 $("html, body").animate({
//                     scrollTop: target.offset().top - 124
//                 }, 0, "easeInOutExpo");
//                 return false;
//             }
//         }
//     });

//     // Closes responsive menu when a scroll trigger link is clicked
//     $('.js-scroll-trigger').click(function () {
//                $('.navbar-collapse', '.metismenu').collapse('hide');
//     });



//  window.addEventListener('DOMContentLoaded', event => {
// // Activate Bootstrap scrollspy on the main nav element
// const mainNav = document.body.querySelector('#navbar_top');
// if (mainNav) {
//     new bootstrap.ScrollSpy(document.body, {
//         target: '#navbar_top',
//         offset: 124,
//     });
// };

// // Collapse responsive navbar when toggler is visible
// const navbarToggler = document.body.querySelector('.navbar-toggler');
// const responsiveNavItems = [].slice.call(
//     document.querySelectorAll('#navbarResponsive .nav-link')
// );
// responsiveNavItems.map(function (responsiveNavItem) {
//     responsiveNavItem.addEventListener('click', () => {
//         if (window.getComputedStyle(navbarToggler).display !== 'none') {
//             navbarToggler.click();
//         }
//     });
// });

// });



// //Navbar Sticky
// document.addEventListener("DOMContentLoaded", function () {
//    window.addEventListener('scroll', function () {
//        if (window.scrollY > 0) {
//            document.getElementById('navbarSticky').classList.add('sticky');
//            // add padding top to show content behind navbar
//            navbar_height = document.querySelector('.header-sticky').offsetHeight;
//            document.body.style.paddingTop = navbar_height + 'px';
//        } else {
//            document.getElementById('navbarSticky').classList.remove('sticky');
//            // remove padding top from body
//            document.body.style.paddingTop = '0';
//        }
//    });
// });

// document.addEventListener("DOMContentLoaded", function () {
//    window.addEventListener('scroll', function () {
//        if (window.scrollY > 431) {
//            document.getElementById('navbar_top').classList.add('fixed-header-nav');
//            // add padding top to show content behind navbar
//            navbar_height = document.querySelector('.sticky-nav').offsetHeight;
//            document.body.style.paddingTop = navbar_height + 'px';
//        } else {
//            document.getElementById('navbar_top').classList.remove('fixed-header-nav');
//            // remove padding top from body
//            document.body.style.paddingTop = '0';
//        }
//    });
// });
</script>

<script>
$(document).ready(function() {
    function scrollNav() {
        $('a[href^="#"]').click(function() {
            $(".active").removeClass("active");
            $(this).addClass("active");

            $('html, body').stop().animate({
                scrollTop: $($(this).attr('href')).offset().top - 140
            }, 1000);
            return false;
        });
    }
    scrollNav();
});

var $secNavbar = $("#secNavbar"),
    y_pos = $secNavbar.offset().top,
    height = $secNavbar.height();

$(document).scroll(function() {
    var scrollTop = $(this).scrollTop();

    if (scrollTop > y_pos + height) {
        $secNavbar.addClass("navbar-fixed").animate({
            top: "70px"
        });
    } else if (scrollTop <= y_pos) {
        $secNavbar.removeClass("navbar-fixed").clearQueue().animate({
            top: "-48px"
        }, 0);
    }
});
</script>