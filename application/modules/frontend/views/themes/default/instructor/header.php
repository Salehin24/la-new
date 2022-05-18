<?php
$segmentone = $this->uri->segment(1);
// dd(enterpriseid_byshortname($segmentone));
$enterprise_id = (!empty($segmentone) ? enterpriseid_byshortname($segmentone) : 1);
$enterprise_info = get_enterpriseinfo($enterprise_id);
$enterprise_shortname = (!empty($enterprise_info->shortname) ? $enterprise_info->shortname : 'admin');
// dd($enterprise_shortname);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Google font-->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/bootstrap/css/bootstrap.min.css'); ?>"
        rel="stylesheet">
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/fontawesome/css/all.min.css'); ?>"
        rel="stylesheet">
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/typicons.font/src/font/typicons.min.css'); ?>"
        rel="stylesheet">
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/mmenu-light/dist/mmenu-light.css'); ?>"
        rel="stylesheet">
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/OwlCarousel2/css/owl.carousel.min.css'); ?>"
        rel="stylesheet">
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/OwlCarousel2/css/owl.theme.default.min.css'); ?>"
        rel="stylesheet">
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/video-popup/videoPopUp.css'); ?>"
        rel="stylesheet">
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/Magnific-Popup/dist/magnific-popup.css'); ?>"
        rel="stylesheet">
        <link href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/sweetalert/sweet-alert.min.css'); ?>" rel="stylesheet">
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/scrolling-tabs/dist/jquery.bs4-scrolling-tabs.min.css'); ?>"
        rel="stylesheet">
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css'); ?>"
        rel="stylesheet">
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/toastr/toastr.css'); ?>"
        rel="stylesheet">

    <link href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name))?>/assets/plugins/datatables/dataTables.min.css" rel="stylesheet">
        <link href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name))?>/assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name))?>/assets/plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet">
        <link href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name))?>/assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet">

    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/css/style.css'); ?>"
        rel="stylesheet">
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/css/frontends.css'); ?>"
        rel="stylesheet">
    <script
        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/js/virtualpaginate.js'); ?>">
    </script>
     <link href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/raty/lib/jquery.raty.css'); ?>" rel="stylesheet">

    <script
        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/jquery/jquery.js'); ?>">
    </script>
    
    <script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/Chart.js/chart.min.js'); ?>">
</script>
    
    <title>Lead Academy</title>
</head>

