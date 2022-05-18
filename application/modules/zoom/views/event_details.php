<!--Start Course Preview Header-->
<?php 
    // date_default_timezone_set('Asia/Dhaka');
	$user_id = $this->session->userdata('user_id');
   $checkpurchase=$this->db->select('a.*')
        ->from('invoice_details a')
        ->where('a.product_id',$get_eventdetails->course_id)
        ->where('a.customer_id',$user_id)
        ->where('a.enterprise_id',$enterprise_id)
        ->where('is_subscription',4)
        ->get()->row();

        // d($get_eventdetails);
?>
<div class="hero-header text-white position-relative bg-img"
    data-image-src="<?php echo base_url(!empty($get_eventdetails->cover_thumbnail) ? $get_eventdetails->cover_thumbnail : 'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/header-bg-02.jpg'); ?>">
    <div class="container-lg hero-header_wrap position-relative">
        <!--Start Breadcrumb-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb text-uppercase">
                <li class="breadcrumb-item"><a
                        href="<?php echo base_url($enterprise_shortname . '/category-course/' . $get_eventdetails->category_id); ?>"
                        class="text-white"><?php echo (!empty($get_eventdetails->category_name) ? $get_eventdetails->category_name : ''); ?></a>
                </li>
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)"
                        class="text-white"><?php echo (!empty($get_eventdetails->name) ? $get_eventdetails->name : ''); ?></a>
                </li>
            </ol>
        </nav>
        <!--End Breadcrumb-->
        <!--Start Video Icon With Popup Youtube-->
        <!-- <div class="text-center my-3 my-md-5">
				<a class="course-preview__play---icon d-inline-block popup-youtube" href="javascript:void(0)">
					
				</a>
			</div> -->
        <!--End Video Icon With Popup Youtube-->
        <div class="row align-items-end">
            <div class="col">
                <h1 class="fw-semi-bold mb-3">
                    <?php echo (!empty($get_eventdetails->name) ? $get_eventdetails->name : ''); ?></h1>
                <div class="row g-4 align-items-center">
                    <div class="col-auto">
                        <div class="avatar d-flex align-items-center">
                            <div class="avatar-img me-3">
                                <?php
                                $faculty_picture = get_picturebyid($get_eventdetails->faculty_id);
                                ?>
                                <img src="<?php echo base_url(!empty($faculty_picture) ? $faculty_picture->picture : default_image()); ?>"
                                    alt="">
                            </div>
                            <div class="avatar-text">
                                <div class="avatar-designation text-white-50 mb-1 fw-bold"><?php echo display('instructor'); ?>
                                </div>
                                <h5 class="h6 avatar-name mb-0">
                                    <a href="<?php echo base_url($enterprise_shortname.'/instructor-profile-show/'. $get_eventdetails->faculty_id); ?>"
                                        class="text-white ">
                                        <?php echo (!empty($get_eventdetails->faculty_id) ? (get_userinfo($get_eventdetails->faculty_id)->name) : ''); ?>
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
                                if (@$get_eventdetails->course_level == 1) {?>
                                <div class="d-flex align-items-center">
                                    <div class="bar-custom me-2">
                                        <span class="fill"></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <span>Beginner</span>
                                </div>
                                <?php } elseif (@$get_eventdetails->course_level == 2) {?>
                                <div class="d-flex align-items-center">
                                    <div class="bar-custom me-2">
                                        <span class="fill"></span>
                                        <span class="fill"></span>
                                        <span></span>
                                    </div>
                                    <span>Intermediate</span>
                                </div>
                                <?php } elseif (@$get_eventdetails->course_level == 3) {?>
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
                    <!-- <div class="col-auto">
							<div class="">
								<div class="text-white-50 mb-1">Duration</div>
								<div class="d-flex align-items-center">
									<i data-feather="pie-chart" class="course-hints_icon me-1"></i><span>10H 15M</span>
								</div>
							</div>
						</div>
						<div class="col-auto">
							<div class="">
								<div class="text-white-50 mb-1">Rating</div>
								<div class="text-warning">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star-half-alt"></i>
									<i class="far fa-star"></i>
								</div>
							</div>
						</div>
						<div class="col-auto">
							<div>
								<div class="text-white-50 mb-1">Students</div>
								<div class="d-flex align-items-center">
									<i data-feather="eye" class="course-hints_icon me-1"></i><span class="">2,813</span>
								</div>
							</div>
						</div> -->
                </div>
            </div>
            <div class="col-auto">
                <div class="row g-3 justify-content-end align-items-center">
                    <div class="col-sm-auto">
                        <div class="d-md-flex save-share-wrap">
                            <!-- <a href="#" class="text-center">
									<i data-feather="bookmark" class="bookmark-icon"></i>
									<div>Save</div>
								</a> -->
                            <!-- <a href="#" class="text-center ms-md-3">
                                <i data-feather="share-2" class="share-icon"></i>
                                <div>Share</div>
                            </a> -->
                            <a href="javascript:void(0)" target="_blank" title="Facebook Share"
                                class="text-center ms-md-3" data-bs-toggle="modal" data-bs-target="#shareModal">
                                <i data-feather="share-2" class="share-icon"></i>
                                <div>Share</div>
                            </a>
                        </div>
                    </div>


                    <input type="hidden" name="course_id"
                        id="course_id_<?php echo html_escape($get_eventdetails->course_id); ?>"
                        value="<?php echo html_escape($get_eventdetails->course_id); ?>">
                    <input type="hidden" name="course_name"
                        id="course_name_<?php echo html_escape($get_eventdetails->course_id); ?>"
                        value="<?php echo html_escape($get_eventdetails->name); ?>">
                    <input type="hidden" name="slug" id="slug_<?php echo html_escape($get_eventdetails->course_id); ?>"
                        value="<?php echo html_escape($get_eventdetails->slug); ?>">
                    <input type="hidden" name="qty" id="qty" value="1">
                    <input type="hidden" name="price"
                        id="price_<?php echo html_escape($get_eventdetails->course_id); ?>"
                        value="<?php if($get_eventdetails->is_offer == 1){ echo $get_eventdetails->offer_courseprice; }else{ echo $get_eventdetails->price; } ?>">
                    <input type="hidden" name="old_price"
                        id="old_price_<?php echo html_escape($get_eventdetails->course_id); ?>"
                        value="<?php echo html_escape($get_eventdetails->oldprice); ?>">
                    <input type="hidden" name="picture"
                        id="picture_<?php echo html_escape($get_eventdetails->course_id); ?>"
                        value="<?php echo html_escape($get_eventdetails->picture); ?>">
                    <input type="hidden" name="is_course_type" id="iscourse_type" value="4">
                    <?php 
                        if(!$checkpurchase){
                        if($get_eventdetails->is_free !=1) {?>
                    <div class="col-6 col-sm-auto text-center">
                        <div
                            class="price-area d-xl-flex align-items-xl-center justify-content-xl-center text-center text-xl-start">
                            <div class="purchase-price fs-2">
                                <div class="main-price"><sup class="currency-symbol me-1">BDT
                                    </sup><?php echo $get_eventdetails->price;?></div>
                            </div>
                            <div class="product-price ms-2">
                                <del class="prev-price"><span class="hidden position-absolute overflow-hidden">Previous
                                        price</span><?php echo (($get_eventdetails->oldprice != 0) ? $get_eventdetails->oldprice : '' );?></del>
                                <!-- <div class="legal text-danger">Save $100</div> -->
                            </div>
                        </div>
                        <?php
                        if(date('Y-m-d') <= $get_eventdetails->event_date){
                        if(get_usertype() == 4 ){  ?>
                        <button type="button" class="btn btn-light btn-lg fw-medium text-navy-blue w-100"
                            onclick="addtocart('<?php echo html_escape($get_eventdetails->course_id); ?>')">Enroll
                        </button>
                        <?php }else{?>
                        <button type="button" class="btn btn-light btn-lg fw-medium text-navy-blue w-100"
                            onclick="unsingenroll()">Enroll
                        </button>
                        <?php }
                        
                        }?>
                        <!-- <small class="d-block mt-1">get lifetime access of this course </small> -->
                    </div>
                    <?php }else{?>
                    <!-- <div class="col-6 col-sm-auto text-center">
							<div class="price-area d-xl-flex align-items-xl-center justify-content-xl-center text-center text-xl-start">
								<div class="purchase-price fs-2">
									<div class="main-price"><sup class="currency-symbol me-1"></sup><?php //echo $get_eventdetails->price;?></div>
								</div>
								<div class="product-price ms-2">
									<del class="prev-price"><span class="hidden position-absolute overflow-hidden"></span></del>
									<div class="legal text-danger"></div>
								</div>
							</div>
							<button type="button" class="btn btn-light btn-lg fw-medium text-navy-blue w-100">Enroll Free Course</button>
							<small class="d-block mt-1"> </small>
						</div> -->

                    <input type="hidden" id="course_type" value="4">
                    <?php  
                    
                    if(date('Y-m-d') <= $get_eventdetails->event_date){?>
                    <div class="col-6 col-sm-auto text-center">
                        <div class="price-area">
                              <div class="purchase-price fs-16">
                                <div class="main-price">Free Event</div>
                            </div>
                            <div class="product-price ms-2">
                                <del class="prev-price">
                                    <span class="hidden position-absolute overflow-hidden"></span></del>
                            </div>
                        </div>
                        <?php 
                        
                        if(get_usertype() == 4){  ?>
                        <a href="javascript:void(0)"
                            onclick="addtomycourse('<?php echo html_escape($get_eventdetails->course_id); ?>')"
                            class="btn btn-light btn-lg fw-medium text-navy-blue w-100">Enroll Free Course</a>
                        <?php }else{?>
                        <button type="button" class="btn btn-light btn-lg fw-medium text-navy-blue w-100"
                            onclick="unsingenroll()">Enroll
                        </button>
                        <?php }?>
                        <small class="d-block mt-1 text-danger"> </small>

                    </div>
                    <?php }?>

                    <?php }}?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--End Course Preview Header-->
<div class="bg-dark-cerulean sticky-nav" id="secNavbar">
    <div class="container-lg">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="#overview">Overview</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#joinClass">Join Class</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#description">Description</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="#participant">Participant</a>
            </li> -->
        </ul>
    </div>
</div>

<div class="bg-alice-blue pt-5">
    <div class="container-lg">
        <div class="row">
            <div class="col-md-12">
                <!--Start card-->
                <div class="card border-0 rounded-0 shadow-sm mb-3 page-section" id="overview">
                    <div class="card-body p-4 p-xl-5">
                        <h4 class="mb-4"><?php echo (!empty($get_eventdetails->name) ? $get_eventdetails->name : ''); ?>
                        </h4>
                        <?php //d($get_meetingdetails); ?>
                        <div class="mb-2">
                            <div><strong> Start Date:
                                </strong><?php echo date('d M Y', strtotime($get_meetingdetails[0]->start_date)); ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div><strong>End Date:</strong>
                                <?php echo date('d M Y', strtotime($get_meetingdetails[0]->end_date)); ?></div>
                        </div>
                    </div>
                </div>
                <!--End card-->
                <!--Start Card-->
                <div class="card border-0 rounded-0 shadow-sm mb-3 page-section" id="joinClass">
                    <div class="card-body p-4 p-xl-5">
                        <!-- <div class="col-md-12"> -->
                        <div class="table-responsive">
                        <table
                            class="table display  table-bordered table-striped table-hover bg-white m-0 card-table"
                            width="100%">
                            <thead>
                                <tr>
                                    <th width="5%"><?php echo display('sl') ?></th>
                                    <th width="20%"><?php echo display('title') ?></th>
                                    <th width="15%" class="text-center">
                                        <?php echo display('meeting') . ' ' . display('date'); ?></th>
                                    <th width="15%" class="text-center"><?php echo display('start_time') ?></th>
                                    <th width="15%" class="text-center"><?php echo display('end_time') ?></th>
                                    <th width="10%" class="text-center">Participant</th>
                                    <th width="15%" class="text-center"><?php echo display('status') ?></th>
                                    <?php if(get_usertype() == 4){ ?>
                                    <th width="10%" class="text-center"><?php echo display('action') ?></th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // dd($get_meetingdetails);
                                        if ($get_meetingdetails) {
                                            $sl = 0 + $pagenum;
                                            $labelmode = '';
                                            foreach ($get_meetingdetails as $single) {
                                                $meeting_participate = $this->db->where('live_id', $single->id)->count_all_results('meeting_participant_tbl');
                                                $sl++;
                                                ?>
                                <tr>
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo html_escape($single->title); ?></td>
                                    <th class="text-center">
                                        <?php echo html_escape(date('d M Y', strtotime($single->meeting_date))); ?>
                                    </th>
                                    <td class="text-center"><?php echo html_escape($single->start_time); ?></td>
                                    <td class="text-center"><?php echo html_escape($single->end_time); ?></td>
                                    <td class="text-center"><?php echo $meeting_participate; ?></td>
                                    <td class="text-center">
                                        <?php
                                        // echo strtotime($single->meeting_date); echo "<br>";
                                        // echo strtotime(date("Y-m-d")); echo "<br>";
                                        // echo ($single->start_time); echo "<br>";
                                        // echo date('H:i:s', time());echo "<br>";
                                        if (strtotime($single->meeting_date) == strtotime(date("Y-m-d")) && strtotime($single->start_time) <= time() && strtotime($single->end_time) > time()) {
                                                        // if (strtotime($single->meeting_date) == strtotime(date("Y-m-d")) && strtotime($single->start_time) <= time()) {
                                                            $status = '<i class="fas fa-video"></i> ' . display('live');
                                                            $labelmode = 'custom-success-btn';
                                                            $hostbtn = "getJoinModal('$single->meeting_id|$single->id')";
                                                        }elseif (strtotime($single->meeting_date) < strtotime(date("Y-m-d")) || (strtotime($single->meeting_date) <= strtotime(date("Y-m-d")) && strtotime($single->end_time) < time() )) {
                                                            $status = '<i class="far fa-check-square"></i> ' . display('expired');
                                                            $labelmode = 'custom-btn text-white bg-danger border-0';
                                                            $hostbtn = '';
                                                        }else{
                                                            $status = '<i class="far fa-clock"></i> ' . display('waiting');
                                                            $labelmode = 'custom-warning-btn';
                                                            $hostbtn = '';
                                                        }
                                                        echo "<span class='label " . $labelmode . " '>" . $status . "</span>";
                                                        ?>
                                    </td>
                                    <?php if(get_usertype() == 4){?>
                                    <td class="text-center">
                                        <?php 
                                         if (strtotime($single->meeting_date) == strtotime(date("Y-m-d")) && strtotime($single->start_time) <= time() && strtotime($single->end_time) > time()) {
                                            if($checkpurchase){
                                            ?>
                                        <a class="" href="javascript:void(0)" onclick="<?php echo $hostbtn; ?>"
                                            data-toggle="tooltip" data-original-title="Host"><i
                                                class="fas fa-network-wired btn btn-primary btn-sm"> </i> </a>
                                        <?php }else{?>
                                        <a class="" href="javascript:void(0)" onclick="purchasecheck()"><i
                                                class="fas fa-network-wired btn btn-primary btn-sm"> </i> </a>
                                        <?php }?>
                                        <?php }else{ ?>
                                        <!-- <a class="" href="javascript:void(0)" disabled onclick="<?php echo $hostbtn; ?>"
                                            data-toggle="tooltip" data-original-title="Not Host"><i
                                                class="fas fa-network-wired btn btn-secondary btn-sm"> </i> </a> -->

                                        <div data-original-title="Not Host"><i class="fas fa-network-wired"> </i> </div>

                                        <?php } ?>
                                    </td>
                                    <?php } ?>
                                </tr>
                                <?php
                                            }
                                        }
                                        ?>
                            </tbody>
                            <?php if (empty($get_meetingdetails)) { ?>
                            <tfoot>
                                <tr>
                                    <th colspan="8" class="text-center text-danger">
                                        <?php echo display('record_not_found'); ?></th>
                                </tr>
                            </tfoot>
                            <?php } ?>
                        </table>
                        </div>
                        <br>
                        <div class="">
                            <?php echo htmlspecialchars_decode($links); ?>
                        </div>
                        <!-- </div> -->
                    </div>
                </div>
                <!--End card-->
                <!--Start card-->
                <div class="card border-0 rounded-0 shadow-sm mb-3 page-section" id="description">
                    <div class="card-body p-4 p-xl-5">
                        <!--Start Section Header-->
                        <div class="section-header mb-4">
                            <h4 class="h5">Description</h4>
                            <div class="section-header_divider"></div>
                        </div>
                        <!--End Section Header-->
                        <div class="row">
                            <div class="col-sm-12">
                                <?php echo (!empty($get_eventdetails->description) ? $get_eventdetails->description : ''); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End card-->
                <!--Start card-->
                <!-- <div class="card border-0 rounded-0 shadow-sm mb-3 page-section" id="participant">
                    <div class="card-body p-4 p-xl-5">
                        <div class="section-header mb-4">
                            <h4 class="h5">Participant</h4>
                            <div class="section-header_divider"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <?php 
                                //echo (!empty($get_eventdetails->description) ? $get_eventdetails->description : ''); ?>
                            </div>
                        </div>
                    </div>
                </div> -->
                <!--End card-->
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="meeting_modalinfo" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal_title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="meeting_info">

            </div>
        </div>
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
                    <li><a href="https://www.facebook.com/sharer.php?u=<?php echo base_url($enterprise_shortname . '/event-details/' .$get_eventdetails->course_id); ?>"
                            target="_blank" class="d-block text-center me-3 text-muted">
                            <div class="socail-share_icon facebook"><i class="fab fa-facebook-f"></i></div>Facebook
                        </a></li>
                    <li><a href="https://twitter.com/share?text=<?php echo $get_eventdetails->name;?> &url=<?php echo base_url($enterprise_shortname.'/event-details/'.$get_eventdetails->course_id); ?> "
                            target="_blank" class="d-block text-center me-3 text-muted">
                            <div class="socail-share_icon twitter"><i class="fab fa-twitter"></i></div>Twitter
                        </a></li>
                    <li><a href="https://api.whatsapp.com/send?text=[<?php echo $get_eventdetails->name;?>] [<?php echo base_url($enterprise_shortname . '/event-details/' .$get_eventdetails->course_id); ?>]"
                            class="d-block text-center me-3 text-muted" target="_blank" rel="noopener">
                            <div class="socail-share_icon" style="background-color:#37b546;"><i class="fab fa-whatsapp"
                                    style="color:#fff;"></i></div>WhatsApp
                        </a></li>
                    <li>
                    <a href="mailto:?subject=<?php echo $get_eventdetails->name; ?> &body=<?php echo $get_eventdetails->description; ?> PLEASE VISIT THIS LINK:  <?php echo base_url($enterprise_shortname . '/course-details/' .$get_eventdetails->course_id); ?>" class="d-block text-center me-3 text-muted">
                            <div class="socail-share_icon envelope"><i class="far fa-envelope"></i></div>Email
                        </a></li>
                    <li>
                        <a href="https://www.facebook.com/dialog/send?link=<?php echo base_url($enterprise_shortname.'/event-details/'.$get_eventdetails->course_id); ?>&app_id=311161661010577&redirect_uri=<?php echo base_url($enterprise_shortname.'/event-details/'.$get_eventdetails->course_id); ?>"
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


<script src="<?php echo base_url('application/modules/zoom/assets/js/script.js') ?>"></script>
<script>
function unsingenroll() {
    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        // "positionClass": "toast-bottom-center",
        // "preventDuplicates": false,
        // "onclick": null,
        // "showDuration": "300",
        // "hideDuration": "1000",
        // "timeOut": "5000",
        // "extendedTimeOut": "1000",
        // "showEasing": "swing",
        // "hideEasing": "linear",
        // "showMethod": "fadeIn",
        // "hideMethod": "fadeOut"
    }
    toastr.error("Please  login first");
}

function purchasecheck() {
    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
    }
    toastr.error("Please purchase first");
}

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