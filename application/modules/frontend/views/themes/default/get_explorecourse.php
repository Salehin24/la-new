<?php if($get_explorecourse){
 ?>
<?php 
    if($get_explorecourse){
        $s=0;
        foreach($get_explorecourse as $explorecourse){
        ?>
<div class="col-sm-6 col-md-6 col-lg-4 col-xl-3 hideClass" id="<?php echo $explorecourse->id;?>">
    <!--Start Course Card-->
    <div class="course-card course-card-shadow rounded-6 bg-white position-relative overflow-hidden">
        <div class="position-relative overflow-hidden bg-prussian-blue">
            <!--Start Course Image-->
            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $explorecourse->course_id); ?>"
                class="course-card_img">
                <img src="<?php echo base_url(!empty($explorecourse->picture) ? $explorecourse->picture : default_600_400()); ?>"
                    class="img-fluid w-100" alt="">
            </a>
            <!--End Course Image-->
            <div
                class="align-items-center top-0 d-flex fs-12 position-absolute px-3 py-2 start-0 text-white w-100 z-index-2">
                <input type="hidden" value="<?php echo $explorecourse->course_id;?>"
                    id="course_id_<?php echo $explorecourse->course_id;?>">
                <input type="hidden" value="<?php echo $user_id;?>" id="student_id">
                <input type="hidden" value="<?php echo $user_type;?>" id="user_type">

                <?php
                 if($explorecourse->tagstatus==4){?>
                <span class="badge-new  me-1">Most Popular</span>
                <?php   
                 }elseif($explorecourse->tagstatus==3){?>
                <span class="badge-new  me-1">New</span>
                <?php }elseif($explorecourse->tagstatus==1){?>
                <span class="badge-new  me-1">Recomended</span>
                <?php }elseif($explorecourse->tagstatus==2){?>
                <span class="badge-new  me-1">Best Seller</span>
                <?php  }else{?>
                <span class="badge-new  me-1">Govt</span>
                <?php }?>
                <span class="badge-business"><?php echo html_escape($explorecourse->category_name);?></span>
                <span id="savecourse<?php echo $explorecourse->course_id; ?>" class="ms-auto">
                    <?php
                    $coursesaved_checked = $this->Frontend_model->coursesaved_checked($user_id,$explorecourse->course_id);
                    if (!$coursesaved_checked){
                        if ($user_type == 4) {?>
                    <img onclick="get_coursesaveloop(1, '<?php echo $explorecourse->course_id; ?>')"
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
                    <img onclick="get_coursesaveloop(0, '<?php echo $explorecourse->course_id; ?>')"
                        src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-2.png'); ?>"
                        class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                    <?php }?>
                </span>
            </div>
            <?php if(!empty($explorecourse->is_discount==1)){ ?>
            <span class="px-0 badge m-3  position-absolute start-0 text-white  z-index-2 polygon-shape" style="top:25px">
                <span class="d-block fs-13 mb-1">Off</span>
                <span class="fs-15 fw-bold"><?php  echo (($explorecourse->discount) ? $explorecourse->discount :''); ?><?php if($explorecourse->discount_type==2){ echo "%";}else{ echo " ";}?></span>
            </span>
            <?php }?>
            <!--Start Course Card Body-->
            <div class="bg-prussian-blue course-card_body course_middle px-3 py-2 text-white py-12">
                <!--Start Course Title-->
                <h3 class="course-card__course--title  mb-0 text-capitalize">
                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $explorecourse->course_id); ?>"
                        class="text-decoration-none text-white"><?php  echo (!empty($explorecourse->name) ? $explorecourse->name : ''); ?></a>
                </h3>
                <!--End Course Title-->
                <div class="course-card__instructor d-flex align-items-center">
                    <div class="course-card__instructor--name my-2">
                        <a class="text-capitalize instructor-name" href="<?php echo base_url($enterprise_shortname.'/instructor-profile-show/'.$explorecourse->faculty_id); ?>">
                        <?php echo (!empty($explorecourse->instructor_name) ? $explorecourse->instructor_name : ''); ?></a>
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
                                            if (@$explorecourse->course_level == 1) {?>
                                        <div class="d-flex align-items-center">
                                            <div class="bar-custom me-2">
                                                <span class="fill"></span>
                                                <span></span>
                                                <span></span>
                                            </div>
                                        </div>
                                        <?php } elseif (@$explorecourse->course_level == 2) {?>
                                        <div class="d-flex align-items-center">
                                            <div class="bar-custom me-2">
                                                <span class="fill"></span>
                                                <span class="fill"></span>
                                                <span></span>
                                            </div>
                                        </div>
                                        <?php } elseif (@$explorecourse->course_level == 3) {?>
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
                                        if($explorecourse->course_level == 1){
                                            
                                            echo "Beginner  Level";
                                        }elseif($explorecourse->course_level == 2){
                                            echo "Intermediate Level";
                                        }elseif($explorecourse->course_level == 3){
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
                                        <svg id="document" xmlns="http://www.w3.org/2000/svg" width="17.26"
                                            height="14.926" viewBox="0 0 17.26 14.926">
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
                                    <?php if($explorecourse->enterprise_name=='Admin'){ echo "Lead Academy";}else{ echo $explorecourse->enterprise_name." "."Academy";}?>
                                        <?php //echo (!empty($explorecourse->enterprise_name) ?$explorecourse->enterprise_name : ''); ?>
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
                                            $course_wise_lesson = $this->Course_model->course_wise_lesson( $explorecourse->course_id);
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
                <div class="align-items-center d-flex fs-12 justify-content-between pt-1 text-white w-100">
                    <div class="d-flex align-items-center">
                        <div class="course-card__hints--icon me-3">
                            <svg id="clock_1_" data-name="clock (1)" xmlns="http://www.w3.org/2000/svg" width="16.706"
                                height="16.706" viewBox="0 0 16.706 16.706">
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
                                    $course_wise_lesson = $this->Course_model->course_wise_lesson( $explorecourse->course_id);
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
                                        // echo "14 hrs 33 min" ; 
                                        echo  ' '.$hours." hrs"." ".$minutes ." min" ;
                                    ?>
                        </div>
                    </div>
                    <div class="course-like d-flex align-items-center">
                        <i class="fas fa-graduation-cap fs-15 me-1 " style="color:#B5C5DB"></i>
                        <div class="d-block">
                            <div class="reviews fs-12 fw-bold text-white"><?php 
                                $studentCount = $this->db->where('product_id', $explorecourse->course_id)->get('invoice_details')->num_rows();
                                    //echo  html_escape($studentCount?$studentCount:0)
                                     echo number_format($studentCount?$studentCount:0); 
                                ?></div>
                        </div>
                    </div>

                    <!--Start Star Rating-->
                    <div class="star-rating__wrap d-flex align-items-center ">
                        <i class="fas fa-star me-1 text-warning" style="color:#B5C5DB"></i>
                        <div class="d-block ">
                            <div class="reviews fs-12 fw-bold text-white">
                                <?php echo average_ratings_number($explorecourse->course_id,$enterprise_id);?></div>
                        </div>
                    </div>
                </div>
                <!--Start Course instructor-->
            </div>
            <!--End Course Card Body-->
            <!--Start Course Card Hover Content-->
            <div class="course-card__hover--content">
                <img src="<?php echo base_url(!empty($explorecourse->hover_thumbnail) ? $explorecourse->hover_thumbnail :default_600_400()); ?>"
                    class="course-card__hover--content___img">
                <!--Start Video Icon With Popup Youtube-->
                <?php if($explorecourse->url){ ?>
                <a class="course-card__hover--content___icon popup-youtube"
                    href="<?php echo (!empty($explorecourse->url)? $explorecourse->url : ''); ?>" autoplay>
                    <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/Playicon.png'); ?>"
                        class="img-fluid" alt="">
                </a>
                <?php } ?>
                <!--End Video Icon With Popup Youtube-->
                
                <h3
                    class="bottom-0 course-card__hover--content___text d-block fs-15 mb-0 position-absolute text-capitalize text-decoration-none text-white">
                    <a href="<?php echo base_url($enterprise_shortname. '/course-details/'. $explorecourse->course_id); ?>"
                        class="text-decoration-none text-white"><?php echo (!empty($explorecourse->name) ? $explorecourse->name : ''); ?></a>
                </h3>
            </div>
        </div>
        <?php 
        $course_types = json_decode($explorecourse->course_type);
        $checked_purchase = $this->db->where('customer_id',$user_id)->where('product_id', $explorecourse->course_id)->where('status',1)->get('invoice_details')->row();
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
                            for="flexRadioDefault2_<?php echo $explorecourse->course_id?>">
                            <span class="course_price_cart">Course Price
                                <span class="text-success">
                                </span>
                            </span>
                            <span class="align-items-center d-flex  rounded text-center">
                                <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                    <?php echo (($explorecourse->is_offer == 1) ? number_format($explorecourse->offer_courseprice) : number_format($explorecourse->price)); ?></span>
                                <?php if(!empty($explorecourse->is_discount==1)){?>
                                <del
                                    class="fs-12 fw-bold text-muted2"><?php echo (($explorecourse->oldprice)?number_format($explorecourse->oldprice) :" "); ?></del>
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
                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $explorecourse->course_id); ?>"
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
                <input type="hidden" class="course" value="<?php echo $explorecourse->course_id;?>"
                    id="<?php echo $explorecourse->course_id;?>">
                <div class="align-items-center d-flex form-check ps-0">
                    <!-- <input class="form-check-input" type="radio" name="flexRadioDefault1_<?php echo $explorecourse->course_id?>" id="flexRadioDefault1_<?php echo $explorecourse->course_id?>"  onclick="subscriptionchecedRadio('<?php echo $explorecourse->course_id;?>')" > -->
                    <input class="me-1" style="width:21px;height:21px" type="radio"
                        name="flexRadioDefault1_<?php echo $explorecourse->course_id?>"
                        id="flexRadioDefault1_<?php echo $explorecourse->course_id?>"
                        onclick="subscriptionchecedRadio('<?php echo $explorecourse->course_id;?>')">
                    <label class="form-check-label fw-bold course_price_cart "
                        for="flexRadioDefault1_<?php echo $explorecourse->course_id?>">
                        Subscription
                    </label>
                </div>
                <div class="form-check d-flex align-items-center ps-0">
                    <input class="me-1" style="width:21px;height:21px" type="radio"
                        name="flexRadioDefault2_<?php echo $explorecourse->course_id?>"
                        id="flexRadioDefault2_<?php echo $explorecourse->course_id?>"
                        onclick="coursechecedRadio('<?php echo $explorecourse->course_id;?>')" checked>
                    <label class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                        style="width:100%;" for="flexRadioDefault2_<?php echo $explorecourse->course_id?>">
                        <span class="course_price_cart">Course Price
                            <span class="text-success">
                            </span>
                        </span>
                        <span class="align-items-center d-flex  rounded text-center">
                            <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                <?php echo (($explorecourse->is_offer == 1) ? number_format($explorecourse->offer_courseprice) : number_format($explorecourse->price)); ?></span>
                            <?php if(!empty($explorecourse->is_discount==1)){?><del
                                class="fs-12 fw-bold text-muted2"><?php echo (($explorecourse->oldprice)?number_format($explorecourse->oldprice) :" "); ?></del><?php }?>

                        </span>
                    </label>
                </div>
                <div class="d-flex justify-content-between align-items-stretch mt-2"
                    id="course_purchase_<?php echo $explorecourse->course_id?>">
                    <div class="flex-grow-1 me-2 w-sub">
                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $explorecourse->course_id); ?>"
                            class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                            <span class="shopping me-1 shopping_icon position-relative">
                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                    style="width: 14px;">
                            </span>
                            <span class="text-center w-100 fw-bold fs-13"> Purchase </span>

                        </a>
                    </div>
                    <div class="flex-grow-1">
                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $explorecourse->course_id); ?>"
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
                    id="course_subscription_<?php echo $explorecourse->course_id?>">
                    <div class="flex-grow-1 me-2 w-sub">
                        <a href="<?php echo base_url($enterprise_shortname.'/subscription-details'); ?>"
                            class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                            <span class="shopping me-1 shopping_icon position-relative">
                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                    style="width: 14px;">
                            </span>
                            <span class="text-center w-100 fw-bold fs-13"> Subscription </span>
                        </a>
                    </div>
                    <div class="flex-grow-1">
                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $explorecourse->course_id); ?>"
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
                                <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $explorecourse->course_id); ?>" class="btn btn-dark-cerulean w-100">
                                    <i data-feather="info" class="me-1"></i>
                                    Details
                                </a>
                            </div>
                        </div> -->
                <?php }elseif(in_array("1", $course_types)){?>
                <div class="align-items-center d-flex form-check ps-0">
                    <input class="me-1" style="width:21px;height:21px" type="radio"
                        name="flexRadioDefault1_<?php echo $explorecourse->course_id?>"
                        id="flexRadioDefault1_<?php echo $explorecourse->course_id?>"
                        onclick="subscriptionchecedRadio('<?php echo $explorecourse->course_id;?>')" disabled>
                    <label class="form-check-label fw-bold opa-half course_price_cart" for="flexRadioDefault1">
                        Subscription
                    </label>
                </div>
                <div class="form-check d-flex align-items-center ps-0">
                    <input class="me-1" style="width:21px;height:21px" type="radio"
                        name="flexRadioDefault2_<?php echo $explorecourse->course_id?>"
                        id="flexRadioDefault2_<?php echo $explorecourse->course_id?>"
                        onclick="coursechecedRadio('<?php echo $explorecourse->course_id;?>')" checked>
                    <label class="align-items-center d-flex form-check-label fw-bold justify-content-between" style="width:100%;"
                        for="flexRadioDefault2_<?php echo $explorecourse->course_id?>">
                        <span class="course_price_cart">Course Price <span class="text-success"></span>
                        </span>
                        <span class="align-items-center d-flex  rounded text-center">
                            <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                <?php echo (($explorecourse->is_offer == 1) ? number_format($explorecourse->offer_courseprice) : number_format($explorecourse->price)); ?></span>
                            <?php if(!empty($explorecourse->is_discount==1)){?> <del
                                class="fs-12 fw-bold text-muted2"><?php echo (($explorecourse->oldprice)?number_format($explorecourse->oldprice) :" "); ?></del><?php }?>

                        </span>

                    </label>
                </div>
                <div class="d-flex justify-content-between align-items-stretch mt-2">
                    <div class="flex-grow-1 me-2 w-sub">
                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $explorecourse->course_id); ?>"
                            class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                            <span class="shopping me-1 shopping_icon position-relative">
                                <img
                                    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>" style="width: 14px;">
                            </span>
                            <span class="text-center w-100 fw-bold fs-13"> Purchase </span>
                        </a>
                    </div>
                    <div class="flex-grow-1">
                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $explorecourse->course_id); ?>"
                            class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                            <span class="shopping me-1 shopping_icon position-relative">
                                <img class="me-1"
                                    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>" style="width: 14px;">
                            </span>
                            <span class="text-center w-100 fw-bold fs-13">Details</span>
                        </a>
                    </div>
                </div>
                <?php }elseif(in_array("2", $course_types)){?>
                <div class="align-items-center d-flex form-check ps-0">
                    <input class="me-1" style="width:21px;height:21px" type="radio"
                        name="flexRadioDefault1_<?php echo $explorecourse->course_id?>"
                        id="flexRadioDefault1_<?php echo $explorecourse->course_id?>"
                        onclick="subscriptionchecedRadio('<?php echo $explorecourse->course_id;?>')" checked>
                    <label class="form-check-label fw-bold course_price_cart"
                        for="flexRadioDefault1_<?php echo $explorecourse->course_id?>">
                        Subscription
                    </label>
                </div>
                <div class="form-check d-flex align-items-center ps-0 ">
                    <input class="me-1" style="width:21px;height:21px" type="radio"
                        name="flexRadioDefault2_<?php echo $explorecourse->course_id?>"
                        id="flexRadioDefault2_<?php echo $explorecourse->course_id?>"
                        onclick="coursechecedRadio('<?php echo $explorecourse->course_id;?>')" disabled>
                    <label class="align-items-center d-flex form-check-label fw-bold justify-content-between opa-half"
                        style="width: calc(100% - 25px);" for="flexRadioDefault2">
                        <span class="course_price_cart">Course Price <span class="text-success"></span></span>
                    </label>
                </div>
                <div class="d-flex justify-content-between align-items-stretch mt-2">
                    <div class="flex-grow-1 me-2 w-sub">
                        <a href="<?php echo base_url($enterprise_shortname.'/subscription-details'); ?>"
                            class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                            <span class="shopping me-1 shopping_icon position-relative">
                                <img
                                    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>" style="width: 14px;">
                            </span>
                            <span class="text-center w-100 fw-bold fs-13"> Subscription </span>
                        </a>
                    </div>
                    <div class="flex-grow-1">
                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $explorecourse->course_id); ?>"
                            class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                            <span class="shopping me-1 shopping_icon position-relative">
                                <img class="me-1"
                                    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>" style="width: 14px;">
                            </span>
                            <span class="text-center w-100 fw-bold fs-13">Details</span>
                        </a>
                    </div>
                </div>
                <?php }elseif(in_array("3", $course_types)){?>
                <div class="align-items-center d-flex form-check ps-0">
                    <input class="me-1" style="width:21px;height:21px" type="radio"
                        name="flexRadioDefault1_<?php echo $explorecourse->course_id?>"
                        id="flexRadioDefault1_<?php echo $explorecourse->course_id?>"
                        onclick="subscriptionchecedRadio('<?php echo $explorecourse->course_id;?>')" disabled>
                    <label class="form-check-label fw-bold opa-half course_price_cart" for="flexRadioDefault1">
                        Subscription
                    </label>
                </div>
                <div class="align-items-center d-flex form-check ps-0">
                    <input class="me-1" style="width:21px;height:21px" type="radio"
                        name="flexRadioDefault2_<?php echo $explorecourse->course_id?>"
                        id="flexRadioDefault2_<?php echo $explorecourse->course_id?>"
                        onclick="coursechecedRadio('<?php echo $explorecourse->course_id;?>')" disabled>
                    <label class="align-items-center d-flex form-check-label fw-bold justify-content-between opa-half"
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
                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $explorecourse->course_id); ?>"
                            class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                            <span class="shopping me-1 shopping_icon position-relative">
                                <img
                                    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>" style="width: 14px;">
                            </span>
                            <span class="text-center w-100 fw-bold fs-13"> Enroll Free </span>
                        </a>
                    </div>
                    <div class="flex-grow-1">
                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $explorecourse->course_id); ?>"
                            class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                            <span class="shopping me-1 shopping_icon position-relative">
                                <img class="me-1"
                                    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>" style="width: 14px;">
                            </span>
                            <span class="text-center w-100 fw-bold fs-13">Details</span>
                        </a>
                    </div>
                </div>

                <?php }elseif(in_array("4", $course_types)){?>
                <div class="align-items-center d-flex form-check ps-0">
                    <input class="me-1" style="width:21px;height:21px" type="radio"
                        name="flexRadioDefault1_<?php echo $explorecourse->course_id?>"
                        id="flexRadioDefault1_<?php echo $explorecourse->course_id?>"
                        onclick="subscriptionchecedRadio('<?php echo $explorecourse->course_id;?>')" disabled>
                    <label class="form-check-label fw-bold opa-half course_price_cart" for="flexRadioDefault1">
                        Subscription
                    </label>
                </div>
                <div class="align-items-center d-flex form-check ps-0">
                    <input class="me-1" style="width:21px;height:21px" type="radio"
                        name="flexRadioDefault2_<?php echo $explorecourse->course_id?>"
                        id="flexRadioDefault2_<?php echo $explorecourse->course_id?>"
                        onclick="coursechecedRadio('<?php echo $explorecourse->course_id;?>')" disabled>
                    <label class="align-items-center d-flex form-check-label fw-bold justify-content-between opa-half"
                        for="flexRadioDefault2_<?php echo $explorecourse->course_id?>">
                        <span class="course_price_cart">Course Price</span>
                        <span class="bg-danger d-flex px-2 rounded text-center text-white">
                            <!-- Govt -->
                        </span>
                    </label>
                    <span class="badge bg-success me-1 float-end ms-auto"> Govt</span>
                </div>
                <div class="d-flex justify-content-between align-items-stretch mt-2">
                    <div class="flex-grow-1 me-2 w-sub">
                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $explorecourse->course_id); ?>"
                            class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                            <span class="shopping me-1 shopping_icon position-relative">
                                <img
                                    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>" style="width: 14px;">
                            </span>
                            <span class="text-center w-100 fw-bold fs-13"> Govt </span>
                        </a>
                    </div>
                    <div class="flex-grow-1">
                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $explorecourse->course_id); ?>"
                            class="btn btn-dark-cerulean w-100 btn-details fw-bold fs-13">
                            <span class="shopping me-1 shopping_icon position-relative">
                                <img class="me-1"
                                    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/details.png'); ?>" style="width: 14px;">
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
           
        } 
    } 
  ?>