<body>
    <div class="se-pre-con"></div>
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <input type="hidden" id="enterprise_id" value="<?php echo (!empty($enterprise_id) ? $enterprise_id : '1'); ?>">
    <input type="hidden" id="enterprise_shortname" value="<?php echo $enterprise_shortname; ?>">
    <input type="hidden" id="user_type" value="<?php echo html_escape($this->session->userdata('user_type')); ?>">
    <input type="hidden" id="user_id" value="<?php echo html_escape($this->session->userdata('user_id')); ?>">
    <input type="hidden" name="CSRF_TOKEN" id="CSRF_TOKEN" value="<?php echo $this->security->get_csrf_hash(); ?>">
    <input type="hidden" id="api_key" value="<?php echo $this->session->userdata('api_key'); ?>">
    <input type="hidden" id="cluster" value="<?php echo $this->session->userdata('cluster'); ?>">
    <input type="hidden" id="user_ban_login_message" value="<?php echo display('user_ban_login_message'); ?>">
    <input type="hidden" id="onlynumber_allow" value="<?php echo display('onlynumber_allow'); ?>">
    <input type="hidden" id="security_character" value="<?php echo display('security_character'); ?>">
    <input type="hidden" id="coursespecial_character" value="<?php echo display('coursespecial_character'); ?>">
    <input type="hidden" id="mail_specialcharacter_remove"
        value="<?php echo display('mail_specialcharacter_remove'); ?>">
    <input type="hidden" id="examid" value="<?php echo $this->session->userdata('examid'); ?>">
    <input type="hidden" id="popup" value="<?php echo $this->session->userdata('popup'); ?>">
    <input type="hidden" id="segment1" value="<?php echo $this->uri->segment(1); ?>">
    <input type="hidden" id="segment2" value="<?php echo $this->uri->segment(2); ?>">


    <?php
        if ($this->session->userdata('popup') == 1) {
            $this->session->unset_userdata('popup');
        }
       
        $session_id = $this->session->userdata('session_id');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        ($profile_pic = $this->session->userdata('image'));
        //d($get_appseeting);
        ?>
    <!--Start Back to top button -->
    <button type="button" class="btn btn-outline-dark-cerulean btn-top" id="btn-back-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>
    <!--End Back to top button -->
    <!--Start Navbar -->
    <?php if ($transfarentmenu == 1) { ?>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-transfarent">
        <?php } else { ?>
        <!-- <nav class="navbar navbar-expand-lg navbar-light navbar-shadow header-sticky navbar-dark-cerulean"
            id="navbarSticky"> -->
            <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-shadow header-sticky navbar-transparent" id="navbarSticky">
            <?php } ?>
            <div>
                <a href="#menu" class="navbar-toggler me-2">
                    <span class="navbar-toggler-icon"></span>
                </a>
                <a class="navbar-brand" href="<?php echo base_url($enterprise_shortname); ?>">
                    <img src="<?php echo base_url(html_escape(!empty($get_appseeting->logoTwo) ? "$get_appseeting->logoTwo" : 'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/logo.png')); ?>" class="img-fluid" alt="">   
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!--mobile nav and category nav-->
                <div class="main-nav-wrap me-auto me-xl-0" id="menu">
                    <ul class="mobile-main-nav">
                        <li>
                            <a href="">
                                <svg class="me-2" data-name="Component 2 – 1" xmlns="http://www.w3.org/2000/svg"
                                    width="22" height="22" viewBox="0 0 26.433 26.433">
                                    <g id="Group_2" data-name="Group 2">
                                        <g id="Group_1" data-name="Group 1">
                                            <path id="Path_1" data-name="Path 1"
                                                d="M9.127,0H3.057A3.06,3.06,0,0,0,0,3.057V9.127a3.06,3.06,0,0,0,3.057,3.057H9.127a3.06,3.06,0,0,0,3.057-3.057V3.057A3.06,3.06,0,0,0,9.127,0Zm.992,9.127a.993.993,0,0,1-.992.992H3.057a.993.993,0,0,1-.992-.992V3.057a.993.993,0,0,1,.992-.992H9.127a.993.993,0,0,1,.992.992Z"
                                                fill="#fff" />
                                        </g>
                                    </g>
                                    <g id="Group_4" data-name="Group 4" transform="translate(14.249)">
                                        <g id="Group_3" data-name="Group 3">
                                            <path id="Path_2" data-name="Path 2"
                                                d="M285.087,0H279.1A3.1,3.1,0,0,0,276,3.1V9.087a3.1,3.1,0,0,0,3.1,3.1h5.989a3.1,3.1,0,0,0,3.1-3.1V3.1A3.1,3.1,0,0,0,285.087,0Zm1.033,9.087a1.034,1.034,0,0,1-1.033,1.033H279.1a1.034,1.034,0,0,1-1.033-1.033V3.1A1.034,1.034,0,0,1,279.1,2.065h5.989A1.034,1.034,0,0,1,286.119,3.1Z"
                                                transform="translate(-276)" fill="#fff" />
                                        </g>
                                    </g>
                                    <g id="Group_6" data-name="Group 6" transform="translate(0 14.249)">
                                        <g id="Group_5" data-name="Group 5">
                                            <path id="Path_3" data-name="Path 3"
                                                d="M9.127,276H3.057A3.06,3.06,0,0,0,0,279.057v6.071a3.06,3.06,0,0,0,3.057,3.057H9.127a3.06,3.06,0,0,0,3.057-3.057v-6.071A3.06,3.06,0,0,0,9.127,276Zm.992,9.127a.993.993,0,0,1-.992.992H3.057a.993.993,0,0,1-.992-.992v-6.071a.993.993,0,0,1,.992-.992H9.127a.993.993,0,0,1,.992.992Z"
                                                transform="translate(0 -276)" fill="#fff" />
                                        </g>
                                    </g>
                                    <g id="Group_8" data-name="Group 8" transform="translate(14.249 14.249)">
                                        <g id="Group_7" data-name="Group 7">
                                            <path id="Path_4" data-name="Path 4"
                                                d="M285.087,276H279.1a3.1,3.1,0,0,0-3.1,3.1v5.989a3.1,3.1,0,0,0,3.1,3.1h5.989a3.1,3.1,0,0,0,3.1-3.1V279.1A3.1,3.1,0,0,0,285.087,276Zm1.033,9.087a1.034,1.034,0,0,1-1.033,1.033H279.1a1.034,1.034,0,0,1-1.033-1.033V279.1a1.034,1.034,0,0,1,1.033-1.033h5.989a1.034,1.034,0,0,1,1.033,1.033Z"
                                                transform="translate(-276 -276)" fill="#fff" />
                                        </g>
                                    </g>
                                </svg>
                                <span><?php echo display('categories'); ?></span>
                            </a>
                            <ul>

                                <?php
                                    $parent_category = $this->db->select('*')->from('category_tbl')->where('parent_id', '')->where('status', 1)->where('enterprise_id', $enterprise_id)->get()->result();
                                    foreach ($parent_category as $parent) {
                                        $subcategories = $this->db->select('*')
                                                        ->from('category_tbl')
                                                        ->where('parent_id', $parent->category_id)
                                                        ->where('status', 1)
                                                        ->get()->result();
                                        if (!empty($subcategories)) {
                                            ?>
                                <li>
                                    <a href="<?php echo base_url($enterprise_shortname . '/category-course/' . html_escape($parent->category_id)); ?>"
                                        class="Selected">
                                        <div class="icon"><i class="<?php echo html_escape($parent->icon); ?>"></i>
                                        </div>
                                        <div><?php echo html_escape($parent->name); ?></div>
                                        <div class="has-sub-category"><i class="fas fa-angle-right"></i></div>
                                    </a>
                                    <ul>
                                        <?php
                                                    foreach ($subcategories as $subcategory) {
                                                        $childcategories = $this->db->select('*')
                                                                        ->from('category_tbl')
                                                                        ->where('parent_id', $subcategory->category_id)
                                                                        ->where('status', 1)
                                                                        ->get()->result();
                                                        if (!empty($childcategories)) {
                                                            ?>
                                        <li>
                                            <a
                                                href="<?php echo base_url($enterprise_shortname . '/category-course/' . html_escape($subcategory->category_id)); ?>">
                                                <div><?php echo html_escape($subcategory->name); ?></div>
                                                <div class="has-sub-category"><i class="fas fa-angle-right"></i></div>
                                            </a>
                                            <ul>
                                                <?php
                                                                    if (!empty($childcategories)) {
                                                                        foreach ($childcategories as $childcategory) {
                                                                            ?>
                                                <li><a
                                                        href="<?php echo base_url($enterprise_shortname . '/category-course/' . html_escape($childcategory->category_id)); ?>"><?php echo html_escape($childcategory->name); ?></a>
                                                </li>
                                                <?php
                                                                        }
                                                                    }
                                                                    ?>
                                            </ul>
                                        </li>
                                        <?php } else {
                                                            ?>
                                        <li><a
                                                href="<?php echo base_url($enterprise_shortname . '/category-course/' . html_escape($subcategory->category_id)); ?>"><?php echo html_escape($subcategory->name); ?></a>
                                        </li>
                                        <?php
                                                        }
                                                    }
                                                    ?>
                                    </ul>
                                </li>
                                <?php } else {
                                            ?>
                                <li>
                                    <a href="<?php echo base_url($enterprise_shortname . '/category-course/' . html_escape($parent->category_id)); ?>"
                                        class="Selected">
                                        <div class="icon"><i
                                                class="<?php echo html_escape($parent->icon); ?> fs-25"></i></div>
                                        <div><?php echo html_escape($parent->name); ?></div>
                                    </a>
                                </li>
                                <?php
                                        }
                                    }
                                    ?>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!--Navbar search box-->

                <div class="input-group  ms-3 me-auto d-none d-xl-flex">
                    <input type="text" class="form-control typeahead" placeholder="What do you want yo learn?"
                        aria-label="Recipient's username" aria-describedby="button-addon2" id="item" name="typeahead" autocomplete="off">
                    <button class="btn btn-dark-cerulean" type="button" id="button-addon2" onclick="typeahead_search()">
                        <svg id="Component_1_1" data-name="Component 1 – 1" xmlns="http://www.w3.org/2000/svg"
                            width="22.734" height="22.734" viewBox="0 0 22.734 22.734">
                            <g id="Group_16" data-name="Group 16" transform="translate(3.418 4.928)">
                                <g id="Group_15" data-name="Group 15">
                                    <path id="Path_5" data-name="Path 5"
                                        d="M79.837,111.222a.84.84,0,0,0-1.188,0,5.74,5.74,0,0,0-1.642,4.653.84.84,0,0,0,.835.756c.028,0,.056,0,.084,0a.84.84,0,0,0,.752-.919,4.067,4.067,0,0,1,1.158-3.3A.839.839,0,0,0,79.837,111.222Z"
                                        transform="translate(-76.978 -110.975)" fill="#fff" />
                                </g>
                            </g>
                            <g id="Group_18" data-name="Group 18">
                                <g id="Group_17" data-name="Group 17">
                                    <path id="Path_6" data-name="Path 6"
                                        d="M9.6,0a9.6,9.6,0,1,0,9.6,9.6A9.614,9.614,0,0,0,9.6,0Zm0,17.526A7.923,7.923,0,1,1,17.526,9.6,7.932,7.932,0,0,1,9.6,17.526Z"
                                        fill="#fff" />
                                </g>
                            </g>
                            <g id="Group_20" data-name="Group 20" transform="translate(14.951 14.951)">
                                <g id="Group_19" data-name="Group 19">
                                    <path id="Path_7" data-name="Path 7"
                                        d="M344.246,343.059l-6.1-6.1a.84.84,0,1,0-1.188,1.188l6.1,6.1a.84.84,0,0,0,1.188-1.188Z"
                                        transform="translate(-336.708 -336.71)" fill="#fff" />
                                </g>
                            </g>
                        </svg>
                    </button>
                </div>
                <ul class="navbar-nav flex-row align-items-center">
                    <!--                        <li class="nav-item d-none d-md-block active">
                                                    <a class="nav-link" href="#">Courses <span class="sr-only">(current)</span></a>
                                                </li>-->
             <?php if ($session_id && $user_type == 5) {
                        // $this->load->model('Frontend_model');
                    $ge_mycourses = $this->Frontend_model->mycourse($user_id);
                        
                    ?>
                    <!--my course-->
                    <!-- <li class="nav-item dropdown dmenu dropdown-course d-none d-md-block">
                        <a class="nav-link dropdown-toggle" href="#" id="myCourse" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <?php echo display('my_courses'); ?>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right sm-menu animate slideIn"
                            aria-labelledby="myCourse">
                            <div class="notifications-scroll">
                                <?php if($ge_mycourses){ 
                                            foreach($ge_mycourses as $mycourse){ ?>
                                <a href="<?php echo base_url($enterprise_shortname.'/course-details/'.$mycourse->course_id); ?>"
                                    class="media dropdown-course-grid">
                                    <img src="<?php echo base_url(!empty($mycourse->picture) ? $mycourse->picture : 'application/modules/frontend/views/themes/default/assets/defaul-course.png'); ?>"
                                        class="me-3" alt="..." width="30%">
                                    <div class="media-body">
                                        <h5 class="course-title overflow-hidden font-weight-bold fs-14 mb-1">
                                            <?php echo (!empty($mycourse->name) ? $mycourse->name : ''); ?></h5>
                                        <div class="course-des fs-12 mb-0">
                                            <?php echo html_escape(!empty($mycourse->summary) ? $mycourse->summary : ''); ?>
                                        </div>
                                        <div class="progress mt-2">
                                            <div class="progress-bar bg-dark-cerulean" role="progressbar"
                                                style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </a>
                                <?php 
                                }
                             } 
                             ?>
                            </div>
                            <a href="#" class="dropdown-footer d-block text-center p-2">See all</a>
                        </div>
                    </li> -->

                    <li class="nav-item">
					<a class="nav-link" href="#" role="button">
						<i data-feather="upload" class="navbar-icon"></i>
					</a>
				    </li>
                    <?php 
                    $instructor= $this->uri->segment(2);
                    if (strpos($instructor, 'instructor') !== false) {?>
                        <li class="nav-item dropdown dmenu dropdown-bell">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="bell" class="navbar-icon"></i>
                            <span class="badge">9</span>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right sm-menu animate slideIn">
                            <div class="notifications-scroll">
                                <a href="#" class="media dropdown-course-grid">
                                    <img src="<?php echo base_url('application/modules/frontend/views/themes/default/assets/img/my-course-01.jpg');?>" class="me-3" alt="...">
                                    <div class="media-body">
                                        <h5 class="course-title overflow-hidden font-weight-bold fs-14 mb-1">Internet Safety - How to keep your children safe online</h5>
                                        <div class="course-des fs-12 mb-0">By Academind by Maximilian Schwarzmüller and 1 other</div>
                                    </div>
                                </a>
                            </div>
                            <a href="#" class="dropdown-footer d-block text-center font-weight-600 p-2 bg-clear-day">See all</a>
                        </div>
                        </li>
                    <?php 
                    }else{?>
                    <!-- <li class="nav-item dropdown dmenu dropdown-wishlist">
                        <a class="nav-link dropdown-toggle" href="#" id="wishlist" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <i data-feather="heart" class="navbar-icon"></i>
                            <?php 
                            $countsavedcourse = $this->Frontend_model->countsavedcourse($user_id);
                            $get_savedcousebystudent = $this->Frontend_model->get_savedcousebystudent($user_id);
                            if($countsavedcourse){ ?>
                            <span class="badge"><?php echo $countsavedcourse; ?></span>
                            <?php } ?>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right sm-menu animate slideIn"
                            aria-labelledby="wishlist">
                            <div class="notifications-scroll">
                                <?php if($get_savedcousebystudent){ 
                                    foreach($get_savedcousebystudent as $savedcourse){
                                    ?>
                                <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $savedcourse->course_id); ?>"
                                    class="media dropdown-course-grid">
                                    <img src="<?php echo base_url(html_escape(($savedcourse->picture) ? "$savedcourse->picture" : "application/modules/frontend/views/themes/default/assets/defaul-course.png")); ?>"
                                        class="me-3" alt="..." width="30%">
                                    <div class="media-body">
                                        <h5 class="course-title overflow-hidden font-weight-bold fs-14 mb-1">
                                            <?php echo (!empty($savedcourse->name) ? $savedcourse->name : ''); ?></h5>
                                        <div class="course-pricing d-flex align-items-center font-weight-bold">
                                            <div class="price-discount text-danger mr-2 fs-12">
                                                <del><?php echo (!empty($savedcourse->oldprice) ? $savedcourse->oldprice : ''); ?></del>
                                            </div>
                                            <div class="price-original text-dark">
                                                <?php echo (!empty($savedcourse->price) ? $savedcourse->price : ''); ?>
                                            </div>
                                        </div>
                                      
                                    </div>
                                </a>
                                <?php 
                                }
                            }
                             ?>
                            </div>
                            <a href="#" class="dropdown-footer d-block text-center font-weight-600 p-2 bg-clear-day">See
                                all</a>
                        </div>
                    </li> -->
                    <?php }?>
                    <!--dropdown user-->
                    <li class="nav-item dropdown dmenu dropdown-user">
					<a class="nav-link dropdown-toggle" href="#" id="user" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<!--<i class="feather icon-user fs-21"></i>-->
						<img class="user-avatar" src="<?php echo base_url(!empty($profile_pic) ? $profile_pic : default_image()); ?>" alt="">
					</a>
                        <div class="dropdown-menu  dropdown-menu-right sm-menu animate slideIn" aria-labelledby="user">
                            <div class="user-holder" style="background: #333;">
                                <div class="align-items-center d-flex mb-3">
                                    <div class="img-user mb-0 me-3">
                                        <img src="<?php echo base_url(!empty($profile_pic) ? $profile_pic : default_image()); ?>" alt="">
                                    </div><!-- img-user -->
                                    <div class="d-block">
                                        <h6 class="mb-0" style="color: #fff;"><?php echo $this->session->fullname; ?></h6>
                                        <span><?php echo $this->session->designation?></span>
                                    </div>
                                </div><!-- user-header -->
                                <a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-dashboard'); ?>" class="dropdown-item"><i class="typcn typcn-home-outline fs_18"></i>Dashboard</a>
                                <a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-profile'); ?>" class="dropdown-item"><i class="far fa-user-circle fs_18"></i>Profile/CV</a>
                                <a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-courses'); ?>" class="dropdown-item"><i class="far fa-file-alt fs_18"></i>My Courses</a>
                                <a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-activities'); ?>" class="dropdown-item"><i class="fas fa-book-reader fs_18"></i>Activity</a>
                                <a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-earnings'); ?>" class="dropdown-item"><i class="fas fa-hand-holding-usd fs_18"></i>Earning</a>
                                <a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-notifications'); ?>" class="dropdown-item"><i class="far fa-bell fs_18"></i>Notifications</a>
                                <a href="#" class="dropdown-item"><i class="fas fa-percentage fs_17"></i>Manage Coupons</a>
                                <a href="#" class="dropdown-item"><i class="typcn icon typcn-group-outline"></i>Affiliate/Refer</a>
                                <a href="instructor-settings-payments.html" class="dropdown-item"><i class="fas fa-dollar-sign fs_18"></i>Payments &amp; Payouts</a>
                                <a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-account-settings'); ?>" class="dropdown-item"><i class="typcn typcn-cog-outline"></i>Settings</a>
                                <a href="<?php echo base_url($enterprise_shortname . '/logout'); ?>" class="dropdown-item"><i class="typcn typcn-key-outline"></i>Sign Out</a>
                            </div>
                        </div>
				    </li>
                    <?php } else { ?>
                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link"
                            href="<?php echo base_url($enterprise_shortname . '/signin'); ?>"><?php echo display('sign_in'); ?></a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a class="nav-link"
                            href="<?php echo base_url($enterprise_shortname . '/enterprise-signup'); ?>"><?php echo display('for_enterprise'); ?></a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <!-- <a class="nav-link" href="<?php echo base_url($enterprise_shortname . '/instructor-signup'); ?>"><?php echo display('for_instructor'); ?></a> -->
                        <a class="nav-link" href="https://soft11.bdtask.com/leadacademy-design/instructor-dashboard.html"><?php echo display('for_instructor'); ?></a>
                    </li>
                    <li class="nav-item ml-md-3">
                        <a href="<?php echo base_url($enterprise_shortname . '/student-signup'); ?>"
                            class="btn btn-dark-cerulean"><?php echo display('join_for_free'); ?></a>
                    </li>

                    <li class="nav-item dropdown dmenu dropdown-cart">
                        <a class="nav-link " href="#" id="cart" role="button">
                            <i data-feather="shopping-cart" class="navbar-icon"></i>
                            <span class="<?php
                                    if (!empty($this->cart->contents())) {
                                        echo 'badge';
                                    }
                                    ?>">
                                <?php
                                              if (!empty($this->cart->contents())) {
                                                  echo count($this->cart->contents());
                                              }
                                              ?>
                            </span>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right sm-menu animate slideIn" aria-labelledby="cart">
                            <div class="notifications-scroll">
                                <div class="shopping-cart-header d-flex align-items-center justify-content-between">
                                    <div class="position-relative">
                                        <i data-feather="shopping-cart" class="navbar-icon"></i>
                                        <span class="<?php
                                                if (!empty($this->cart->contents())) {
                                                    echo 'badge badge-success';
                                                }
                                                ?>">
                                            <?php
                                                          if (!empty($this->cart->contents())) {
                                                              echo count($this->cart->contents());
                                                          }
                                                          ?>
                                        </span>
                                    </div>
                                    <div class="shopping-cart-total">
                                        <span class="text-muted"><?php echo display('total'); ?>:</span>
                                        <span class="main-color-text">$
                                            <?php echo html_escape($this->cart->total()); ?></span>
                                    </div>
                                </div>
                                <?php
                                        $carts = $this->cart->contents();
                                        if ($carts) {
                                            foreach ($carts as $item) {
                                                $picture = $item["picture"];
                                                ?>
                                <a href="<?php echo base_url('course-details/' . html_escape($item['id']) . '/' . html_escape($item['slug'])); ?>"
                                    class="media dropdown-course-grid">
                                    <img src="<?php echo base_url(html_escape(($picture) ? "$picture" : "application/modules/frontend/views/themes/default/assets/defaul-course.png")); ?>"
                                        class="mr-3 w-25" alt="<?php echo $item['name']; ?>">
                                    <div class="media-body">
                                        <h5 class="course-title overflow-hidden font-weight-bold fs-14 mb-1">
                                            <?php echo html_escape($item['name']); ?></h5>
                                        <div class="course-pricing d-flex align-items-center font-weight-bold">
                                            <div class="price-discount text-danger mr-2 fs-12"><del>$
                                                    <?php echo html_escape($item['old_price']); ?> </del></div>
                                            <div class="price-original text-dark">$
                                                <?php echo html_escape($item['price']); ?></div>
                                        </div>
                                    </div>
                                </a>
                                <?php
                                            }
                                        } else {
                                            echo '<p class="emptycart_msg">Your cart is empty</p>';
                                        }
                                        ?>
                            </div>
                            <div class="dropdown-footer d-block text-center font-weight-600 bg-gray border-top">
                                <a href="<?php echo base_url($enterprise_shortname .'/cart'); ?>"
                                    class="btn btn-success d-block"><?php echo display('go_to_cart'); ?></a>
                            </div>
                        </div>
                    </li>
                    <?php
                        }
                        ?>
                </ul>
            </div>
        </nav>
        <div class="modal m-t-40" id="modal_info">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title modal_ttl"></h4>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body" id="info">

                    </div>
                    <!-- Modal footer -->
                </div>
            </div>
        </div>
        <!--End Navbar-->
        <input type="hidden" id="popup" value="<?php echo $this->session->userdata('popup'); ?>">
        <?php
        if ($this->session->userdata('popup') == 1) {
            $this->session->unset_userdata('popup');
        }
        ?>