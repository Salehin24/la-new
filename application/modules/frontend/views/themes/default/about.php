<link
    href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/css/ali.css'); ?>"
    rel="stylesheet">
<style>
<style>.brand2-carousel .owl-item {
    padding: 15px 10px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 5px;
}

.brand2-carousel .owl-item .brand_item {
    display: -webkit-flex;
    display: -moz-flex;
    display: -ms-flex;
    display: -o-flex;
    display: flex;
    height: 100%;
    background: #fff;
    box-shadow: 0 0 15px rgb(0 0 0 / 8%);
    padding: 35px 20px;
    width: 100%;
    align-items: center;
    justify-content: center;
}

.brand2-carousel .owl-item img {
    display: block;
    width: auto;
    max-width: 100%;
}

.brand2-carousel .owl-stage {
    display: -webkit-flex;
    display: -moz-flex;
    display: -ms-flex;
    display: -o-flex;
    display: flex;
}
</style>
<?php //d($get_aboutinfo); 

//$url = 'https://vimeo.com/117275538';
// $url = 'https://www.youtube.com/watch?v=kszbH6cd4ZU&list=PLY55HLLpRZWogMJZOzFRC_X1DSRk7XPp2';


// dd(videoType('https://vimeo.com/117275538'));
// dd(videoType('www.youtube.com/watch?v=kszbH6cd4ZU&list=PLY55HLLpRZWogMJZOzFRC_X1DSRk7XPp2'));
?>
<div class="bg-alice-blue about_lead">
    <div class="container">
        <div class="row justify-content-center">
            <div class="text-center about_lead-inner">
                <h2 class="text-capitalize text-center main_title font_open">About LEAD Academy</h2>
                <p class="fs_18 text-center inner_text">
                    <?php echo (!empty($get_aboutinfo->summary) ? $get_aboutinfo->summary : ''); ?></p>
                <br>

                <div class="iframe_wrapper pt-5">

                    <?php
                    // if(videoType($get_aboutinfo->aboutlink) == 'vimeo'){
                    //     $vimeo_id = vimeo_id($get_aboutinfo->aboutlink);
                        ?>
                    <!-- <iframe id="iframe" src="https://player.vimeo.com/video/<?php //echo $vimeo_id; ?>" width="850"
                        height="500" frameborder="0" allowfullscreen allow="autoplay; encrypted-media"></iframe> -->
                    <?php 
                    // }elseif(videoType($get_aboutinfo->aboutlink) == 'youtube'){ 
                    //     $youtube_id = youtube_id($get_aboutinfo->aboutlink); 
                        ?>
                    <!-- <iframe width="850" height="500" src="https://www.youtube.com/embed/<?php //echo $youtube_id; ?>"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe> -->
                    <?php //} ?>
                          
                            <a style="position: relative;" class="popup-youtube"
                                href="<?php echo (!empty($get_aboutinfo->aboutlink) ? $get_aboutinfo->aboutlink: 'http://www.youtube.com/watch?v=0O2aH4XLbto'); ?>">
                                <img src="<?php echo base_url((!empty($get_sliderdata->picture) ? $get_sliderdata->picture : 'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/header-bg2.jpg')); ?>"
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

<div class="mission py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="mission_inner">
                <h2 class="font_open mb-5 text-center main_title">Mission</h2>
                <p class="fs_18 inner_text text-center">
                    <?php echo (!empty($get_aboutinfo->mission) ? $get_aboutinfo->mission : ''); ?></p>
            </div>
        </div>
    </div>
</div>