<?php 
//   if($get_explorecourse_count >12){    
?>
<!-- <div class="text-center mt-5 removebuton_<?php echo  $explorecourse->id ;?>">
    <div id="home_course_load<?php echo  $explorecourse->id ;?>">
        <button type="button" onClick="loadmore_data('<?php echo  $explorecourse->id ;?>');"
            class="btn btn-lg btn-dark-cerulean home_course_load " id="<?php echo  $explorecourse->id ;?>">
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
<?php if($type=="dynamic"){?>
    <div class="text-center mt-5 firstbutton">
        <a href="<?php echo base_url($enterprise_shortname . '/category-course/' . html_escape($category_id)); ?>" class="btn btn-lg btn-dark-cerulean">
            Browse more Courses
            <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="28.56" height="15.666"
                viewBox="0 0 28.56 15.666">
                <path id="right-arrow_3_" data-name="right-arrow (3)"
                    d="M20.727,107.5l-1.272,1.272,5.661,5.661H0v1.8H25.116l-5.661,5.661,1.272,1.272,7.833-7.833Z"
                    transform="translate(0 -107.5)" fill="#fff"></path>
            </svg>
        </a>
    </div>
<?php }else{?>
<div class="text-center mt-5 firstbutton">
    <a href="<?php echo base_url($enterprise_shortname. '/allcourse/'); ?>" class="btn btn-lg btn-dark-cerulean">
        Browse more Courses
        <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="28.56" height="15.666"
            viewBox="0 0 28.56 15.666">
            <path id="right-arrow_3_" data-name="right-arrow (3)"
                d="M20.727,107.5l-1.272,1.272,5.661,5.661H0v1.8H25.116l-5.661,5.661,1.272,1.272,7.833-7.833Z"
                transform="translate(0 -107.5)" fill="#fff"></path>
        </svg>
    </a>
</div>
<?php }?>


