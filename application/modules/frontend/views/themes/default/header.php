<?php
$segmentone = $this->uri->segment(1);
// dd(enterpriseid_byshortname($segmentone));
$enterprise_id = (!empty($segmentone) ? enterpriseid_byshortname($segmentone) : 1);
$enterprise_info = get_enterpriseinfo($enterprise_id);
$enterprise_shortname = (!empty($enterprise_info->shortname) ? $enterprise_info->shortname : 'admin');
$session_id = $this->session->userdata('session_id');

if($enterprise_id){
    $favicon = ((!empty(getappsettings($enterprise_id)->favicon)) ? getappsettings($enterprise_id)->favicon : '');
}else{
    $favicon="";
}
// dd($session_id);
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- website favicon -->
    <link rel="shortcut icon"
        href="<?php echo base_url((!empty($favicon)? $favicon : 'assets/img/icons/favicon.png')) ?>"
        type="image/x-icon">
    <!--Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"> -->
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
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/sweetalert/sweet-alert.min.css'); ?>"
        rel="stylesheet">
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/scrolling-tabs/dist/jquery.bs4-scrolling-tabs.min.css'); ?>"
        rel="stylesheet">
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css'); ?>"
        rel="stylesheet">
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/toastr/toastr.css'); ?>"
        rel="stylesheet">

    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name))?>/assets/plugins/datatables/dataTables.min.css"
        rel="stylesheet">
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name))?>/assets/plugins/datatables/dataTables.bootstrap4.min.css"
        rel="stylesheet">
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name))?>/assets/plugins/datatables/responsive.bootstrap4.min.css"
        rel="stylesheet">
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name))?>/assets/plugins/datatables/buttons.bootstrap4.min.css"
        rel="stylesheet">

    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/css/style.css'); ?>"
        rel="stylesheet">
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/css/frontends.css'); ?>"
        rel="stylesheet">
    <script
        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/js/virtualpaginate.js'); ?>">
    </script>
    <link
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/raty/lib/jquery.raty.css'); ?>"
        rel="stylesheet">
    <link rel="stylesheet"
        href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/css/jquery-ui.css'); ?>">
    <script
        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/jquery/jquery.js'); ?>">
    </script>
    <script type="text/javascript"
        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/bootstrap-3-Typeahead/bootstrap3-typeahead.min.js'); ?>">
    </script>
    <script
        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/Chart.js/chart.min.js'); ?>">
    </script>

    <title>Lead Academy</title>
    <?php 
    if($this->uri->segment(2)=='course-details'){
    $course_id=$this->uri->segment(3);
    $get_coursedetails=$this->Frontend_model->get_coursedetails($course_id, $enterprise_id);
    $course_details_url= base_url($enterprise_shortname . '/course-details/' .$get_coursedetails->course_id);
    $cover_thumbnail= base_url($get_coursedetails->cover_thumbnail);
    ?>
    <meta property="og:image:width" content="480">
    <meta property="og:image:height" content="283">
    <meta property="og:url" content="<?php  echo $course_details_url; ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo $get_coursedetails->name;?>" />
    <meta property="og:description" content="<?php echo  $get_coursedetails->description;?>" />
    <meta property="og:image" content="<?php echo $cover_thumbnail;?>" />
    <?php }elseif($this->uri->segment(2)=='forum-details'){
    $forum_id=$this->uri->segment(3);
    $get_forum_details=$this->db->select('a.*,a.title, b.picture,c.title as cat_name')
            ->from('forum_tbl a')
            ->join('picture_tbl b', 'b.from_id = a.forum_id', 'left')
            ->join('forum_category_tbl c', 'c.forum_category_id = a.category_id', 'left')
            ->where('a.forum_id', $forum_id)
            ->where('a.enterprise_id', $enterprise_id)
            ->get()->row();
    $course_details_url= base_url($enterprise_shortname . '/forum-details/' .$get_forum_details->forum_id);
    $cover_thumbnail= base_url($get_forum_details->picture);
    ?>
    <meta property="og:image:width" content="480">
    <meta property="og:image:height" content="283">
    <meta property="og:url" content="<?php  echo $course_details_url; ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo $get_forum_details->title;?>" />
    <meta property="og:description" content="<?php echo  strip_tags($get_forum_details->description);?>" />
    <meta property="og:image" content="<?php echo $cover_thumbnail;?>" />

    <?php }elseif($this->uri->segment(2)=='event-details'){
          $event_id=$this->uri->segment(3);
          $get_coursedetails = $this->Frontend_model->get_eventdetails($event_id, $enterprise_id);
          $course_details_url= base_url($enterprise_shortname . '/event-details/' .$get_coursedetails->course_id);
          $cover_thumbnail= base_url($get_coursedetails->picture);
    ?>
    <meta property="og:image:width" content="480">
    <meta property="og:image:height" content="283">
    <meta property="og:url" content="<?php  echo $course_details_url; ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo $get_coursedetails->name;?>" />
    <meta property="og:description" content="<?php echo  $get_coursedetails->description;?>" />
    <meta property="og:image" content="<?php echo $cover_thumbnail;?>" />
    <?php }?>
</head>
<style>
.typeahead .dropdown-item {
    padding: .25rem 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 26px;
    display: block;
    white-space: break-spaces;
}
</style>