<div class="bg-alice-blue py-100 mission">
    <div class="container">
        <div class="row justify-content-center">
            <div class="mission_inner">
                <h2 class="font_open mb-3 text-center main_title">Why choose LEAD Academy</h2>
                <p class="fs_18 inner_text text-center">What makes us unparalleled to any other local online learning
                    platform</p>
            </div>
        </div>

        <div class="row justify-content-center mt-5">
            <div class="choose_wrapper">
                <div class="row g-4">
                    <?php if($get_aboutchoosedata){ 
						foreach($get_aboutchoosedata as $choosedata){
						?>
                    <div class="col-sm-6 col-lg-4 px-22">
                        <div class="choose_inner">
                            <img src="<?php echo base_url(!empty($choosedata->logo) ? $choosedata->logo : 'application/modules/frontend/views/themes/default/assets/img/about/1.png'); ?>"
                                class="img-fluid w-100" alt="">
                            <div class="align-items-center d-flex mt-3 choose_text-wrapper">
                                <h4
                                    class="choose_text d-block mb-0 p-3 text-capitalize text-center text-truncate text-white w-100">
                                    <?php echo (!empty($choosedata->choose_title) ? $choosedata->choose_title : ''); ?>
                                </h4>
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
    </div>
</div>

<div class="service_case">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="mission_inner">
                <h2 class="font_open mb-5 text-center main_title text-uppercase">Our Service</h2>
            </div>
        </div>
        <div class="g-5 justify-content-center row">
            <?php
            // d($get_aboutservicedata);
            if($get_aboutservicedata){
                foreach($get_aboutservicedata as $service){ ?>
            <div class="col-lg-4 col-sm-6 d-flex">
                <div class="sc_inner position-relative shadow">
                    <div
                        class="align-items-center d-flex justify-content-center mx-auto position-absolute sc_top start-50">
                        <div class="d-block">
                            <span class="left position-absolute triangle"></span>
                            <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/service/bg-1.png'); ?>"
                                class="position-absolute start-0 top-0" alt="">
                            <span class="position-absolute triangle right"></span>
                        </div>
                        <span class="font_open fs-15 fw-extra-bold position-relative text-white text-center">
                            <?php echo (!empty($service->service_title) ? $service->service_title : ''); ?>
                        </span>
                    </div>
                    <?php 
                    $service_subtitle = json_decode($service->service_subtitle);
                    // d($service_subtitle);
                    ?>
                    <ul class="sc_list list-unstyled mb-0">
                        <?php if($service_subtitle){ 
                            foreach($service_subtitle as $subtitle){ ?>
                        <li class="position-relative d-flex font_open"><span class="bullet"></span>
                            <span><?php echo (!empty($subtitle) ? $subtitle : '');?></span>
                        </li>
                        <?php } } ?>
                    </ul>
                    <div class="bottom-0 position-absolute sc_img start-50"
                        style="transform: translateX(-50%) translateY(95px)">
                        <img src="<?php echo base_url(!empty($service->service_logo) ? $service->service_logo : ''); ?>"
                            alt="">
                    </div>
                </div>
            </div>
            <?php }
            }
            ?>
            <!-- <div class="col-lg-4 col-sm-6 d-flex">
                <div class="sc_inner position-relative shadow">
                    <div
                        class="align-items-center d-flex justify-content-center mx-auto position-absolute sc_top start-50">
                        <div class="d-block">
                            <span class="left position-absolute triangle"></span>
                            <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/service/bg-2.png'); ?>"
                                class="position-absolute start-0 top-0" alt="">
                            <span class="position-absolute triangle right"></span>
                        </div>
                        <span
                            class="font_open fs-15 fw-extra-bold position-relative text-white text-center">K5-K12</span>
                    </div>
                    <ul class="sc_list list-unstyled mb-0">
                        <li class="position-relative d-flex font_open"><span class="bullet"></span><span>Homework help,
                                STEM </span> </li>
                        <li class="position-relative d-flex font_open"><span class="bullet"></span><span>Govt. endorsed
                                Co-Curricular courses on CODING</span></li>
                    </ul>
                    <div class="bottom-0 position-absolute sc_img start-50"
                        style="transform: translateX(-50%) translateY(95px)">
                        <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/service/2.png'); ?>"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 d-flex">
                <div class="sc_inner position-relative shadow">
                    <div
                        class="align-items-center d-flex justify-content-center mx-auto position-absolute sc_top start-50">
                        <div class="d-block">
                            <span class="left position-absolute triangle green"></span>
                            <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/service/bg-3.png'); ?>"
                                class="position-absolute start-0 top-0" alt="">
                            <span class="position-absolute triangle right green"></span>
                        </div>
                        <span class="font_open fs-15 fw-extra-bold position-relative text-white text-center">FREE
                            COURSES with Govt & NGOs</span>
                    </div>
                    <ul class="sc_list list-unstyled mb-0">
                        <li class="position-relative d-flex font_open"><span class="bullet"></span><span>Social &
                                national interest courses for mass people</span></li>
                    </ul>
                    <div class="bottom-0 position-absolute sc_img start-50"
                        style="transform: translateX(-50%) translateY(95px)">
                        <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/service/3.png'); ?>"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 d-flex">
                <div class="sc_inner position-relative shadow">
                    <div
                        class="align-items-center d-flex justify-content-center mx-auto position-absolute sc_top start-50">
                        <div class="d-block">
                            <span class="left position-absolute triangle"></span>
                            <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/service/bg-3.png'); ?>"
                                class="position-absolute start-0 top-0" alt="">
                            <span class="position-absolute triangle right"></span>
                        </div>
                        <span
                            class="font_open fs-15 fw-extra-bold position-relative text-white text-center">CERTIFIED</span>
                    </div>
                    <ul class="sc_list list-unstyled mb-0">
                        <li class="position-relative d-flex font_open"><span class="bullet"></span><span>Professional
                                degrees & programs</span> </li>
                        <li class="position-relative d-flex font_open"><span class="bullet"></span><span>Diplomas/
                                Specialist Programs</span></li>
                    </ul>
                    <div class="bottom-0 position-absolute sc_img start-50"
                        style="transform: translateX(-50%) translateY(95px)">
                        <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/service/4.png'); ?>"
                            alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 d-flex">
                <div class="sc_inner position-relative shadow">
                    <div
                        class="align-items-center d-flex justify-content-center mx-auto position-absolute sc_top start-50">
                        <div class="d-block">
                            <span class="left position-absolute triangle violet"></span>
                            <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/service/bg-5.png'); ?>"
                                class="position-absolute start-0 top-0" alt="">
                            <span class="position-absolute triangle right violet"></span>
                        </div>
                        <span
                            class="font_open fs-15 fw-extra-bold position-relative text-white text-center">ENTERPRISE</span>
                    </div>
                    <ul class="sc_list list-unstyled mb-0">
                        <li class="position-relative d-flex font_open"><span class="bullet"></span><span>Co-create nano
                                degrees with Industry experts & Academic Partners</span> </li>
                        <li class="position-relative d-flex font_open"><span class="bullet"></span><span>Offer their own
                                courses (white Labelling)</span></li>
                    </ul>
                    <div class="bottom-0 position-absolute sc_img start-50"
                        style="transform: translateX(-50%) translateY(95px)">
                        <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/service/5.png'); ?>"
                            alt="">
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>

<!--Start Brand Logo-->
<div class="brand-logo-content bg-alice-blue py-5">
    <div class="container-lg">
        <div class="text-center mb-5">
            <h3 class="fw-bold mb-0">We collaborate with</h3>
        </div>
        <div class="brand2-carousel owl-carousel owl-theme">
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
            <?php }
        }
        ?>
        </div>
    </div>
</div>
<!--End Brand Logo-->