<!-- <script>
    $('.home_course_load').on("click",function(){
    var ids= $(this).attr("id");
    var course_type= $("#course_type").val();
    alert("Done");
    var category_id= $("#category_id").val();
    var enterprise_shortname= $("#enterprise_shortname").val();
    // $(".load").html('<img src="<?php echo base_url('assets/source.gif');?>" style="width: 40px;"/>');
    $.ajax({
    type: 'POST',
    url: base_url+ enterprise_shortname + "/get-explorecourse-load-more",
    cache:false,
    data: {category_id:category_id,lastid:ids,course_type:course_type,enterprise_shortname:enterprise_shortname,csrf_test_name: CSRF_TOKEN},
        success: function(response){  
        $('#alldata').append(response);
        console.log(response);
        // $(".load").html('<img src="<?php echo base_url('assets/source.gif');?>" style="width: 40px;"/>');
        //remove old load more button
        $('#home_course_load'+ids).remove();
        
        }
    });
    });

//    subscription button hide 
    $( ".hideClass" ).each(function( index ) {
        var p_course_id=$(".course").attr('id');       
      $("#course_subscription_"+p_course_id).hide();
      $('#course_subscription_'+p_course_id).removeClass('d-flex');
    });   

</script> -->

<?php }else{ ?>
<!-- <p class="text-center text-danger"><?php echo display('record_not_found'); ?></p> -->

<div class="row g-3">
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4" id="">
        No more record to load
    </div>
</div>

<?php } ?>