<body>
    <!-- <div class="se-pre-con"></div> -->
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
    <input type="hidden" id="segment3" value="<?php echo $this->uri->segment(3); ?>">
    <input type="hidden" id="segment4" value="<?php echo $this->uri->segment(4); ?>">
    <input type="hidden" id="segment5" value="<?php echo $this->uri->segment(5); ?>">
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
    <?php  
            $student= $this->uri->segment(2);
            if (strpos($student, 'student') !== false 
            ) {?>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-transfarent transition-duration"
        style="transition-duration: 1s;">
        <?php  }else{?>
        <!-- <nav class="navbar navbar-expand-lg navbar-light navbar-shadow header-sticky navbar-dark-cerulean" id="navbarSticky"> -->
        <nav style="z-index:11"
            class="position-fixed end-0 start-0 top-0  navbar navbar-expand-lg navbar-light navbar-shadow header-sticky navbar-dark-cerulean"
            id="navbarSticky">
            <?php }} else { ?>
            <?php          
             $instructor= $this->uri->segment(2);
            if (strpos($instructor, 'instructor') !== false 
            // || strpos($instructor, 'blog') !== false
            // || strpos($instructor, 'forum-details') !== false
            // || strpos($instructor, 'forum-category-page') !== false
            // || strpos($instructor, 'contact') !== false
            // || strpos($instructor, 'event') !== false
            ) {?>
            <nav class=" navbar navbar-expand-lg navbar-light fixed-top header-sticky navbar-transparent"
                id="navbarSticky">
                <?php }else{?>
                <nav style="z-index:11"
                    class="position-fixed end-0 start-0 top-0 navbar navbar-expand-lg navbar-light navbar-shadow header-sticky navbar-dark-cerulean"
                    id="navbarSticky">
                    <?php }}?>
                    <div>
                        <a href="#menu" class="navbar-toggler me-2">
                            <span class="navbar-toggler-icon"></span>
                        </a>
                        <a class="navbar-brand ms-0 ms-md-2" href="<?php echo base_url(($enterprise_shortname == 'admin') ? '' : $enterprise_shortname); ?>">
                            <img src="<?php echo base_url(html_escape(!empty($get_appseeting->logoTwo) ? "$get_appseeting->logoTwo" : 'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/logo.png')); ?>"
                                class="img-fluid" alt="">
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!--mobile nav and category nav-->
                        <div class="main-nav-wrap me-auto me-xl-0" id="menu">
                            <ul class="mobile-main-nav">
                                <li>
                                    <a href="javascript:void(0)">
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
                                        <span class="text-uppercase"><?php echo display('categories'); ?><i
                                                class="fa-chevron-down fas fs-14 ms-2 text-white"></i></span>
                                    </a>
                                    <ul>
                                        <li><a href="<?php echo base_url($enterprise_shortname. '/allcourse/'); ?>"
                                                class="text-dark-cerulean Selected">
                                                <div class="icon"><i class=""></i>
                                                </div>
                                                <div>All Courses</div>
                                            </a></li>
                                        <?php
                                    $parent_category = $this->db->select('*')->from('category_tbl')->where('parent_id', '')->where('status', 1)->where('enterprise_id', $enterprise_id)->order_by('ordering','asc')->get()->result();
                                    foreach ($parent_category as $parent) {
                                        $subcategories = $this->db->select('*')
                                                        ->from('category_tbl')
                                                        ->where('parent_id', $parent->category_id)
                                                        ->where('status', 1)
                                                        ->order_by('ordering','asc')        
                                                        ->get()->result();
                                        if (!empty($subcategories)) {
                                            ?>
                                        <li>
                                            <a href="<?php echo base_url($enterprise_shortname . '/category-course/' . html_escape($parent->category_id)); ?>"
                                                class="Selected">
                                                <div class="icon"><i
                                                        class="<?php echo html_escape($parent->icon); ?>"></i>
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
                                                                        ->order_by('ordering','asc')
                                                                        ->get()->result();
                                                        if (!empty($childcategories)) {
                                                            ?>
                                                <li>
                                                    <a
                                                        href="<?php echo base_url($enterprise_shortname . '/category-course/' . html_escape($subcategory->category_id)); ?>">
                                                        <div><?php echo html_escape($subcategory->name); ?></div>
                                                        <div class="has-sub-category"><i class="fas fa-angle-right"></i>
                                                        </div>
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
                                                        class="<?php echo html_escape($parent->icon); ?> fs-25"></i>
                                                </div>
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
                        <!--Navbar search boxdd-->
                        <div class="input-group  ms-3 me-auto d-none d-xl-flex">
                            <input type="text" class="form-control uiautocomplete"
                                placeholder="What do you want to learn?" aria-label="Recipient's username"
                                aria-describedby="button-addon2" id="uiitem" name="typeahead" autocomplete="off">
                            <button class="btn btn-dark-cerulean" type="button" id="button-addon2"
                                onclick="typeahead_search()">
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
                        <!-- <div class="input-group  ms-3 me-auto d-none d-xl-flex">
                            <input type="text" class="form-control typeahead" placeholder="What do you want to learn?"
                                aria-label="Recipient's username" aria-describedby="button-addon2" id="item"
                                name="typeahead" autocomplete="off">
                            <button class="btn btn-dark-cerulean" type="button" id="button-addon2"
                                onclick="typeahead_search()">
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
                        </div> -->
                        <ul class="navbar-nav flex-row align-items-center">
                            <?php if ($session_id && $user_type == 4) {
                             $ge_mycourses = $this->Frontend_model->mycourse($user_id);
                               $mycoursecount=$this->db->where('customer_id',$user_id)->where('is_subscription', 0)->where('status', 1)->count_all_results('invoice_details');
                            ?>
                            <!-- student purchase  course list-->
                            <li class="nav-item dropdown dmenu dropdown-course d-none d-md-block">
                                <a class="nav-link dropdown-toggle" href="#" id="myCourse" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo display('my_courses'); ?>
                                </a>
                                <div class="dropdown-menu  dropdown-menu-right sm-menu animate slideIn"
                                    aria-labelledby="myCourse">
                                    <div class="notifications-scroll">
                                        <div
                                            class="shopping-cart-header d-flex align-items-center justify-content-between">
                                            <div class="position-relative">
                                                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg> -->
                                                <img class="me-1"
                                                    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/001-book.png'); ?>">
                                                <span class="">

                                                </span>
                                            </div>

                                            <div class="shopping-cart-total">
                                                <span class="text-muted">Total Course:</span>
                                                <span class="main-color-text">
                                                    <?php echo $mycoursecount?$mycoursecount:0;?></span>
                                            </div>
                                        </div>
                                        <?php if($ge_mycourses){ 
                                            foreach($ge_mycourses as $mycourse){ ?>
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'.$mycourse->course_id); ?>"
                                            class="media dropdown-course-grid">
                                            <img src="<?php echo base_url(!empty($mycourse->picture) ? $mycourse->picture : 'application/modules/frontend/views/themes/default/assets/defaul-course.png'); ?>"
                                                class="me-3" alt="..." width="30%">
                                            <div class="media-body">
                                                <h5
                                                    class="course-title overflow-hidden font-weight-bold fs-14 mb-1 text-dark">
                                                    <?php echo (!empty($mycourse->name) ? $mycourse->name : ''); ?>
                                                </h5>
                                                <div class="course-des fs-12 mb-0">
                                                    <?php echo html_escape(!empty($mycourse->summary) ? $mycourse->summary : ''); ?>
                                                </div>
                                            </div>
                                        </a>
                                        <?php 
                                            }
                                        }else{?>
                                        <p class="emptycart_msg  w-75 text-center mx-auto mt-3">Your course is empty</p>

                                        <?php }?>
                                    </div>
                                    <div class="dropdown-footer d-block text-center font-weight-600 bg-gray border-top">
                                        <?php if($ge_mycourses){ ?>
                                        <a href="<?php echo base_url($enterprise_shortname. '/allcourse/'); ?>"
                                            class="btn btn-dark-cerulean d-block">Find your course</a>
                                        <?php }else{?>
                                        <a href="<?php echo base_url($enterprise_shortname. '/allcourse/'); ?>"
                                            class="btn btn-dark-cerulean d-block">Find your first course</a>
                                        <?php }?>
                                    </div>
                                    <!-- <a href="#" class="dropdown-footer d-block text-center p-2">See all</a> -->
                                </div>
                            </li>
                            <!--student-dropdown Notification-->
                            <?php 
                        $student= $this->uri->segment(2);
                        if (strpos($student, 'student') !== false) {?>
                            <!-- student notification  -->
                            <?php 
                        }else{?>
                            <!--student-dropdown wishlist-->
                            <li class="nav-item dropdown dmenu dropdown-cart">
                                <a class="nav-link dropdown-toggle" href="#" id="countsavedcourse" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <!-- <i data-feather="heart" class="navbar-icon"></i> -->
                                    <img onclick="coursesavecheck()"
                                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-1.png'); ?>"
                                        class="navbar-icon">
                                    <?php 
                                    $countsavedcourse = $this->Frontend_model->countsavedcourse($user_id);
                                    $get_savedcousebystudent = $this->Frontend_model->get_savedcousebystudent($user_id);
                                    if($countsavedcourse){ 
                                   ?>
                                    <span class="badge"><?php echo $countsavedcourse; ?></span>
                                    <?php } ?>

                                </a>
                                <div class="dropdown-menu  dropdown-menu-right sm-menu animate slideIn"
                                    aria-labelledby="cart">
                                    <?php   $coursecount=$this->db->where('student_id',$user_id)->count_all_results('coursesave_tbl');?>
                                    <div class="notifications-scroll" id="deleteSavecourse">
                                        <div
                                            class="shopping-cart-header d-flex align-items-center justify-content-between">
                                            <div class="position-relative">
                                                <img class="me-1"
                                                    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-2.png'); ?>">
                                                <span class="">
                                                </span>
                                            </div>
                                            <div class="shopping-cart-total">
                                                <span class="text-muted">Total Course:</span>
                                                <span class="main-color-text">
                                                    <?php echo $coursecount?$coursecount:0;?></span>
                                            </div>
                                        </div>
                                        <?php 
                                        if($get_savedcousebystudent){ 
                                            foreach($get_savedcousebystudent as $savedcourse){
                                        ?>
                                        <input type="hidden" name="course_id"
                                            id="course_id_<?php echo html_escape($savedcourse->course_id); ?>"
                                            value="<?php echo html_escape($savedcourse->course_id); ?>">
                                        <input type="hidden" name="course_name"
                                            id="course_name_<?php echo html_escape($savedcourse->course_id); ?>"
                                            value="<?php echo html_escape($savedcourse->name); ?>">
                                        <input type="hidden" name="slug"
                                            id="slug_<?php echo html_escape($savedcourse->course_id); ?>"
                                            value="<?php echo html_escape($savedcourse->slug); ?>">
                                        <input type="hidden" name="qty" id="qty" value="1">
                                        <input type="hidden" name="price"
                                            id="price_<?php echo html_escape($savedcourse->course_id); ?>"
                                            value="<?php if($savedcourse->is_offer == 1){ echo $savedcourse->offer_courseprice; }else{ echo $savedcourse->price; } ?>">
                                        <input type="hidden" name="old_price"
                                            id="old_price_<?php echo html_escape($savedcourse->course_id); ?>"
                                            value="<?php echo html_escape($savedcourse->oldprice); ?>">
                                        <input type="hidden" name="picture"
                                            id="picture_<?php echo html_escape($savedcourse->course_id); ?>"
                                            value="<?php echo html_escape($savedcourse->picture); ?>">
                                        <input type="hidden" name="is_course_type" id="is_course_type" value="0">

                                        <div class="media dropdown-course-grid">

                                            <img src="<?php echo base_url(html_escape(($savedcourse->picture) ? "$savedcourse->picture" : "application/modules/frontend/views/themes/default/assets/defaul-course.png")); ?>"
                                                class="me-3" alt="..." width="30%">
                                            <div class="media-body">
                                                <a
                                                    href="<?php echo base_url($enterprise_shortname.'/course-details/'. $savedcourse->course_id); ?>">
                                                    <h5
                                                        class="course-title overflow-hidden font-weight-bold fs-14 mb-1 text-dark">
                                                        <?php echo (!empty($savedcourse->name) ? $savedcourse->name : ''); ?>
                                                    </h5>
                                                </a>
                                                <!-- <div class="course-des fs-12 mb-0">By Academind by Maximilian Schwarzmüller and 1 other</div> -->
                                                <div class="course-pricing d-flex align-items-center font-weight-bold">
                                                    <div
                                                        class="price-original text-dark currency fs-12 fw-semi-bold mt-0 text-dark">
                                                        BDT
                                                        <?php echo (!empty($savedcourse->price) ? $savedcourse->price : ''); ?>
                                                    </div>

                                                    <div class="price-discount text-danger mr-2 fs-12 p-1">
                                                        <?php if($savedcourse->oldprice){?>
                                                        <del><?php echo (!empty($savedcourse->oldprice) ? $savedcourse->oldprice : ''); ?></del>
                                                        <?php }?>
                                                    </div>
                                                </div>

                                                <?php 
                                                $check_course = $this->Course_model->check_course_purchase($savedcourse->student_id, $savedcourse->course_id);
                                                if (!empty($check_course->product_id)) {
                                                }else{
                                                    $course_types = json_decode($savedcourse->course_type);  
                                                    if (in_array("1", $course_types)) {?>
                                                <div class="btn btn-dark-cerulean btn-sm"
                                                    onclick="addtocart_header('<?php echo html_escape($savedcourse->course_id); ?>')">
                                                    Add to cart</div>
                                                <?php 
                                                    }
                                                    if (in_array("2", $course_types)) {?>
                                                <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $savedcourse->course_id); ?>"
                                                    class="btn btn-dark-cerulean btn-sm">
                                                    Subscribe</a>

                                                <?php  }if (in_array("3", $course_types)) {?>
                                                <input type="hidden" id="course_type" value="3">
                                                <!-- <a href="javascript:void(0)"
                                                        onclick="addtomycourse('<?php echo html_escape($savedcourse->course_id); ?>')"
                                                        class="btn btn-dark-cerulean btn-sm">Enroll Free Course</a> -->
                                                <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $savedcourse->course_id); ?>"
                                                    class="btn btn-dark-cerulean btn-sm">Enroll Free</a>
                                                <?php }if (in_array("4", $course_types)) {?>
                                                <input type="hidden" id="course_type" value="4">
                                                <!-- <a href="javascript:void(0)"
                                                        onclick="addtomycourse('<?php echo html_escape($savedcourse->course_id); ?>')"
                                                        class="btn btn-dark-cerulean btn-sm">Enroll Gov Course</a> -->
                                                <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $savedcourse->course_id); ?>"
                                                    class="btn btn-dark-cerulean btn-sm">Enrol Gov Course</a>
                                                <?php }
                                                ?>

                                                <?php } ?>

                                                <div class="btn btn-danger btn-sm"
                                                    onclick="deleteSavecourse('0','<?php echo $savedcourse->course_id; ?>')">
                                                    <i class="fas fa-trash-alt"></i></div>
                                            </div>
                                        </div>
                                        <?php }}else{?>
                                        <p class="emptycart_msg w-75 text-center mx-auto mt-3">Your save course is empty
                                        </p>
                                        <?php }?>
                                    </div>
                                    <div class="dropdown-footer d-block text-center font-weight-600 bg-gray border-top">
                                        <?php  if($get_savedcousebystudent){?>
                                        <a href="<?php echo base_url($enterprise_shortname. '/allcourse/'); ?>"
                                            class="btn btn-dark-cerulean d-block">Find your course</a>
                                        <?php }else{?>
                                        <a href="<?php echo base_url($enterprise_shortname. '/allcourse/'); ?>"
                                            class="btn btn-dark-cerulean d-block">Find your first course</a>
                                        <?php }?>
                                    </div>
                                    <!-- <a href="#" class="dropdown-footer d-block text-center font-weight-600 p-2 bg-clear-day">See all</a> -->
                                </div>
                            </li>
                            <?php }?>

                            <!--student -- dropdown cart-->
                            <!-- cart load here  -->
                            <div class="card_add"></div>
                            <li class="nav-item dropdown dmenu dropdown-cart" id="cardbody">
                                <a class="nav-link dropdown-toggle" href="#" id="cart" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i data-feather="shopping-cart" class="navbar-icon"></i>
                                    <span
                                        class="badge"><?php if (!empty($this->cart->contents())) { echo count($this->cart->contents());}else{ echo "0";}?></span>
                                </a>
                                <div class="dropdown-menu  dropdown-menu-right sm-menu animate slideIn"
                                    aria-labelledby="cart">
                                    <div class="notifications-scroll">
                                        <div
                                            class="shopping-cart-header d-flex align-items-center justify-content-between">
                                            <div class="position-relative">
                                                <i data-feather="shopping-cart"></i><span
                                                    class="<?php if (!empty($this->cart->contents())) 
                                                    { echo 'badge badge-success';} ?>"><?php if (!empty($this->cart->contents())) { echo count($this->cart->contents());}?></span>
                                            </div>

                                            <div class="shopping-cart-total">
                                                <span class="text-muted">Total:</span>
                                                <span class="main-color-text">BDT
                                                    <?php echo html_escape($this->cart->total()); ?></span>
                                            </div>
                                        </div>
                                        <?php 
                                            $carts = $this->cart->contents();
                                            if ($carts) {
                                                $i = 1;
                                                foreach ($carts as $item) {
                                                    
                                                $picture = $item["picture"];
                                                echo form_hidden($i . '[rowid]', $item['rowid']);
                                            ?>
                                        <div class="media dropdown-course-grid" id="">
                                            <!-- <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. html_escape($item['id'])); ?>"> -->
                                            <img src="<?php echo base_url(html_escape(($picture) ? "$picture" : "application/modules/frontend/views/themes/default/assets/defaul-course.png")); ?>"
                                                width="30%" class="me-3" alt="...">
                                            <!-- </a> -->
                                            <div class="media-body">
                                                <a
                                                    href="<?php echo base_url($enterprise_shortname.'/course-details/'. html_escape($item['id'])); ?>">
                                                    <h5
                                                        class="course-title overflow-hidden font-weight-bold fs-14 mb-1 text-dark">
                                                        <?php echo html_escape($item['name']); ?></h5>
                                                </a>
                                                <div class="course-pricing d-flex align-items-center font-weight-bold">
                                                    <div class="price-original fs-12 text-dark m-sm-1">BDT
                                                        <?php echo html_escape($item['price']); ?></div>
                                                    <div class="price-discount text-danger  fs-12">
                                                        <?php if($item['old_price']){?>
                                                        <del><?php echo html_escape($item['old_price']); ?></del>
                                                        <?php }?>
                                                    </div>
                                                </div>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="cart_delete('<?php echo $i; ?>', '<?php echo html_escape($item['rowid']); ?>')"><i
                                                        class="fas fa-trash-alt"></i></button>
                                                <div class="btn  btn-sm"></div>
                                            </div>
                                        </div>
                                        <?php $i++;}}else{?>
                                        <p class="emptycart_msg emptycart_msg w-75 text-center mx-auto mt-3">Your cart
                                            is empty</p>
                                        <?php }?>
                                    </div>
                                    <div class="dropdown-footer d-block text-center font-weight-600 bg-gray border-top">
                                        <a href="<?php echo base_url($enterprise_shortname.'/cart'); ?>"
                                            class="btn btn-dark-cerulean d-block">Go to cart</a>
                                    </div>
                                </div>
                            </li>
                            <!--student -- dropdown user-->
                            <!-- student notification  -->
                            <li class="nav-item dropdown dmenu dropdown-bell" id="notification_load">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i data-feather="bell" class="navbar-icon"></i>
                                    <?php  $allnotification=$this->db->select("*")->from("notifications_tbl")->where('isNotify',1)->where('student_id',$user_id)->where('enterprise_id',$enterprise_id)->order_by("id", "desc")->limit(10)->get()->result();?>
                                    <span class="badge" id="notify_counter"><?php echo count($allnotification);?></span>
                                </a>
                                <div class="dropdown-menu  dropdown-menu-right sm-menu animate slideIn">

                                    <div class="notifications-scroll" id="notifications">
                                        <div
                                            class="shopping-cart-header d-flex align-items-center justify-content-between">
                                            <div class="position-relative">
                                                <i class="far fa-bell me-1"></i>
                                                <span class="">

                                                </span>
                                            </div>

                                            <div class="shopping-cart-total">
                                                <span class="text-muted">Total Notification:</span>
                                                <span class="main-color-text">
                                                    <?php echo count($allnotification);?></span>
                                            </div>
                                        </div>

                                        <?php 
                                
                                foreach($allnotification as $notificationinfo){
                                    //  print_r($notificationinfo);
                                //course notification 
                                        if($notificationinfo->notification_type==1){
                                        //  course notification 
                                            $course=$this->db->select('a.name,a.course_id,a.course_type,a.description,a.created_date,b.picture')
                                            ->from('course_tbl a')
                                            ->join('picture_tbl b', 'b.from_id = a.course_id', 'left')
                                            ->where('a.course_id',$notificationinfo->notification_id)
                                            ->where('a.enterprise_id',$enterprise_id)
                                            // ->where('a.status',1)
                                            ->get()
                                            ->row();
                                        ?>
                                        <a href="#" class="media dropdown-course-grid" id="read_notificaiton"
                                            data-id="<?php echo ($course?$course->course_id:'');?>">
                                            <input type="hidden" id="typ"
                                                value="1">
                                            <img src="<?php echo base_url(!empty($course->picture) ?$course->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/1.jpg'); ?>"
                                                style="width: 60px;" class="me-3" alt="...">
                                            <div class="media-body">
                                                <h5 class="course-title overflow-hidden font-weight-bold fs-14 mb-1">
                                                    <?php  echo  ($course?$course->name:'');?></h5>
                                                    <div class="course-des fs-12 mb-0"><?php  
                                                    $description=$course->description?$course->description:'';
                                                    echo  $string = word_limiter($description,10);?></div>
                                            </div>
                                        </a>
                               
                                        <?php }elseif($notificationinfo->notification_type==2){
                                        $event=$this->db->select('a.name,a.course_id,a.description,a.created_date,b.picture,a.is_livecourse')
                                        ->from('course_tbl a')
                                    //  ->join('picture_tbl b','b.from_id=a.event_id')
                                        ->join('picture_tbl b', 'b.from_id = a.course_id', 'left')
                                        ->where('a.course_id',$notificationinfo->notification_id)
                                        ->where('a.enterprise_id',$enterprise_id)
                                        // ->where('a.status',1)
                                        ->get()
                                        ->row();
                                        if($event->is_livecourse==1){
                                        ?>
                                            <!-- live course -->
                                             <a href="#" class="media dropdown-course-grid" id="read_notificaiton"
                                                 data-id="<?php echo ($event?$event->course_id:'')?>">
                                                 <input type="hidden" id="typ"
                                                     value="1">
                                                 <img src="<?php echo base_url(!empty($event->picture) ? $event->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/1.jpg'); ?>"
                                                     style="width: 60px;" class="me-3" alt="...">
                                                 <div class="media-body">
                                                     <h5 class="course-title overflow-hidden font-weight-bold fs-14 mb-1">
                                                         <?php echo ($event?$event->name:'');?></h5>
                                                     <div class="course-des fs-12 mb-0">New live class quick enroll this<?php  
                                                     //$description=$event->description?$event->description:'';
                                                 //echo  $string = word_limiter($description,10);?></div>
                                                 </div>
                                             </a>
                                             <?php }elseif($event->is_livecourse==2){?>
                                                  <!-- event -->
    
                                                <a href="#" class="media dropdown-course-grid" id="read_notificaiton"
                                                 data-id="<?php echo ($event?$event->course_id:'')?>">
                                                 <input type="hidden" id="typ"
                                                     value="1">
                                                 <img src="<?php echo base_url(!empty($event->picture) ? $event->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/1.jpg'); ?>"
                                                     style="width: 60px;" class="me-3" alt="...">
                                                 <div class="media-body">
                                                     <h5 class="course-title overflow-hidden font-weight-bold fs-14 mb-1">
                                                         <?php echo ($event?$event->name:'');?></h5>
                                                     <div class="course-des fs-12 mb-0">New live event quick enroll this<?php  
                                                     //$description=$event->description?$event->description:'';
                                                 //echo  $string = word_limiter($description,10);?></div>
                                                 </div>
                                             </a>
                                            <?php }?>
                                    <?php }elseif($notificationinfo->notification_type==3){
                                       if($notificationinfo->isNotify==1){
                                    //  forum notification 
                                        $forum=$this->db->select('a.*,b.picture')
                                        ->from('forum_tbl a')
                                        //  ->join('picture_tbl b','b.from_id=a.forum_id')
                                        ->join('picture_tbl b', 'b.from_id = a.forum_id', 'left')
                                        ->where('a.forum_id',$notificationinfo->notification_id)
                                        ->where('a.enterprise_id',$enterprise_id)
                                        // ->where('a.status',1)
                                        ->get()
                                        ->row();
                                    
                                       ?>
                                        <!-- id="read_notificaiton" data-id="<?php echo $forum->forum_id?>" -->
                                        <a href="<?php //echo base_url($enterprise_shortname.'/forum-details/'.$forum->forum_id); ?>"
                                            class="media dropdown-course-grid" id="read_notificaiton"
                                            data-id="<?php echo ($forum?$forum->forum_id:'');?>">
                                            <input type="hidden" id="typ"
                                                value="1">
                                            <img src="<?php echo base_url(!empty($forum->picture) ? $forum->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/1.jpg'); ?>"
                                                style="width: 60px;" class="me-3" alt="...">
                                            <div class="media-body">
                                                <h5 class="course-title overflow-hidden font-weight-bold fs-14 mb-1">
                                                    <?php echo (!empty($forum->title) ? $forum->title : '');?></h5>
                                                <div class="course-des fs-12 mb-0"><?php  
                                                $description= (!empty($forum->description) ? $forum->description : '');
                                            echo  $string = word_limiter($description,10);?></div>
                                            </div>
                                        </a>
                                        <?php }}elseif($notificationinfo->notification_type==4){
                                            $course=$this->db->select('a.name,a.course_id,a.course_type,a.description,a.created_date,b.picture')
                                            ->from('course_tbl a')
                                            ->join('picture_tbl b', 'b.from_id = a.course_id', 'left')
                                            ->where('a.course_id',$notificationinfo->notification_id)
                                            ->where('a.enterprise_id',$enterprise_id)
                                            // ->where('a.status',1)
                                            ->get()
                                            ->row();
                                            ?>
                                        <a href="#" class="media dropdown-course-grid"
                                            class="media dropdown-course-grid" id="read_notificaiton"
                                            data-id="<?php echo ($course?$course->course_id:'');?>">
                                            <input type="hidden" id="typ"
                                                value="1">
                                            <img src="<?php echo base_url(!empty($course->picture) ?$course->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/1.jpg'); ?>"
                                                style="width: 60px;" class="me-3" alt="...">
                                            <div class="media-body">
                                                <h5 class="course-title overflow-hidden font-weight-bold fs-14 mb-1">
                                                    <?php echo  ($course->name?$course->name:'');?></h5>
                                                <div class="course-des fs-12 mb-0"><?php  
                                                    $description=$course->description?$course->description:'';
                                                echo  $string = word_limiter($description,10);?></div>
                                            </div>
                                        </a>

                                        <?php }elseif($notificationinfo->notification_type==6){
                                            
                                         $project =$this->db->select('*')->from("project_tbl")->where('project_id',$notificationinfo->notification_id)->get()->row();
                                                 if($notificationinfo->type == 1){
                                      ?>
                                                    <a href="#" class="media dropdown-course-grid" id="read_notificaiton" data-id="<?php echo $notificationinfo->notification_id;?>">
                                                        <input type="hidden" id="typ"
                                                            value="6">
                                                        <i class="far fa-bell me-1"></i>
                                                        <div class="media-body">
                                                            <div class="course-des fs-12 fw-bold mb-0">
                                                                Your project <b><?php echo $project->title;?></b>- is approved successfully.
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <?php }elseif($notificationinfo->type == 2){?>
                                                    <a href="#" class="media dropdown-course-grid" id="read_notificaiton" data-id="<?php echo $notificationinfo->notification_id;?>">
                                                        <input type="hidden" id="typ"
                                                            value="6">
                                                        <i class="far fa-bell me-1"></i>
                                                        <div class="media-body">
                                                            <div class="course-des fs-12 fw-bold mb-0">
                                                                Your project <b><?php echo $project->title;?></b>- is rejected and submit again.
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <?php } ?>

                                        <?php }elseif($notificationinfo->notification_type==8){
                                               $course=$this->db->select('a.name,a.course_id,a.course_type,a.description,a.created_date,b.picture')
                                               ->from('course_tbl a')
                                               ->join('picture_tbl b', 'b.from_id = a.course_id', 'left')
                                               ->where('a.course_id',$notificationinfo->notification_id)
                                               ->where('a.enterprise_id',$enterprise_id)
                                            //    ->where('a.status',1)
                                               ->get()
                                               ->row();
                                          
                                        ?>
                                        <a href="#" class="media dropdown-course-grid" id="read_notificaiton" data-id="<?php echo ($course?$course->course_id:'')?>">
                                            <input type="hidden" id="typ"
                                                value="1">
                                            <i class="far fa-bell me-1"></i>
                                            <div class="media-body">
                                                <div class="course-des fs-12 fw-bold mb-0">
                                                    <?php echo  ($course?$course->name : '');?>-<?php echo $notificationinfo->message; ?>
                                                </div>
                                            </div>
                                        </a>
                                        <?php }elseif($notificationinfo->notification_type==9){
                                        ?>
                                        <a href="#" class="media dropdown-course-grid" id="read_notificaiton" data-id="<?php echo $notificationinfo->notification_id;?>">
                                            <input type="hidden" id="typ"
                                                value="1">
                                            <i class="far fa-bell me-1"></i>
                                            <div class="media-body">
                                                <div class="course-des fs-12 fw-bold mb-0">
                                                    <?php echo  'Your subscription package has been expired for 5 days left and please update it.';?>-
                                                </div>
                                            </div>
                                        </a>
                                    <?php }}?>
                                    </div>
                                    <div class="dropdown-footer d-block text-center font-weight-600 bg-gray border-top">
                                        <a href="<?php echo base_url($enterprise_shortname .'/student-notification'); ?>"
                                            class="btn btn-dark-cerulean d-block">See
                                            all</a>
                                    </div>
                                </div>
                            </li>
                            <!-- student notification end -->
                            <li class="nav-item dropdown dmenu dropdown-user">
                                <a class="nav-link dropdown-toggle" href="#" id="user" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php $image = (!empty(get_userinfo($user_id)->picture) ? get_userinfo($user_id)->picture : $this->session->userdata('image'));?>
                                    <img class="user-avatar"
                                        src="<?php echo base_url(!empty($image) ? $image : default_image()); ?>" alt="">
                                </a>
                                <div class="dropdown-menu  dropdown-menu-right sm-menu animate slideIn"
                                    aria-labelledby="user" style="background-color:#333;color:#fff;">
                                    <div class="user-holder">
                                        <div class="user-header">
                                            <div class="align-items-center d-flex mb-3">
                                                <img src="<?php echo base_url(!empty($image) ? $image : default_image()); ?>"
                                                    alt="" class="img-user rounded-circle mb-0">
                                                <div class="p_info ms-3">
                                                    <h6 class="mb-2 text-white"><?php echo $this->session->fullname; ?>
                                                    </h6>
                                                    <p class="mb-0">Student
                                                        Account<?php //echo $this->session->email; ?></p>
                                                </div>
                                            </div><!-- img-user -->
                                        </div><!-- user-header -->
                                        <a href="<?php echo base_url($enterprise_shortname.'/student-dashboard'); ?>"
                                            class="dropdown-item"><i class="fas fa-building"></i> Dashboard</a>
                                        <a href="<?php echo base_url($enterprise_shortname. '/student-profile-dashboard'); ?>"
                                            class="dropdown-item"><i class="far fa-user"></i>Profile/CV</a>
                                        <a href="<?php echo base_url($enterprise_shortname. '/student-activity/'); ?>"
                                            class="dropdown-item"><i class="fas fa-hospital"></i>Activity</a>
                                        <a href="<?php echo base_url($enterprise_shortname .'/student-notification'); ?>"
                                            class="dropdown-item"><i class="fas fa-clipboard-list"></i>notifications</a>
                                        <!-- <a href="<?php echo base_url($enterprise_shortname. '/student-settings-affiliation');?>" class="dropdown-item"><i class="fas fa-users"></i>Manage Affiliation</a> -->
                                        <a href="<?php echo base_url($enterprise_shortname . '/comming-soon'); ?>"
                                            class="dropdown-item"><i class="fas fa-users"></i>Manage Affiliation</a>
                                        <a href="<?php echo base_url($enterprise_shortname . '/student-settings-account'); ?>"
                                            class="dropdown-item"><i class="fas fa-cog"></i>Settings</a>
                                        <!-- <a href="<?php echo base_url($enterprise_shortname .'/student-settings-payments'); ?>" class="dropdown-item"><i class="fas fa-dollar-sign"></i>Payments & Payouts</a> -->
                                        <a href="<?php echo base_url($enterprise_shortname . '/comming-soon'); ?>"
                                            class="dropdown-item"><i class="fas fa-dollar-sign"></i>Payments &
                                            Payouts</a>
                                        <a href="<?php echo base_url($enterprise_shortname . '/logout'); ?>"
                                            class="dropdown-item"><i class="typcn typcn-key-outline"></i> Sign Out</a>
                                        <!-- // #8a8a8a -->
                                    </div>
                                </div>
                            </li>

                            <!-- start instructor menu  -->

                            <?php }elseif($session_id && $user_type == 5){
                              $ge_mycourses = $this->Frontend_model->mycourse($user_id);
                            ?>
                            <?php 
                           $instructor= $this->uri->segment(2);
                          // if (strpos($instructor, 'instructor') !== false) {
                           ?>
                            <!-- instructor course upload link  -->
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="<?php echo base_url($enterprise_shortname . '/instructor-course-add'); ?>"
                                    role="button">
                                    <i data-feather="upload" class="navbar-icon"></i>
                                </a>
                            </li>
                            <!-- instructor notification  -->
                            <?php  $allnotification=$this->db->select("*")->from("notifications_tbl")->where('isNotify',1)->where('student_id',$user_id)->where('enterprise_id',$enterprise_id)->order_by("id", "desc")->limit(10)->get()->result();
                                ?>
                            <li class="nav-item dropdown dmenu dropdown-bell">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i data-feather="bell" class="navbar-icon"></i>
                                    <span class="badge" id="notify_counter"><?php echo count($allnotification);?></span>
                                </a>
                                <div class="dropdown-menu  dropdown-menu-right sm-menu animate slideIn">
                                    <div class="notifications-scroll" id="notifications">
                                        <!-- <h6 class="p-1 text-center">Notifications</h6> -->
                                        <div class="shopping-cart-header d-flex align-items-center justify-content-between">
                                            <div class="position-relative">
                                                <i class="far fa-bell me-1"></i>
                                                <span class="">

                                                </span>
                                            </div>
                                            <div class="shopping-cart-total">
                                                <span class="text-muted">Total Notification:</span>
                                                <span class="main-color-text">
                                                <?php echo count($allnotification);?></span>
                                            </div>
                                        </div>
                                        <?php 
                                        foreach($allnotification as $notificationinfo){
                                           //course notification 
                                           if($notificationinfo->notification_type==1){
                                             $course=$this->db->select('a.published_by,a.name,a.course_id,a.course_type,a.description,a.created_date,b.picture,a.status')
                                            ->from('course_tbl a')
                                            ->join('picture_tbl b', 'b.from_id = a.course_id', 'left')
                                            ->where('a.course_id',$notificationinfo->notification_id)
                                            ->where('a.enterprise_id',$enterprise_id)
                                            ->get()
                                            ->row();
                                            ?>
                                            <input type="hidden" id="instructor" value="instructor">
                                            <?php 
                                             if($notificationinfo->type ==1){ 
                                            ?>
                                        <!-- <a href="<?php //echo base_url($enterprise_shortname.'/course-details/'.$course->course_id); ?>"
                                            class="media dropdown-course-grid" class="media dropdown-course-grid"
                                            id="read_notificaiton" data-id="<?php //echo $course->course_id?>">
                                            <input type="hidden" id="cotyp"
                                                value="<?php //echo $notificationinfo->notification_type; ?>">
                                            <img src="<?php //echo base_url(!empty($course->picture) ? $course->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/1.jpg'); ?>"
                                                width="25%" class="me-3" alt="...">
                                            <div class="media-body">
                                                <h5 class="course-title overflow-hidden font-weight-bold fs-14 mb-1">
                                                    <?php //echo $course->name?$course->name:'';?></h5>
                                                <div class="course-des fs-12 mb-0"><?php  
                                                //$description=$course->description?$course->description:'';
                                           // echo  $string = word_limiter($description,10);?></div>
                                            </div>
                                        </a> -->

                                        <a href="#" class="media dropdown-course-grid"
                                            class="media dropdown-course-grid" id="read_notificaiton" data-id="<?php echo $course->course_id;?>">
                                            <input type="hidden" id="typ"
                                                value="1">
                                            <i class="far fa-bell me-1"></i>
                                            <div class="media-body">
                                                <div class="course-des fs-12 fw-bold mb-0">
                                                <b><?php echo  (!empty($course->name) ? $course->name : '');?></b>
                                                </div>
                                                <div class="course-des fs-12 fw-bold mb-0">
                                               - Your course has been published successfully <b><?php  echo get_userinfo($course->published_by)->name; ?>.</b>
                                                </div>
                                            </div>
                                        </a>
                                         
                                          <?php }elseif($notificationinfo->type==2){?>
                                            
                                                <a href="#" class="media dropdown-course-grid"
                                                    class="media dropdown-course-grid" id="read_notificaiton" data-id="<?php echo $course->course_id;?>">
                                                    <input type="hidden" id="typ"
                                                        value="1">
                                                    <i class="far fa-bell me-1"></i>
                                                    <div class="media-body">
                                                        <div class="course-des fs-12 fw-bold mb-0">
                                                        <b><?php echo  (!empty($course->name) ? $course->name : '');?></b>
                                                        </div>
                                                        <div class="course-des fs-12 fw-bold mb-0">
                                                    -  Your course has been cancelled by <b><?php  echo get_userinfo($course->published_by)->name; ?>.</b>
                                                        </div>
                                                    </div>
                                                </a>
                                          <?php }?>

                                        <?php }elseif($notificationinfo->notification_type==2){
                                         $event=$this->db->select('a.name,a.course_id,a.description,a.created_date,b.picture,a.is_livecourse')
                                         ->from('course_tbl a')
                                     //  ->join('picture_tbl b','b.from_id=a.event_id')
                                         ->join('picture_tbl b', 'b.from_id = a.course_id', 'left')
                                         ->where('a.course_id',$notificationinfo->notification_id)
                                         ->where('a.enterprise_id',$enterprise_id)
                                         // ->where('a.status',1)
                                         ->get()
                                         ->row();
                                         if($event->is_livecourse==1){
                                        ?>
                                        <!-- live course -->
                                         <a href="#" class="media dropdown-course-grid" id="read_notificaiton"
                                             data-id="<?php echo ($event?$event->course_id:'')?>">
                                             <input type="hidden" id="typ"
                                                 value="1">
                                             <img src="<?php echo base_url(!empty($event->picture) ? $event->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/1.jpg'); ?>"
                                                 style="width: 60px;" class="me-3" alt="...">
                                             <div class="media-body">
                                                 <h5 class="course-title overflow-hidden font-weight-bold fs-14 mb-1">
                                                     <?php echo ($event?$event->name:'');?></h5>
                                                 <div class="course-des fs-12 mb-0">New live class quick enroll this<?php  
                                                 //$description=$event->description?$event->description:'';
                                             //echo  $string = word_limiter($description,10);?></div>
                                             </div>
                                         </a>
                                         <?php }elseif($event->is_livecourse==2){?>
                                              <!-- event -->

                                            <a href="#" class="media dropdown-course-grid" id="read_notificaiton"
                                             data-id="<?php echo ($event?$event->course_id:'')?>">
                                             <input type="hidden" id="typ"
                                                value="1">
                                             <img src="<?php echo base_url(!empty($event->picture) ? $event->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/1.jpg'); ?>"
                                                 style="width: 60px;" class="me-3" alt="...">
                                             <div class="media-body">
                                                 <h5 class="course-title overflow-hidden font-weight-bold fs-14 mb-1">
                                                     <?php echo ($event?$event->name:'');?></h5>
                                                 <div class="course-des fs-12 mb-0">New live event quick enroll this<?php  
                                                 //$description=$event->description?$event->description:'';
                                             //echo  $string = word_limiter($description,10);?></div>
                                             </div>
                                         </a>
                                        <?php }?>
                             

                                        <?php }}?>
                                    </div>
                                    <div class="dropdown-footer d-block text-center font-weight-600 bg-gray border-top">
                                        <a href="<?php echo base_url($enterprise_shortname .'/instructor-notifications'); ?>"
                                            class="btn btn-dark-cerulean d-block">See all</a>
                                    </div>
                                </div>
                            </li>
                            <?php //}else{?>
                            <!-- instructor course list no need -->
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
                            <!-- instructor wishlist no need-->
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
                                                <div class="btn btn-dark-cerulean btn-sm">Add to cart</div>
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
                            <?php //}?>
                            <!--instructor dropdown user-->
                            <li class="nav-item dropdown dmenu dropdown-user" id="cardbody">
                                <a class="nav-link dropdown-toggle" href="#" id="user" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="user-avatar"
                                        src="<?php echo base_url(!empty($profile_pic) ? $profile_pic : default_image()); ?>"
                                        alt="">
                                </a>
                                <div class="dropdown-menu  dropdown-menu-right sm-menu animate slideIn"
                                    aria-labelledby="user">
                                    <div class="user-holder" style="background: #333;">
                                        <div class="align-items-center d-flex mb-3">
                                            <div class="img-user mb-0 me-3">
                                                <img src="<?php echo base_url(!empty($profile_pic) ? $profile_pic : default_image()); ?>"
                                                    class="img-user rounded-circle mb-0" alt="">
                                            </div><!-- img-user -->
                                            <div class="d-block ">
                                                <h6 class="mb-2 text-white"><?php echo $this->session->fullname; ?></h6>
                                                <p class="text-white mb-0">
                                                    <?php //echo $this->session->designation?>Instructor Account</p>
                                            </div>
                                        </div><!-- user-header -->
                                        <a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-dashboard'); ?>"
                                            class="dropdown-item"><i
                                                class="typcn typcn-home-outline fs_18"></i>Dashboard</a>
                                        <a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-profile'); ?>"
                                            class="dropdown-item"><i class="far fa-user-circle fs_18"></i>Profile/CV</a>
                                        <a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-courses'); ?>"
                                            class="dropdown-item"><i class="far fa-file-alt fs_18"></i>My Courses</a>
                                        <a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-activities'); ?>"
                                            class="dropdown-item"><i class="fas fa-book-reader fs_18"></i>Activity</a>
                                        <a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-earnings'); ?>"
                                            class="dropdown-item"><i
                                                class="fas fa-hand-holding-usd fs_18"></i>Earning</a>
                                        <a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-notifications'); ?>"
                                            class="dropdown-item"><i class="far fa-bell fs_18"></i>Notifications</a>
                                        <a href="<?php echo base_url($enterprise_shortname . '/comming-soon'); ?>"
                                            class="dropdown-item"><i class="fas fa-percentage fs_17"></i>Manage
                                            Coupons</a>
                                        <a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-affiliation-settings'); ?>"
                                            class="dropdown-item"><i
                                                class="typcn icon typcn-group-outline"></i>Affiliate/Refer</a>
                                        <!-- <a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-payment-setting'); ?>" class="dropdown-item"><i class="fas fa-dollar-sign fs_18"></i>Payments &amp; Payouts</a> -->
                                        <a href="<?php echo base_url($enterprise_shortname . '/comming-soon'); ?>"
                                            class="dropdown-item"><i class="fas fa-dollar-sign fs_18"></i>Payments &amp;
                                            Payouts</a>
                                        <a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-account-settings'); ?>"
                                            class="dropdown-item"><i class="typcn typcn-cog-outline"></i>Settings</a>
                                        <a href="<?php echo base_url($enterprise_shortname . '/logout'); ?>"
                                            class="dropdown-item"><i class="typcn typcn-key-outline"></i>Sign Out</a>
                                    </div>
                                </div>
                            </li>
                            <!-- end instructor menu  -->
                            <?php }else { ?>
                            <div class="card_add"></div>
                            <li class="nav-item dropdown dmenu dropdown-cart" id="cardbody">
                                <a class="nav-link dropdown-toggle" href="#" id="cart" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i data-feather="shopping-cart" class="navbar-icon"></i>
                                    <span
                                        class="badge"><?php if (!empty($this->cart->contents())) { echo count($this->cart->contents());}else{ echo "0";}?></span>
                                </a>
                                <div class="dropdown-menu  dropdown-menu-right sm-menu animate slideIn"
                                    aria-labelledby="cart">
                                    <div class="notifications-scroll">
                                        <div
                                            class="shopping-cart-header d-flex align-items-center justify-content-between">
                                            <div class="position-relative">
                                                <i data-feather="shopping-cart"></i><span
                                                    class="<?php if (!empty($this->cart->contents())) 
                                                    { echo 'badge badge-success';} ?>"><?php if (!empty($this->cart->contents())) { echo count($this->cart->contents());}?></span>
                                            </div>

                                            <div class="shopping-cart-total">
                                                <span class="text-muted">Total:</span>
                                                <span class="main-color-text">BDT
                                                    <?php echo html_escape($this->cart->total()); ?></span>
                                            </div>
                                        </div>
                                        <?php 
                                            $carts = $this->cart->contents();
                                            if ($carts) {
                                                $i = 1;
                                                foreach ($carts as $item) {
                                                    
                                                $picture = $item["picture"];
                                                echo form_hidden($i . '[rowid]', $item['rowid']);
                                            ?>
                                        <div class="media dropdown-course-grid" id="">
                                            <!-- <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. html_escape($item['id'])); ?>"> -->
                                            <img src="<?php echo base_url(html_escape(($picture) ? "$picture" : "application/modules/frontend/views/themes/default/assets/defaul-course.png")); ?>"
                                                width="30%" class="me-3" alt="...">
                                            <!-- </a> -->
                                            <div class="media-body">
                                                <a
                                                    href="<?php echo base_url($enterprise_shortname.'/course-details/'. html_escape($item['id'])); ?>">
                                                    <h5
                                                        class="course-title overflow-hidden font-weight-bold fs-14 mb-1 text-dark">
                                                        <?php echo html_escape($item['name']); ?></h5>
                                                </a>
                                                <div class="course-pricing d-flex align-items-center font-weight-bold">
                                                    <div class="price-original fs-12 text-dark m-sm-1">BDT
                                                        <?php echo html_escape($item['price']); ?></div>
                                                    <div class="price-discount text-danger  fs-12">
                                                        <?php if($item['old_price']){?>
                                                        <del><?php echo html_escape($item['old_price']); ?></del>
                                                        <?php }?>
                                                    </div>
                                                </div>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="cart_delete('<?php echo $i; ?>', '<?php echo html_escape($item['rowid']); ?>')"><i
                                                        class="fas fa-trash-alt"></i></button>
                                                <div class="btn  btn-sm"></div>
                                            </div>
                                        </div>
                                        <?php $i++;}}else{?>
                                        <p class="emptycart_msg emptycart_msg w-75 text-center mx-auto mt-3">Your cart
                                            is empty</p>
                                        <?php }?>
                                    </div>
                                    <div class="dropdown-footer d-block text-center font-weight-600 bg-gray border-top">
                                        <a href="<?php echo base_url($enterprise_shortname.'/cart'); ?>"
                                            class="btn btn-dark-cerulean d-block">Go to cart</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item d-none d-md-block m-1">
                                <a class="border btn fw-bold me-2 text-uppercase text-white"
                                    href="<?php echo base_url($enterprise_shortname . '/signin'); ?>"><i
                                        class="fas fa-sign-in-alt me-2"></i><?php echo display('sign_in'); ?></a>
                            </li>
                            <!-- <li class="nav-item d-none d-md-block"> -->
                            <!-- <a class="nav-link" href="<?php echo base_url($enterprise_shortname . '/enterprise-signup'); ?>"><?php echo display('for_enterprise'); ?></a> -->
                            <!-- </li> -->
                            <!-- <li class="nav-item d-none d-md-block"> -->
                            <!-- <a class="nav-link" href="<?php echo base_url($enterprise_shortname . '/ins-signup'); ?>"><?php echo display('for_instructor'); ?></a> -->
                            <!-- <a class="nav-link" href="https://soft11.bdtask.com/leadacademy-design/instructor-dashboard.html"><?php echo display('for_instructor'); ?></a> -->
                            <!-- </li> -->
                            <li class="nav-item ml-md-3">
                                <a href="<?php echo base_url($enterprise_shortname . '/student-signup'); ?>"
                                    class="btn-join bg-white btn fw-bold text-dark-cerulean text-uppercase "><i
                                        class="far fa-edit me-2"></i>join lead
                                    academy<?php ///echo display('join_for_free'); ?></a>
                            </li>

                            <?php }?>
                        </ul>
                    </div>
                </nav>
                <?php          
            $student= $this->uri->segment(2);
             if (strpos($student, 'student') !== false 
             || strpos($student, 'signin') !== false 
             || strpos($student, 'ins-signup') !== false 
             || strpos($student, 'category-course') !== false 
             ||  strpos($student, 'typeahead-search') !== false 
             || strpos($student, 'course-details') !== false
             || strpos($student, 'instructor') !== false 
             || strpos($student, 'blog') !== false
             || strpos($student, 'forum-details') !== false
             || strpos($student, 'forum-category-page') !== false
             || strpos($student, 'contact') !== false
             || strpos($student, 'cart') !== false
             || strpos($student, 'checkout') !== false
             || strpos($student, 'about') !== false
             || strpos($student, 'terms-condition') !== false
             || strpos($student, 'privacy-policy') !== false
             || strpos($student, 'refund-policy') !== false
             || strpos($student, 'faq-page') !== false
             || strpos($student, 'subscription-details') !== false
             || strpos($student, 'project-list') !== false
             || strpos($student, 'comming-soon') !== false
             || strpos($student, 'allcourse') !== false
             || strpos($student, 'project-view') !== false
             || strpos($student, 'eventlist') !== false
             || strpos($student, 'show-quizform') !== false
             || strpos($student, 'event') !== false
             || strpos($student, 'otp-check') !== false){
            ?>
                <?php  }else{ ?>
           
                <!-- end-0 position-fixed start-0  style="top:70px; z-index:10; background:rgb(7 71 125 / 75%)" -->
                <div class="bg-prussian-blue sticky-nav nav_second  end-0 position-fixed start-0"
                    style="top:70px; z-index:10; background:rgba(14, 33, 64, 75%)">
                    <div class="container-lg">  
                           <?php 
                                // $url = base_url($enterprise_shortname. '/about/');
                                // $my_var = 'foobar';
                                
                                // $temp = explode( '/'  , $url );
                                // $temp[5] = $my_var;
                                // d($temp[5]);
                                // $url = implode( '/' , $temp );
                                // d($url);
                                ?>
                        <ul class="justify-content-between nav text-uppercase fw-semi-bold" id="navbarResponsive">
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="<?php echo base_url((($enterprise_shortname == 'admin') ? '' : $enterprise_shortname). '/about/'); ?>">About</a>
                            </li>
                            <?php //if($user_type==4){?>
                            <!-- <li class="nav-item">
                                <a class="nav-link"
                                    href="<?php echo base_url($enterprise_shortname.'/student-dashboard'); ?>">Learner</a>
                            </li> -->
                            <?php //}else{?>
                            <li class="nav-item">
                                <!-- <a class="nav-link" href="<?php //echo base_url($enterprise_shortname . '/learner-signin'); ?>">Learner</a> -->
                                <a class="nav-link" href="<?php echo base_url($enterprise_shortname . '/learner'); ?>">Learner</a>
                            </li>
                            <?php //}?>
                            <?php //if($user_type==5){?>
                            <!-- <li class="nav-item">
                                <a class="nav-link"
                                    href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-dashboard'); ?>">Instructor</a>
                            </li> -->
                            <?php //}else{?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo base_url($enterprise_shortname . '/ins'); ?>">Instructor</a>
                                 </li>
                            <?php //}?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url($enterprise_shortname . '/comming-soon'); ?>">Enterprise</a>
                            </li>
                            <?php //} ?>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="<?php echo base_url($enterprise_shortname . '/comming-soon'); ?>">Library</a>
                            </li>
                            <li class="nav-item">
                                <!-- <a class="nav-link" href="<?php echo base_url($enterprise_shortname . '/eventlist'); ?>">Event</a> -->
                                <a class="nav-link" href="<?php echo base_url((($enterprise_shortname == 'admin') ? '' : $enterprise_shortname) . '/eventlist'); ?>">Event</a>
                            </li>
                            <li class="nav-item">
                                <!-- <a class="nav-link" href="<?php echo base_url($enterprise_shortname. '/blog/'); ?>">Forum</a> -->
                                <a class="nav-link" href="<?php echo base_url((($enterprise_shortname == 'admin') ? '' : $enterprise_shortname). '/blog/'); ?>">Forum</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="<?php echo base_url($enterprise_shortname. '/project-list/'); ?>">Projects</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- </div> -->
                <?php  } ?>
                <div class="modal m-t-40 " id="modal_info">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h6 class="modal-title modal_ttl"></h6>
                                <!-- <button type="button" class="close" data-bs-dismiss="modal">&times;</button> -->
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body" id="info">

                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
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