<?php 
$user_type = $this->session->userdata('user_type');
?>
<!--Start Student Profile Header-->
<?php if($user_type == 4){ ?>
<?php  $this->load->view('dashboard_coverpage'); ?>
<!--End Student Profile Header-->
<div class="bg-dark-cerulean sticky-nav">
    <div class="container-lg">
        <?php $this->load->view('dashboard_topmenu'); ?>
    </div>
</div>
<?php } ?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb my-3">
                    <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Project</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <?php echo (!empty($get_projectsingledata->title) ? $get_projectsingledata->title : ''); ?></li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<?php if($user_type == 4){ ?>
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-xl-12 d-flex flex-column">
                <!--Start Section Header-->
                <div class="section-header mb-3 mb-sm-0">
                    <a href="<?php echo base_url($enterprise_shortname .'/student-add-project'); ?>"
                        class="btn btn-transparent border py-2">
                        Add New Project
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<div class="bg-alice-blue py-3 pt-md-0 pb-md-5">
    <div class="container-xxl custom-content">
        <div class="row g-3">
            <div class="col-md-8 sticky-content">
                <!--Start card-->
                <div class="card border-0 rounded-0 shadow-sm mb-3">
                    <div class="card-body p-4 p-xl-5">
                        <div class="mb-3">
                            <div class="flex-grow-1 pb-4 border-bottom">
                                <h5 class="text-capitalize mb-1">
                                    <?php echo (!empty($get_projectsingledata->title) ? $get_projectsingledata->title : ''); ?>
                                </h5>
                                <!-- <div class="fw-medium text-muted">By - Halima Begum</div> -->
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex align-items-center mt-2 me-3">
                                            <i class="far fa-eye me-2"></i>
                                            <div class="d-block">
                                                <div>902</div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mt-2">
                                            <i class="far fa-comment me-2"></i>
                                            <div class="d-block">
                                                <div>2</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="d-flex align-items-center">
                                            <button type="button" class="btn btn-dark-cerulean">Edit</button>
                                            <button type="button" class="btn btn-transparent">
                                                <i data-feather="trash"></i>
                                            </button>
                                        </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <img src="<?php echo base_url(!empty($get_projectsingledata->coverpic) ? $get_projectsingledata->coverpic : default_600_400()); ?>"
                                    class="img-fluid" alt="">
                            </div>
                        </div>

                        <?php if($get_singleprojectdetails){
                                foreach($get_singleprojectdetails as $single){
                                ?>
                        <?php if($single->type == 1){ ?>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="mt-3"><?php echo (!empty($single->value) ? $single->value : ''); ?></p>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($single->type == 2){ ?>
                        <div class="row">
                            <div class="col-md-12">
                                <img src="<?php echo base_url(!empty($single->value) ? $single->value : default_600_400()); ?>"
                                    class="img-fluid" alt="">
                            </div>
                        </div>
                        <?php } ?>
                        <?php if($single->type == 3) {
                            $youtubeid =  youtube_id($single->value);
                            // dd($youtubeid);
                            ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="position-relative project_vdo">
                                    <img src="<?php echo youtube_thumbs($youtubeid); //base_url(!empty($get_projectsingledata->coverpic) ? $get_projectsingledata->coverpic : default_600_400()); ?>" style="width: 100%;">
                                    <div class="">
                                        <!--Start Video Icon With Popup Youtube-->
                                        <a class="course-card__hover--content___icon popup-youtube"
                                            href="<?php echo (!empty($single->value) ? $single->value : ''); ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="92" height="92"
                                                viewBox="0 0 92 92">
                                                <g id="Ellipse_2c" data-name="Ellipse 2" fill="none" stroke="#fff"
                                                    stroke-width="3">
                                                    <circle cx="46" cy="46" r="46" stroke="none" />
                                                    <circle cx="46" cy="46" r="44.5" fill="none" />
                                                </g>
                                                <g id="Polygon_1c" data-name="Polygon 1"
                                                    transform="translate(63 32) rotate(90)" fill="none">
                                                    <path d="M14.5,0,29,25H0Z" stroke="none" />
                                                    <path
                                                        d="M 14.5 5.979442596435547 L 5.208076477050781 22 L 23.79192352294922 22 L 14.5 5.979442596435547 M 14.5 0 L 29 25 L 0 25 L 14.5 0 Z"
                                                        stroke="none" fill="#fff" />
                                                </g>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <br>
                        <?php } }?>
                    </div>
                </div>
                <!--End card-->

                <div class="section-header mt-5 mb-4">
                    <h5>2 comments</h5>
                    <div class="section-header_divider"></div>
                </div>

                <div class="card border-0 rounded-0 shadow-sm mb-3">
                    <div class="card-body p-4 p-xl-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="img-user width_55p">
                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/avatar-02.jpg'); ?>"
                                    class="rounded-circle img-fluid" alt="">
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1">Shahabuddin Khan<span
                                        class="bg-dark-cerulean text-white px-3 ms-2 rounded">Instructor</span></h6>
                                <p class="mb-0">5 Days ago</p>
                            </div>
                        </div>
                        <p class="mb-0">It's very awesome and fascinating very much.</p>
                    </div>
                </div>

                <div class="card border-0 rounded-0 shadow-sm mb-3">
                    <div class="card-body p-4 p-xl-5">
                        <div class="d-flex align-items-center mb-4">
                            <div class="img-user width_55p">
                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/avatar-01.jpg'); ?>"
                                    class="rounded-circle img-fluid" alt="">
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1">Halima Khatun<span
                                        class="bg-dark-cerulean text-white px-3 ms-2 rounded">Instructor</span></h6>
                                <p class="mb-0">about 1 year ago</p>
                            </div>
                        </div>
                        <p class="mb-0">It's very awesome and fascinating very much.</p>
                    </div>
                </div>

                <div class="card border-0 rounded-0 shadow-sm mb-3">
                    <div class="card-body p-4 p-xl-5">
                        <div class="section-header mb-4">
                            <h5>Add a comment:</h5>
                            <div class="section-header_divider"></div>
                        </div>
                        <textarea name="" id="commenteditor" cols="30" rows="10"></textarea>
                        <button type="button" class="btn btn-dark-cerulean mt-4" id="commentSubmit">
                            Post a comment
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 sticky-content">
                <!--Start card-->
                <div class="card border-0 rounded-0 shadow-sm mb-4">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <div class="card-body p-4">
                            <!--Start Section Header-->
                            <div class="section-header mb-4">
                                <h5 class="border-bottom pb-3">A Project By</h5>
                            </div>
                            <!--End Section Header-->
                            <div class="text-center mb-4">
                                <div class="avatar-img mb-3 d-inline-block position-relative">
                                    <img src="<?php echo base_url(!empty(get_picturebyid($get_studentinfo->student_id)->picture) ? get_picturebyid($get_studentinfo->student_id)->picture : default_image()); ?>"
                                        alt="">
                                </div>
                                <h5 class="stydent-name">
                                    <a
                                        href="<?php echo base_url($enterprise_shortname.'/student-profile-show/'.$get_studentinfo->student_id); ?>">
                                        <?php echo (!empty($get_studentinfo->name) ? $get_studentinfo->name : ''); ?>
                                </h5>
                                </a>
                                <div>
                                    <?php echo (!empty($get_studentinfo->designation) ? $get_studentinfo->designation : ''); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End card-->
                <!--Start card-->
                <div class="card border-0 rounded-0 shadow-sm mb-4">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <div class="card-body p-4">
                            <div class="section-header mb-4">
                                <div class="section-header mb-4">
                                    <h5>Project Details:</h5>
                                    <div class="section-header_divider"></div>
                                </div>
                                <div class="d-block mb-4">
                                    <p>Published On :
                                        <?php echo date('F Y', strtotime($get_projectsingledata->publishdate)); ?></p>
                                    <!-- <p>Featured : About 1 Year ago</p> -->
                                </div>
                                <div class="section-header mb-4">
                                    <h5>Software:</h5>
                                    <div class="section-header_divider"></div>
                                </div>
                                <?php 
                                $softwares = array();
                                if($get_projectsingledata->software_used){
                                    $softwares = explode(',', $get_projectsingledata->software_used);
                                }
                                ?>
                                <div class="d-block mb-4">
                                    <?php 
                                    if($softwares){
                                        $count=1;
                                    foreach($softwares as $soft){ ?>
                                    <a href="javascript:void(0)"><?php echo $soft; ?></a>
                                    <?php if(count($softwares) > $count){ echo ',';} ?>
                                    <?php 
                                $count++;
                                } } ?>
                                </div>
                                <!--Start Section Header-->
                                <div class="section-header mb-4">
                                    <h5>Tags:</h5>
                                    <div class="section-header_divider"></div>
                                </div>
                                <!--End Section Header-->
                                <?php 
                                $tags = array();
                                if($get_projectsingledata->tags){
                                    $tags = explode(',', $get_projectsingledata->tags);
                                }
                                ?>
                                <!--Start Skills-->
                                <?php 
                                    if($tags){
                                    foreach($tags as $tag){ ?>
                                <span
                                    class="d-inline-block border fs-6 px-2 py-1 rounded me-2 mb-2"><?php echo $tag; ?></span>
                                <?php } } ?>
                                <!--End Skills-->

                                <!--Start Section Header-->
                                <div class="section-header my-4">
                                    <h5>Course Project:</h5>
                                    <div class="section-header_divider"></div>
                                </div>
                                <!--End Section Header-->
                                <!--Start Course Card-->
                                <div
                                    class="course-card rounded-20 bg-white position-relative overflow-hidden shadow-none border  hideClass">
                                    <div class="course-card_top position-relative">
                                        <div class="position-relative">
                                            <!--Start Course Image-->
                                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>"
                                                class="course-card_img">
                                                <img src="<?php echo base_url(!empty($get_projectsingledata->picture)?$get_projectsingledata->picture : default_600_400()); ?>"
                                                    class="img-fluid w-100" alt="">
                                            </a>
                                            <!--End Course Image-->
                                            <!--Start items badge-->
                                            <div
                                                class="align-items-center top-0 d-flex fs-12 position-absolute px-3 py-2 start-0 text-white w-100 z-index-2">
                                                <span class="badge bg-success me-1"><?php
                                      if($get_projectsingledata->is_new==1){ echo "New";}?></span>
                                                <span
                                                    class="badge bg-electric-indigo"><?php echo html_escape($get_projectsingledata->category_name);?></span>
                                                <!-- <i data-feather="bookmark" class="ms-auto"></i> -->
                                            </div>
                                            <!--End items badge-->
                                        </div>
                                        <!--Start Course Card Body-->
                                        <div class="course-card_body bg-prussian-blue text-white p-3 position-relative">
                                            <!--Start Course Title-->
                                            <h3 class="course-card__course--title text-capitalize fs-6 mb-0">
                                                <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>"
                                                    class="text-white text-decoration-none"><?php echo html_escape($get_projectsingledata->course_name);?></a>
                                            </h3>
                                            <!--End Course Title-->
                                            <!--Start Course instructor-->
                                            <div class="course-card__instructor mb-3">
                                                <div
                                                    class="course-card__instructor--name text-white-50 text-uppercase fw-light fs-13">
                                                    by <?php echo html_escape($get_projectsingledata->faculty_name);?>
                                                </div>
                                            </div>
                                            <!--End Course instructor-->
                                            <!--Start Course Hints-->
                                            <table
                                                class="course-card__hints table table-borderless table-sm text-white mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td class="ps-0">
                                                            <div class="d-flex align-items-center">
                                                                <div class="course-card__hints--icon me-2">
                                                                    <svg id="book11" xmlns="http://www.w3.org/2000/svg"
                                                                        width="12.354" height="17.188"
                                                                        viewBox="0 0 12.354 17.188">
                                                                        <path data-name="Path 9"
                                                                            d="M72.537,15.308A.537.537,0,0,1,72,14.771V2.216A2.218,2.218,0,0,1,74.216,0h9.6a.537.537,0,0,1,.537.537V12.891a.537.537,0,1,1-1.074,0V1.074H74.216a1.143,1.143,0,0,0-1.141,1.141V14.771A.537.537,0,0,1,72.537,15.308Z"
                                                                            transform="translate(-72)" fill="#fff" />
                                                                        <path data-name="Path 10"
                                                                            d="M83.817,372.834h-9.4a2.417,2.417,0,1,1,0-4.834h9.4a.537.537,0,1,1,0,1.074h-9.4a1.343,1.343,0,0,0,0,2.686h9.4a.537.537,0,1,1,0,1.074Z"
                                                                            transform="translate(-72 -355.646)"
                                                                            fill="#fff" />
                                                                        <path data-name="Path 11"
                                                                            d="M137.937,425.074h-9.4a.537.537,0,1,1,0-1.074h9.4a.537.537,0,0,1,0,1.074Z"
                                                                            transform="translate(-126.12 -409.766)"
                                                                            fill="#fff" />
                                                                        <path data-name="Path 12"
                                                                            d="M144.537,13.428a.537.537,0,0,1-.537-.537V.537a.537.537,0,1,1,1.074,0V12.891A.537.537,0,0,1,144.537,13.428Z"
                                                                            transform="translate(-141.582)"
                                                                            fill="#fff" />
                                                                    </svg>
                                                                </div>
                                                                <div class="course-card__hints--text">
                                                                    <?php
                                                                    if ($get_projectsingledata->course_level == 1) {
                                                                        echo "Beginner";
                                                                    } elseif ($get_projectsingledata->course_level == 2) {
                                                                        echo "Intermediate";
                                                                    } elseif ($get_projectsingledata->course_level == 3) {
                                                                        echo "Advanced";
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ps-0">
                                                            <div class="d-flex align-items-center">
                                                                <div class="course-card__hints--icon me-2">
                                                                    <svg data-name="clock (1)"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        width="16.706" height="16.706"
                                                                        viewBox="0 0 16.706 16.706">
                                                                        <path data-name="Path 13"
                                                                            d="M8.353,0a8.353,8.353,0,1,0,8.353,8.353A8.363,8.363,0,0,0,8.353,0Zm0,15.662a7.309,7.309,0,1,1,7.309-7.309,7.317,7.317,0,0,1-7.309,7.309Z"
                                                                            fill="#fff" />
                                                                        <path data-name="Path 14"
                                                                            d="M208.838,83.118h-1.044v5.437l3.285,3.285.738-.738-2.979-2.979Z"
                                                                            transform="translate(-199.963 -79.985)"
                                                                            fill="#fff" />
                                                                    </svg>
                                                                </div>
                                                                <div class="course-card__hints--text">
                                                                    <?php 
                                                                $course_wise_lesson = $this->Course_model->course_wise_lesson( $get_projectsingledata->course_id);
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
                                                    
                                                                echo $hours."hr"." ".$minutes."m";?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="ps-0">
                                                            <div class="d-flex align-items-center">
                                                                <div class="course-card__hints--icon me-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        width="17.26" height="14.926"
                                                                        viewBox="0 0 17.26 14.926">
                                                                        <path data-name="Path 148"
                                                                            d="M16.065,17.081H1.2a1.2,1.2,0,0,0-1.2,1.2V28.364a1.2,1.2,0,0,0,1.2,1.2h8.67l-.262,1.6a.69.69,0,0,0,1.041.75l1.871-.985a.393.393,0,0,1,.248,0l1.871.985a.834.834,0,0,0,.388.1.656.656,0,0,0,.387-.123.726.726,0,0,0,.266-.728l-.262-1.6h.651a1.2,1.2,0,0,0,1.2-1.2V18.277A1.2,1.2,0,0,0,16.065,17.081ZM12.64,27.511a2.084,2.084,0,1,1,2.084-2.084A2.086,2.086,0,0,1,12.64,27.511Zm.6,2.5a1.383,1.383,0,0,0-1.2,0l-1.323.7.42-2.565a3.1,3.1,0,0,0,3.007,0l.164,1v.005l.256,1.56Zm2.994-1.651a.173.173,0,0,1-.171.171h-.819l-.187-1.142s0-.009,0-.013a3.108,3.108,0,1,0-4.831,0l0,.013-.187,1.142H1.2a.173.173,0,0,1-.171-.171V18.277a.173.173,0,0,1,.171-.171H16.065a.173.173,0,0,1,.171.171Z"
                                                                            transform="translate(0 -17.081)"
                                                                            fill="#fff" />
                                                                        <path id="Path_149n" data-name="Path 149"
                                                                            d="M43.246,60.243H31.631a.512.512,0,0,0,0,1.025H43.246a.512.512,0,0,0,0-1.025Z"
                                                                            transform="translate(-28.993 -57.295)"
                                                                            fill="#fff" />
                                                                        <path id="Path_150" data-name="Path 150"
                                                                            d="M36.55,100.911H31.631a.512.512,0,0,0,0,1.025H36.55a.512.512,0,0,0,0-1.025Z"
                                                                            transform="translate(-28.993 -95.184)"
                                                                            fill="#fff" />
                                                                    </svg>
                                                                </div>
                                                                <div class="course-card__hints--text">
                                                                    <?php echo html_escape($enterprise_shortname)?>
                                                                    Academy Certified
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--End Course Hints-->
                                            <div
                                                class="align-items-center d-flex fs-12 justify-content-between pt-2 text-white w-100">
                                                <!--Start Star Rating-->
                                                <div class="star-rating__wrap d-flex align-items-center">
                                                    <i class="far fa-star me-2"></i>
                                                    <div class="d-block">
                                                        <div class="reviews">
                                                            <?php echo average_ratings_number($get_projectsingledata->course_id,$enterprise_id);?>/5
                                                        </div>
                                                        <div>Rating</div>
                                                    </div>
                                                </div>
                                                <!--End Star Rating-->
                                                <div class="course-user d-flex align-items-center">
                                                    <i data-feather="thumbs-up" class="me-2"></i>
                                                    <div class="d-block">
                                                        <div class="reviews">
                                                            <?php echo $this->db->where('course_id',$get_projectsingledata->course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl') ?>
                                                        </div>
                                                        <div>Reviews</div>
                                                    </div>
                                                </div>
                                                <div class="course-like d-flex align-items-center">
                                                    <i data-feather="user" class="me-2"></i>
                                                    <div class="d-block">
                                                        <div class="reviews"><?php
                                                        $studentCount = $this->db->where('product_id',$get_projectsingledata->course_id)->get('invoice_details')->num_rows();
                                                        echo  html_escape($studentCount?$studentCount:0);?> </div>
                                                        <div>Students</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--End Course Card Body-->

                                        <!--Start Course Card Hover Content-->
                                        <?php if(!empty($get_projectsingledata->url)){?>
                                        <div class="course-card__hover--content">
                                            <img src="<?php echo base_url(!empty($get_projectsingledata->picture)?$get_projectsingledata->picture : default_600_400()); ?>"
                                                class="course-card__hover--content___img" alt="">
                                            <!--Start Video Icon With Popup Youtube-->
                                            <a class="course-card__hover--content___icon popup-youtube"
                                                href="<?php echo (!empty($get_projectsingledata->url)?$get_projectsingledata->url:'');?>">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="92" height="92"
                                                    viewBox="0 0 92 92">
                                                    <g id="Ellipse_2l" data-name="Ellipse 2" fill="none" stroke="#fff"
                                                        stroke-width="3">
                                                        <circle cx="46" cy="46" r="46" stroke="none" />
                                                        <circle cx="46" cy="46" r="44.5" fill="none" />
                                                    </g>
                                                    <g id="Polygon_1" data-name="Polygon 1"
                                                        transform="translate(63 32) rotate(90)" fill="none">
                                                        <path d="M14.5,0,29,25H0Z" stroke="none" />
                                                        <path
                                                            d="M 14.5 5.979442596435547 L 5.208076477050781 22 L 23.79192352294922 22 L 14.5 5.979442596435547 M 14.5 0 L 29 25 L 0 25 L 14.5 0 Z"
                                                            stroke="none" fill="#fff" />
                                                    </g>
                                                </svg>
                                            </a>
                                            <!--End Video Icon With Popup Youtube-->
                                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>"
                                                class="course-card__hover--content___text position-absolute d-block text-decoration-none text-white text-uppercase">
                                                <?php echo html_escape($get_projectsingledata->course_name);?>
                                            </a>
                                        </div>
                                        <?php }?>
                                        <!--End Card Hover Content-->
                                    </div>
                                    <div class="course-card_footer g-2 p-3">
                                        <?php 
                                        $course_types = json_decode($get_projectsingledata->course_type);
                                        if($course_types){
                                        ?>
                                        <div class="d-block mb-2">
                                            <?php if (in_array("1", $course_types) && in_array("2", $course_types)) {?>
                                            <input type="hidden" class="course"
                                                value="<?php echo $get_projectsingledata->course_id;?>"
                                                id="<?php echo $get_projectsingledata->course_id;?>">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="flexRadioDefault_1<?php echo $get_projectsingledata->course_id;?>"
                                                    id="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>"
                                                    onclick="subscriptionchecedRadio('<?php echo $get_projectsingledata->course_id;?>')">
                                                <label class="form-check-label"
                                                    for="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>">
                                                    Subscription
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="flexRadioDefault_2<?php echo $get_projectsingledata->course_id;?>"
                                                    checked="checked"
                                                    id="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>"
                                                    onclick="coursechecedRadio('<?php echo $get_projectsingledata->course_id;?>')">
                                                <label
                                                    class="form-check-label d-flex justify-content-between align-items-center"
                                                    for="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>">
                                                    <span>Course Price <br><span class="text-success">Bdt
                                                            <?php echo (($get_projectsingledata->is_offer == 1) ? $get_projectsingledata->offer_courseprice : $get_projectsingledata->price); ?></span></span>
                                                    <span class="text-center text-white bg-danger px-2 rounded">
                                                        <?php if(!empty($get_projectsingledata->is_discount==1)){?>
                                                        <span
                                                            class="fs_11 d-block"><?php  echo (($get_projectsingledata->discount) ? $get_projectsingledata->discount :0); ?>
                                                            off</span>
                                                        <del class="text-white fs-12 fw-semi-bold">৳
                                                            <?php echo (($get_projectsingledata->oldprice)?$get_projectsingledata->oldprice :"0"); ?></del>
                                                        <?php }?>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-stretch "
                                                id="course_purchase_<?php echo $get_projectsingledata->course_id?>">
                                                <div class="flex-grow-1 me-1">
                                                    <button type="button" class="btn btn-dark-cerulean w-100">
                                                        <i data-feather="shopping-cart" class="me-1"></i>
                                                        Purchase
                                                    </button>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>"
                                                        class="btn btn-dark-cerulean w-100">
                                                        <i data-feather="info" class="me-1"></i>
                                                        Details
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-stretch "
                                                id="course_subscription_<?php echo $get_projectsingledata->course_id?>">
                                                <div class="flex-grow-1 me-1">
                                                    <button type="button" class="btn btn-dark-cerulean w-100">
                                                        <i data-feather="shopping-cart" class="me-1"></i>
                                                        Subscription
                                                    </button>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <a href="<?php echo base_url($enterprise_shortname.'/subscription-details'); ?>"
                                                        class="btn btn-dark-cerulean w-100">
                                                        <i data-feather="info" class="me-1"></i>
                                                        Details
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
                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>" class="btn btn-dark-cerulean w-100">
                                            <i data-feather="info" class="me-1"></i>
                                            Details
                                        </a>
                                    </div>
                                </div> -->
                                            <?php }elseif(in_array("1", $course_types)){?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="flexRadioDefault_3<?php echo $get_projectsingledata->course_id;?>"
                                                    id="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>"
                                                    onclick="subscriptionchecedRadio('<?php echo $get_projectsingledata->course_id;?>')"
                                                    disabled>
                                                <label class="form-check-label"
                                                    for="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>">
                                                    Subscription
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="flexRadioDefault_3<?php echo $get_projectsingledata->course_id;?>"
                                                    id="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>"
                                                    onclick="coursechecedRadio('<?php echo $get_projectsingledata->course_id;?>')"
                                                    checked>
                                                <label
                                                    class="form-check-label d-flex justify-content-between align-items-center"
                                                    for="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>">
                                                    <span>Course Price <br><span class="text-success">Bdt
                                                            <?php echo (($get_projectsingledata->is_offer == 1) ? $get_projectsingledata->offer_courseprice : $get_projectsingledata->price); ?></span></span>
                                                    <span class="text-center text-white bg-danger px-2 rounded">
                                                        <?php if(!empty($get_projectsingledata->is_discount==1)){?>
                                                        <span
                                                            class="fs_11 d-block"><?php  echo (($get_projectsingledata->discount) ? $get_projectsingledata->discount :0); ?>
                                                            off</span>
                                                        <del class="text-white fs-12 fw-semi-bold">৳
                                                            <?php echo (($get_projectsingledata->oldprice)?$get_projectsingledata->oldprice :"0"); ?></del>
                                                        <?php }?>
                                                    </span>
                                                </label>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-stretch">
                                                <div class="flex-grow-1 me-1">
                                                    <button type="button" class="btn btn-dark-cerulean w-100">
                                                        <i data-feather="shopping-cart" class="me-1"></i>
                                                        Purchase
                                                    </button>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>"
                                                        class="btn btn-dark-cerulean w-100">
                                                        <i data-feather="info" class="me-1"></i>
                                                        Details
                                                    </a>
                                                </div>
                                            </div>
                                            <?php }elseif(in_array("2", $course_types)){?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="flexRadioDefault4_<?php echo $get_projectsingledata->course_id?>"
                                                    id="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>"
                                                    onclick="subscriptionchecedRadio('<?php echo $get_projectsingledata->course_id;?>')"
                                                    checked>
                                                <label class="form-check-label"
                                                    for="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>">
                                                    Subscription
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="flexRadioDefault4_<?php echo $get_projectsingledata->course_id?>"
                                                    id="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>"
                                                    onclick="coursechecedRadio('<?php echo $get_projectsingledata->course_id;?>')"
                                                    disabled>
                                                <label
                                                    class="form-check-label d-flex justify-content-between align-items-center"
                                                    for="flexRadioDefault2">
                                                    <span>Course Price <br><span class="text-success">Bdt
                                                            <?php echo (($get_projectsingledata->is_offer == 1) ? $get_projectsingledata->offer_courseprice : $get_projectsingledata->price); ?></span></span>
                                                    <?php if(!empty($get_projectsingledata->is_discount==1)){?>
                                                    <span
                                                        class="fs_11 d-block"><?php  echo (($get_projectsingledata->discount) ? $get_projectsingledata->discount :0); ?>
                                                        off</span>
                                                    <del class="text-white fs-12 fw-semi-bold">৳
                                                        <?php echo (($get_projectsingledata->oldprice)?$get_projectsingledata->oldprice :"0"); ?></del>
                                                    <?php }?>
                                                </label>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-stretch">
                                                <div class="flex-grow-1 me-1">
                                                    <button type="button" class="btn btn-dark-cerulean w-100">
                                                        <i data-feather="shopping-cart" class="me-1"></i>
                                                        Subscription
                                                    </button>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <a href="<?php echo base_url($enterprise_shortname.'/subscription-details'); ?>"
                                                        class="btn btn-dark-cerulean w-100">
                                                        <i data-feather="info" class="me-1"></i>
                                                        Details
                                                    </a>
                                                </div>
                                            </div>
                                            <?php }elseif(in_array("3", $course_types)){?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault01"
                                                    id="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>"
                                                    onclick="subscriptionchecedRadio('<?php echo $get_projectsingledata->course_id;?>')"
                                                    disabled>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Subscription
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault01"
                                                    id="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>"
                                                    onclick="coursechecedRadio('<?php echo $get_projectsingledata->course_id;?>')"
                                                    disabled>
                                                <label
                                                    class="form-check-label d-flex justify-content-between align-items-center"
                                                    for="flexRadioDefault2">
                                                    <span>Course Price <br>
                                                        <!-- <span class="text-success">Bdt 1500</span></span>
                                        <span class="text-center text-white bg-danger px-2 rounded">
                                            <span class="fs_11 d-block">50% off</span>
                                            <del class="text-white fs-12 fw-semi-bold">৳ 2,000</del>
                                        </span> -->
                                                </label>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-stretch"
                                                style="margin-top:20px">
                                                <div class="flex-grow-1 me-1">
                                                    <button type="button" class="btn btn-dark-cerulean w-100">
                                                        <i data-feather="shopping-cart" class="me-1"></i>
                                                        Enroll Free
                                                    </button>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>"
                                                        class="btn btn-dark-cerulean w-100">
                                                        <i data-feather="info" class="me-1"></i>
                                                        Details
                                                    </a>
                                                </div>
                                            </div>

                                            <?php }elseif(in_array("4", $course_types)){?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault01"
                                                    id="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>"
                                                    onclick="subscriptionchecedRadio('<?php echo $get_projectsingledata->course_id;?>')"
                                                    disabled>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Subscription
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault01"
                                                    id="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>"
                                                    onclick="coursechecedRadio('<?php echo $get_projectsingledata->course_id;?>')"
                                                    disabled>
                                                <label
                                                    class="form-check-label d-flex justify-content-between align-items-center"
                                                    for="flexRadioDefault2">
                                                    <span>Course Price <br>
                                                        <!-- <span class="text-success">Bdt 1500</span></span>
                                        <span class="text-center text-white bg-danger px-2 rounded">
                                            <span class="fs_11 d-block">50% off</span>
                                            <del class="text-white fs-12 fw-semi-bold">৳ 2,000</del>
                                        </span> -->
                                                </label>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-stretch"
                                                style="margin-top:20px">
                                                <div class="flex-grow-1 me-1">
                                                    <button type="button" class="btn btn-dark-cerulean w-100">
                                                        <i data-feather="shopping-cart" class="me-1"></i>
                                                        Govt
                                                    </button>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>"
                                                        class="btn btn-dark-cerulean w-100">
                                                        <i data-feather="info" class="me-1"></i>
                                                        Details
                                                    </a>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            No Allow this type
                                            <?php  } 
                                            }
                                             ?>
                                        </div>

                                    </div>
                                </div>
                                <!--End Course Card-->
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <h5 class="mb-3">Course Project Status</h5>
                                        <div class="alert alert-<?php echo (($get_projectsingledata->project_status == 1) ? 'success' : 'warning'); ?> d-flex align-items-center mb-0"
                                            role="alert">
                                            <div class="d-flex align-items-center justify-content-between w-100">
                                                <span class="fs-6">
                                                    <?php if($get_projectsingledata->project_status == 0){
                                                        echo '<i class="fas fa-info-circle me-2"></i> Project in Review';
                                                        }elseif($get_projectsingledata->project_status == 1){
                                                            echo '<i class="fas fa-check-circle me-2"></i> Congratulations!<br> Project approved';
                                                        }elseif($get_projectsingledata->project_status == 2){
                                                            echo '<i class="far fa-times-circle"></i> Project not approved';
                                                        } ?>
                                                </span>
                                            </div>
                                        </div>
                                        <p class="mt-3">
                                            <?php if($get_projectsingledata->project_status == 2){ 
                                                echo $get_projectsingledata->comment; 
                                            }        
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End card-->
            </div>
        </div>
    </div>
</div>
<script>
// ClassicEditor
//     .create(document.querySelector('#editor'))
//     .catch(error => {
//         console.error(error);
// });

// function postSubmit(){
//     var editor = $("#editor").val();
//     alert(editor);
// }
$(document).ready(function() {
    "use strict";
    let theEditor;

    ClassicEditor.create(document.querySelector("#commenteditor"), {
            toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList'],

        })
        .then((commenteditor) => {
            theEditor = commenteditor;
        })
        .catch((error) => {
            console.error(error);
        });

    function getDataFromTheEditor() {
        return theEditor.getData();
    }

    document.getElementById("commentSubmit").addEventListener("click", () => {
        var enterprise_shortname = $("#enterprise_shortname").val();
        var enterprise_id = $("#enterprise_id").val();
        var user_id = $("#user_id").val();
        var project_id = "<?php echo $get_projectsingledata->project_id?>";
        var comments = getDataFromTheEditor();

        if (comments == "") {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: "slideDown",
                    timeOut: 1500,
                };
                toastr.error("Empty field not allow!");
            }, 1000);
            return false;
        }

        $.ajax({
            url: base_url + enterprise_shortname + "/comment-save",
            type: "POST",
            data: {
                csrf_test_name: CSRF_TOKEN,
                user_id: user_id,
                project_id: project_id,
                enterprise_id: enterprise_id,
                comments: comments,
            },
            success: function(r) {
                theEditor.setData("");
                console.log(r);
                toastr.success(r);
                // getnoteslist();
            },
        });
    });
});
</script>