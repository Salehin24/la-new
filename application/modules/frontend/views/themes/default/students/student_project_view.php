<link
    href="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/css/new.css'); ?>"
    rel="stylesheet">
<?php 
$user_type = $this->session->userdata('user_type');
$user_id = $this->session->userdata('user_id');
// dd($user_id);
    // $get_projectsingledata->projectcount;
    // $ddd=$get_projectsingledata->projectcount+1;

    // $alamin = array(
    //     'projectcount'=>$ddd
    // );

    // $this->db->where('project_id', $get_projectsingledata->project_id);
    // $this->db->update('project_tbl', $alamin);

?>
<!--Start Student Profile Header-->
<?php //if($user_type == 4){ ?>
<?php  $this->load->view('dashboard_coverpage'); ?>
<!--End Student Profile Header-->
<div class="bg-dark-cerulean sticky-nav">
    <div class="container-lg">
        <?php $this->load->view('dashboard_topmenu'); ?>
    </div>
</div>
<?php //} ?>
    <?php //dd($enterprise_shortname); ?>
<div class="bg-alice-blue py-5">
    <div class="container-xxl custom-content">
        <div class="d-flex justify-content-between align-items-center">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a
                            href="<?php echo base_url($enterprise_shortname.'/project-list'); ?>">Project</a></li>
                    <li class="breadcrumb-item" aria-current="page">
                        <?php echo (!empty($get_projectsingledata->title) ? $get_projectsingledata->title : ''); ?></li>
                    <!-- <li class="breadcrumb-item active" aria-current="page">Organize Books In A Library in Alphabetical Order</li> -->
                </ol>
            </nav>

            <?php if($user_type == 4){ ?>
            <a href="<?php echo base_url($enterprise_shortname .'/student-add-project'); ?>"
                class="btn btn-create text-white">
                + Create New Project
            </a>
            <?php } ?>
        </div>
    </div>
</div>

<div class="bg-alice-blue py-3 pt-md-0 pb-md-5">
    <div class="container-xxl custom-content">
        <div class="row g-3">
            <div class="col-md-12">
                <div class="card border-0 rounded-0 shadow-sm">
                    <div class="card-body p-4 p-xl-5">
                        <div class="d-block d-sm-flex">
                            <div class="img-part rounded">
                                <img src="<?php echo base_url(!empty($get_projectsingledata->coverpic) ? $get_projectsingledata->coverpic : default_600_400()); ?>"
                                    class="rounded" alt="" style="width:280px; height:192px">
                            </div>
                            <div class="ms-sm-4 mt-4 mt-sm-0 pb-4">
                                <div class="polyshape mb-3">
                                    <?php
                                     if($get_projectsingledata->project_type == 1){
                                        echo "Course Project";
                                     }elseif($get_projectsingledata->project_type == 2){
                                         echo 'Personal Project';
                                     }elseif($get_projectsingledata->project_type == 4) {
                                         echo 'Client Project';
                                     }
                                    ?>
                                </div>
                                <h5 class="text-capitalize mb-1 title-one font-open">
                                    <?php echo (!empty($get_projectsingledata->title) ? $get_projectsingledata->title : ''); ?>
                                </h5>
                                <div class="subtitle-one my-3">By -
                                    <a class="subtitle-one"
                                        href="<?php echo base_url($enterprise_shortname.'/student-profile-show/'.$get_studentinfo->student_id); ?>">
                                        <?php echo (!empty($get_studentinfo->name) ? $get_studentinfo->name : ''); ?>
                                    </a>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <!-- <div class="align-items-center d-flex font-open fs-13 fw-bold me-3 iconicText">
                                            <i class="far fa-eye me-1"></i>
                                            <div class="d-block">
                                                <div>
                                                    <?php //echo (!empty($projectviewcount->viewcount) ? $projectviewcount->viewcount : 0); ?>
                                                    <?php //echo ($projectviewcount); ?>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="align-items-center d-flex font-open fs-13 fw-bold me-3 iconicText">
                                            <i class="fas fa-thumbs-up me-1"></i>
                                            <div class="d-block">
                                                <div><?php echo (!empty($projectlikecount) ? $projectlikecount : ''); ?></div>
                                            </div>
                                        </div>
                                        <div class="align-items-center d-flex font-open fs-13 fw-bold me-3 iconicText">
                                            <i class="far fa-comment me-1"></i>
                                            <div class="d-block">
                                                <div><?php echo (!empty($projectcommentcount) ? $projectcommentcount : ''); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-4 pb-xl-5 px-4 px-xl-5">
                        <div class="d-block d-md-flex">
                            <div class="d-flex align-items-center">
                                <div class="img-user">
                                    <img src="<?php echo base_url(!empty(get_picturebyid($get_studentinfo->student_id)->picture) ? get_picturebyid($get_studentinfo->student_id)->picture : default_image()); ?>"
                                        class="rounded-circle img-fluid" alt="" style="width:120px; height:120px">
                                </div>
                                <?php //d($get_studentinfo); ?>
                                <div class="ms-4">
                                    <div class="fs-13 fw-bold lh-18 mb-2 text-sky">Project By:</div>
                                    <h6 class="font-open fs-15 fw-bold lh-20 mb-1 text-black">
                                        <a class="subtitle-one"
                                            href="<?php echo base_url($enterprise_shortname.'/student-profile-show/'.$get_studentinfo->student_id); ?>">
                                            <?php echo (!empty($get_studentinfo->name) ? $get_studentinfo->name : ''); ?>
                                        </a>
                                    </h6>
                                    <p class="mb-0">
                                        <?php echo (!empty($get_studentinfo->designation) ? $get_studentinfo->designation : ''); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="d-block skills_part">
                                <div class="font-open fs-13 fw-bold lh-18 text-sky mb-2">Skills &amp; Areas</div>
                                <?php 
                                // dd($get_projectsingledata->skills);
                                $skills = array();
                                if($get_projectsingledata->skills){
                                    $skills = explode(',', $get_projectsingledata->skills);
                                }
                                ?>
                                <div class="font-open fs-13 lh-18 text-black">
                                    <?php 
                                    if($skills){
                                        $count=1;
                                    foreach($skills as $skill){ 
                                         echo $skill; 
                                         if(count($skills) > $count){ 
                                             echo ', ';
                                            } 
                                         $count++;
                                }
                                 } ?>
                                </div>
                                <div class="font-open fs-13 fw-bold lh-18 text-sky mb-2 mt-3">Software / Tools Used
                                </div>
                                <?php 
                                $softwares = array();
                                if($get_projectsingledata->software_used){
                                    $softwares = explode(',', $get_projectsingledata->software_used);
                                }
                                ?>
                                <div class="font-open fs-13 lh-18 text-black">
                                    <?php 
                                    if($softwares){
                                        $count=1;
                                    foreach($softwares as $soft){ 
                                         echo $soft; 
                                         if(count($softwares) > $count){ 
                                             echo ', ';
                                            } 
                                         $count++;
                                }
                                 } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    //  d($get_projectsingledata); 
                    if($get_projectsingledata->project_type == 1){ 
                        if($get_projectsingledata->course_id){
                        ?>
                    <div class="card-body p-4 p-xl-5 bg_blue_pro">
                        <div class="row">
                            <div class="col-md-7 d-block d-lg-flex">
                                <div class="img-part rounded">
                                    <img src="<?php echo base_url(!empty($get_projectsingledata->picture) ? $get_projectsingledata->picture : default_600_400()); ?>"
                                        class="rounded w-100" alt="">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mt-4 mt-lg-0 ms-lg-4 pb-4">
                                    <div class="polyshape mb-3">Course Project </div>
                                    <h5 class="text-capitalize mb-1 title-one font-open">
                                        <?php echo html_escape($get_projectsingledata->name);?></h5>

                                    <?php if($get_projectsingledata->project_status != 4){ ?>
                                    <div class="title-label mb-2 font-open">Course Project Submission Status </div>
                                    <div class="d-block d-md-flex align-items-center">
                                        <div class="alert alert-<?php echo (($get_projectsingledata->project_status == 1) ? 'success' : 'warning'); ?> d-flex align-items-center mb-0"
                                            role="alert">
                                            <div class="d-flex align-items-center justify-content-between w-100">
                                                <span class="fs-6">
                                                    <?php if($get_projectsingledata->project_status == 0){
                                                        echo '<i class="fas fa-info-circle me-2"></i> Project in Review';
                                                        }elseif($get_projectsingledata->project_status == 1){
                                                            echo '<i class="fas fa-check-circle me-2"></i> Congratulations!<br> This course project has been approved';
                                                        }elseif($get_projectsingledata->project_status == 2){
                                                            echo '<i class="far fa-times-circle"></i> Project not approved';
                                                        } ?>
                                                </span>

                                                <p class="mt-2">
                                                    <?php if($get_projectsingledata->project_status == 2){ 
                                                echo $get_projectsingledata->comment; 
                                            }        
                                            ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <div class="subtitle-two my-3">By -
                                        <a class="subtitle-one"
                                            href="<?php echo base_url($enterprise_shortname.'/instructor-profile-show/'.$get_projectsingledata->faculty_id); ?>">
                                            <?php echo html_escape($get_projectsingledata->instructor_name); ?>
                                        </a>
                                    </div>
                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>"
                                        class="btn btn-dark-cerulean w_99 btn-details fw-bold fs-13 px-2">
                                        <span class="shopping me-1 shopping_icon position-relative">
                                            <img class="me-1"
                                                src="https://lead.academy/application/modules/frontend/views/themes/default/assets/img/details.png"
                                                style="width: 14px;">
                                        </span>
                                        <span class="text-center fw-bold fs-13">
                                            Details
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } 
                    } ?>
                    <?php if($get_projectsingledata->project_type == 4){ ?>
                    <div class="card-body p-4 p-xl-5 bg_blue_pro">
                        <div class="d-block d-lg-flex">
                            <div class="mt-4 mt-lg-0 ms-lg-4 pb-4">
                                <div class="polyshape mb-3">Client</div>
                                <h5 class="text-capitalize mb-1 title-one font-open">
                                    <?php echo html_escape($get_projectsingledata->client_name);?></h5>
                                <h4 class="mb-1 title-one font-open mt-3 mb-3">
                                    <?php echo html_escape($get_projectsingledata->clientproject_year);?></h4>

                                <a href="<?php echo html_escape($get_projectsingledata->clientwebsite_url); ?>"
                                    target="_blank" class="w_99 fw-bold fs-13 px-2">
                                    <?php echo html_escape($get_projectsingledata->clientwebsite_url); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($get_projectsingledata->project_type == 2){ ?>
                    <div class="card-body p-4 p-xl-5 bg_blue_pro">
                        <div class="d-block d-lg-flex">
                            <div class="mt-4 mt-lg-0 ms-lg-4 pb-4">
                                <div class="polyshape mb-3">Topic</div>
                                <h5 class="text-capitalize mb-1 title-one font-open">
                                    <?php echo html_escape($get_projectsingledata->project_topic);?></h5>
                                <h4 class="mb-1 title-one font-open mt-3 mb-3">
                                    <?php echo html_escape($get_projectsingledata->personal_projectyear);?></h4>

                                <a href="<?php echo html_escape($get_projectsingledata->personal_websiteurl); ?>"
                                    target="_blank" class="w_99 fw-bold fs-13 px-2">
                                    <?php echo html_escape($get_projectsingledata->personal_websiteurl); ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="card border-0 rounded-0 shadow-sm">
                    <div class="card-body p-4 p-xl-5">
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
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <img src="<?php echo base_url(!empty($single->value) ? $single->value : default_600_400()); ?>"
                                    class="img-fluid" alt="">
                                <!-- <p class="mt-3">Lorem Ipsum is simply dummy text of the printing and typesetting
                                        industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                                        1500s, when an unknown printer took a galley of type and scrambled it to make a type
                                        specimen book.</p> -->
                            </div>
                        </div>
                        <?php } ?>

                        <?php if($single->type == 3) {
                            // $youtubeid =  youtube_id($single->value);
                            // dd($youtubeid);
                            ?>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="position-relative project_vdo">
                                    <?php 
                                      if(videoType($single->value) == 'vimeo'){
                                        $vimeo_id = vimeo_id($single->value);
                                          echo '<iframe id="player1" src="https://player.vimeo.com/video/'.$vimeo_id.'" width="100%" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
                                      }elseif(videoType($single->value) == 'youtube'){ 
                                          $youtubeid =  youtube_id($single->value);
                                          echo '<iframe width="100%" class="me-3" height="400" src="https://www.youtube.com/embed/'.$youtubeid.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                                      }else{
                                         echo 1;
                                      }
                                    
                                    ?>
                                    <!-- <img src="<?php echo youtube_thumbs($youtubeid);?>"
                                        style="width: 100%;">
                                    <div class="">
                                       
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
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php 
                    }
                    } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-alice-blue py-3 pt-md-0 pb-md-5">
    <div class="container-xxl custom-content">
        <div class="row g-3">
            <div class="col-md-12">
                <div class="align-items-center d-flex flex-wrap tags">
                    <h6 class="me-4 mb-0"><i class="fas fa-tag me-2"></i>Tags:</h6>
                    <?php 
                                $tags = array();
                                if($get_projectsingledata->tags){
                                    $tags = explode(',', $get_projectsingledata->tags);
                                }
                                if($tags){
                                    foreach($tags as $tag){
                                ?>
                    <span
                        class="bg-white border d-inline-block fs-6 me-2 my-1 px-3 py-2 rounded shadow-sm">#<?php echo $tag; ?></span>
                    <?php }
                 } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-alice-blue py-3 pt-md-0 pb-md-5">
    <div class="container-xxl custom-content">
        <div class="row g-3">
            <div class="col-md-12">
                <div class="bg-white border-0 py-5 shadow-sm">
                    <div class="mx-0 row">
                        <div class="col-lg-8">
                            <div class="card border-0 rounded-0 mb-3">
                                <div class="card-body py-0">
                                    <div class="section-header mb-4">
                                        <h5>Leave comment:</h5>
                                        <div class="section-header_divider"></div>
                                    </div>
                                    <textarea name="" id="commenteditor" cols="30" rows="10"></textarea>
                                    <button type="button" class="btn btn-dark-cerulean mt-4" id="commentSubmit">
                                        Post a comment
                                    </button>
                                    <div class="load-comments">

                                    </div>
                                    <!-- <div class="d-block py-5 border-bottom">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="img-user width_55p">
                                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/avatar-02.jpg'); ?>"
                                                    class="rounded-circle img-fluid" alt="">
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="mb-1">Shahabuddin Khan<span
                                                        class="bg-dark-cerulean text-white px-3 ms-2 rounded">Instructor</span>
                                                </h6>
                                                <p class="mb-0">5 Days ago</p>
                                            </div>
                                        </div>
                                        <p class="mb-0">It's very awesome and fascinating very much.</p>
                                    </div>
                                    <div class="d-block py-5">
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="img-user width_55p">
                                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/avatar-01.jpg'); ?>"
                                                    class="rounded-circle img-fluid" alt="">
                                            </div>
                                            <div class="ms-3">
                                                <h6 class="mb-1">Shahabuddin Khan<span
                                                        class="bg-dark-cerulean text-white px-3 ms-2 rounded">Instructor</span>
                                                </h6>
                                                <p class="mb-0">5 Days ago</p>
                                            </div>
                                        </div>
                                        <p class="mb-0">It's very awesome and fascinating very much.</p>
                                    </div>
                                    <div class="d-block">
                                        <nav data-pagination class="nav-pagination">
                                            <ul>
                                                <li class=current><a href=#1>1</a>
                                                <li><a href=#2>2</a>
                                                <li><a href=#3>3</a>
                                                <li><a href=#4>4</a>
                                                <li><a href=#5>5</a>
                                                <li><a href=#6>6</a>
                                                <li><a href=#7>7</a>
                                                <li><a href=#8>8</a>
                                                <li><a href=#9>9</a>
                                                <li><a href=#10>…</a>
                                                <li><a href=#41>41</a>
                                            </ul>
                                        </nav>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <!--Start card-->
                            <div class="border-0 card">
                                <div class="align-items-center d-flex mb-3">
                                    <div class="img-user">
                                        <img src="<?php echo base_url(!empty(get_picturebyid($get_studentinfo->student_id)->picture) ? get_picturebyid($get_studentinfo->student_id)->picture : default_image()); ?>"
                                            class="rounded-circle img-fluid" alt="" style="width: 120px;">
                                    </div>
                                    <div class="ms-4">
                                        <div class="fs-13 fw-bold lh-18 mb-2 text-sky">Project By:</div>
                                        <h6 class="font-open fs-15 fw-bold lh-20 mb-1 text-black">
                                            <a class="subtitle-one"
                                                href="<?php echo base_url($enterprise_shortname.'/student-profile-show/'.$get_studentinfo->student_id); ?>">
                                                <?php echo (!empty($get_studentinfo->name) ? $get_studentinfo->name : ''); ?>
                                            </a>
                                        </h6>
                                        <p class="mb-0">
                                            <?php echo (!empty($get_studentinfo->designation) ? $get_studentinfo->designation : ''); ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="likeunlike-area">
                                    <?php 
                                
                                    if(@$get_likeunlikestatus->likestatus == 1){ ?>
                                    <button class="btn btn-danger w-75"
                                        onclick="likeunlikethisproject('<?php echo $get_projectsingledata->project_id?>', 0)"><i
                                            class="fas fa-thumbs-down me-2"></i>I Unlike this project</button>
                                    <?php }else{ ?>
                                    <button class="btn btn-dark-cerulean w-75"
                                        onclick="likeunlikethisproject('<?php echo $get_projectsingledata->project_id?>', 1)"><i
                                            class="fas fa-thumbs-up me-2"></i>I like this project</button>
                                    <?php } ?>
                                </div>
                                <?php  if($get_projectsingledata->course_id){ ?>
                                <h6 class="mt-4 mb-2">Enroll this amazing course right now</h6>
                                <!--Start Course Card-->
                                <?php if($get_projectsingledata->project_type == 1){ 
                                    ?>
                                <div
                                    class="course-card course-card-shadow rounded-6 bg-white position-relative overflow-hidden  hideClass">
                                    <div class="position-relative overflow-hidden bg-prussian-blue">

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
                                            <?php 
                                                if($get_projectsingledata->tagstatus==4){?>
                                            <span class="badge-new  me-1">Most Popular</span>
                                            <?php   
                                                }elseif($get_projectsingledata->tagstatus==3){?>
                                            <span class="badge-new  me-1">New</span>
                                            <?php }elseif($get_projectsingledata->tagstatus==1){?>
                                            <span class="badge-new  me-1">Recomended</span>

                                            <?php }elseif($get_projectsingledata->tagstatus==2){?>
                                            <span class="badge-new  me-1">Best Seller</span>
                                            <?php  }?>
                                            <span
                                                class="badge-business"><?php echo html_escape($get_projectsingledata->category_name);?></span>
                                            <span id="savecourse<?php echo $get_projectsingledata->course_id; ?>"
                                                class="ms-auto">
                                                <?php
                                                $coursesaved_checked = $this->Frontend_model->coursesaved_checked($user_id,$get_projectsingledata->course_id);
                                                if (!$coursesaved_checked){
                                                    if ($user_type == 4) {?>
                                                <img onclick="get_coursesaveloop(1, '<?php echo $get_projectsingledata->course_id; ?>')"
                                                    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-1.png'); ?>"
                                                    class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                                <?php }else {?>
                                                <img onclick="coursesavecheck()"
                                                    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-1.png'); ?>"
                                                    class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                                <?php }
                                                } else {?>
                                                <img onclick="get_coursesaveloop(0, '<?php echo $get_projectsingledata->course_id; ?>')"
                                                    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/bookmark-2.png'); ?>"
                                                    class="img-fluid ms-auto " alt="" style="cursor: pointer;">
                                                <?php } ?>
                                            </span>
                                        </div>
                                        <?php if(!empty($get_projectsingledata->is_discount==1)){ ?>
                                        <span
                                            class="px-0 badge m-3   position-absolute start-0 text-white   z-index-2 polygon-shape"
                                            style="top:25px">
                                            <span class="d-block fs-13 mb-1">Off</span>
                                            <span
                                                class="fs-15 fw-bold"><?php  echo (($get_projectsingledata->discount) ? $get_projectsingledata->discount :''); ?><?php if($get_projectsingledata->discount_type==2){ echo "%";}else{ echo " ";}?></span>
                                        </span>
                                        <?php }?>
                                        <!--End Course Image-->


                                        <!--Start Course Card Body-->
                                        <div
                                            class="bg-prussian-blue course-card_body course_middle px-3 py-2 text-white py-12">
                                            <!--Start Course Title-->
                                            <h3 class="course-card__course--title  mb-0 text-capitalize">
                                                <a href="<?php echo base_url($enterprise_shortname. '/course-details/'. $get_projectsingledata->course_id); ?>"
                                                    class="text-decoration-none text-white"><?php echo (!empty($get_projectsingledata->name) ? $get_projectsingledata->name : ''); ?></a>
                                            </h3>
                                            <!--End Course Title-->
                                            <div class="course-card__instructor d-flex align-items-center">
                                                <div class="card__instructor--name my-2">
                                                    <a class="text-capitalize instructor-name"
                                                        href="<?php echo base_url($enterprise_shortname.'/instructor-profile-show/'.$get_projectsingledata->faculty_id); ?>"><?php echo (!empty($get_projectsingledata->instructor_name) ? $get_projectsingledata->instructor_name : ''); ?></a>
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
                                                                                if (@$get_projectsingledata->course_level == 1) {?>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="bar-custom me-2">
                                                                            <span class="fill"></span>
                                                                            <span></span>
                                                                            <span></span>
                                                                        </div>
                                                                    </div>
                                                                    <?php } elseif (@$get_projectsingledata->course_level == 2) {?>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="bar-custom me-2">
                                                                            <span class="fill"></span>
                                                                            <span class="fill"></span>
                                                                            <span></span>
                                                                        </div>
                                                                    </div>
                                                                    <?php } elseif (@$get_projectsingledata->course_level == 3) {?>
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
                                                                            if($get_projectsingledata->course_level == 1){
                                                                                
                                                                                echo "Beginner   Level";
                                                                            }elseif($get_projectsingledata->course_level == 2){
                                                                                echo "Intermediate Level";
                                                                            }elseif($get_projectsingledata->course_level == 3){
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
                                                                        xmlns="http://www.w3.org/2000/svg" width="17.26"
                                                                        height="14.926" viewBox="0 0 17.26 14.926">
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
                                                                    <?php if($get_projectsingledata->enterprise_name=='Admin'){ echo "Lead Academy";}else{ echo $get_projectsingledata->enterprise_name." "."Academy";}?>
                                                                    <?php //echo (!empty($get_projectsingledata->enterprise_name) ? $get_projectsingledata->enterprise_name : ''); ?>
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
                                                            $studentCount = $this->db->where('product_id', $get_projectsingledata->course_id)->get('invoice_details')->num_rows();
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
                                                            <?php echo average_ratings_number($get_projectsingledata->course_id,$enterprise_id);?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--End Course Card Body-->

                                        <!--Start Course Card Hover Content-->
                                        <div class="course-card__hover--content">
                                            <img src="<?php echo base_url(!empty($get_projectsingledata->hover_thumbnail) ? $get_projectsingledata->hover_thumbnail :default_600_400()); ?>"
                                                class="course-card__hover--content___img">
                                            <!--Start Video Icon With Popup Youtube-->
                                            <?php if($get_projectsingledata->url){ ?>

                                            <a class="course-card__hover--content___icon popup-youtube"
                                                href="<?php echo (!empty($get_projectsingledata->url)? $get_projectsingledata->url : ''); ?>"
                                                autoplay>
                                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/Playicon.png'); ?>"
                                                    class="img-fluid" alt="">
                                            </a>
                                            <?php } ?>
                                            <!--End Video Icon With Popup Youtube-->

                                            <h3
                                                class="bottom-0 course-card__hover--content___text d-block fs-15 mb-0 position-absolute text-capitalize text-decoration-none text-white">
                                                <a href="<?php echo base_url($enterprise_shortname. '/course-details/'. $get_projectsingledata->course_id); ?>"
                                                    class="text-decoration-none text-white"><?php echo (!empty($get_projectsingledata->name) ? $get_projectsingledata->name : ''); ?></a>
                                            </h3>
                                        </div>
                                        <!--End Card Hover Content-->
                                    </div>
                                    <?php 
                                        $course_types = json_decode($get_projectsingledata->course_type);
                                        $checked_purchase = $this->db->where('customer_id',$user_id)->where('product_id', $get_projectsingledata->course_id)->where('status',1)->get('invoice_details')->row();
                                    
                                        ?>
                                    <!-- footer card  -->
                                    <div class="course-card_footer g-2 px-3 py-12">
                                        <?php 
                                    // check purchase or subscription 
                                   if($checked_purchase){?>
                                        <div class="d-block">
                                            <div class="align-items-center d-flex form-check ps-0">
                                                <input class="me-1" style="width:21px;height:21px" type="radio" name=""
                                                    id="" onclick="" disabled>
                                                <label class="form-check-label fw-bold opa-half course_price_cart"
                                                    for="flexRadioDefault1">
                                                    Subscription
                                                </label>
                                            </div>
                                            <div class="align-items-center d-flex form-check ps-0">
                                                <input class="me-1" style="width:21px;height:21px" type="radio" name=""
                                                    id="" onclick="" disabled>
                                                <label class="align-items-center d-flex form-check-label fw-bold justify-content-between" style="width:100%;"
                                                    for="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>">
                                                    <span class="course_price_cart">Course Price
                                                        <span class="text-success">
                                                        </span>
                                                    </span>
                                                    <span class="align-items-center d-flex  rounded text-center">
                                                        <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                            <?php echo (($get_projectsingledata->is_offer == 1) ? number_format($get_projectsingledata->offer_courseprice) : number_format($get_projectsingledata->price)); ?></span>
                                                        <?php if(!empty($get_projectsingledata->is_discount==1)){?>
                                                        <del
                                                            class="fs-12 fw-bold text-muted2"><?php echo (($get_projectsingledata->oldprice)?number_format($get_projectsingledata->oldprice) :" "); ?></del>
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
                                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>"
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
                                                value="<?php echo $get_projectsingledata->course_id;?>"
                                                id="<?php echo $get_projectsingledata->course_id;?>">
                                            <div class="align-items-center d-flex form-check ps-0">
                                                <!-- <input class="form-check-input" type="radio" name="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>" id="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>"  onclick="subscriptionchecedRadio('<?php echo $get_projectsingledata->course_id;?>')" > -->
                                                <input class="me-1" style="width:21px;height:21px" type="radio"
                                                    name="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>"
                                                    id="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>"
                                                    onclick="subscriptionchecedRadio('<?php echo $get_projectsingledata->course_id;?>')">
                                                <label class="form-check-label fw-bold course_price_cart "
                                                    for="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>">
                                                    Subscription
                                                </label>
                                            </div>
                                            <div class="form-check d-flex align-items-center ps-0">
                                                <input class="me-1" style="width:21px;height:21px" type="radio"
                                                    name="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>"
                                                    id="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>"
                                                    onclick="coursechecedRadio('<?php echo $get_projectsingledata->course_id;?>')"
                                                    checked>
                                                <label
                                                    class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                                    style="width:100%;"
                                                    for="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>">
                                                    <span class="course_price_cart">Course Price
                                                        <span class="text-success">
                                                        </span>
                                                    </span>
                                                    <span class="align-items-center d-flex  rounded text-center">
                                                        <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                            <?php echo (($get_projectsingledata->is_offer == 1) ? number_format($get_projectsingledata->offer_courseprice) : number_format($get_projectsingledata->price)); ?></span>
                                                        <?php if(!empty($get_projectsingledata->is_discount==1)){?>
                                                        <del
                                                            class="fs-12 fw-bold text-muted2"><?php echo (($get_projectsingledata->oldprice)?number_format($get_projectsingledata->oldprice) :" "); ?></del>
                                                        <?php }?>

                                                    </span>
                                                </label>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-stretch mt-2"
                                                id="course_purchase_<?php echo $get_projectsingledata->course_id?>">
                                                <div class="flex-grow-1 me-2 w-sub">
                                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>"
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
                                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>"
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
                                                id="course_subscription_<?php echo $get_projectsingledata->course_id?>">
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
                                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>"
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
                                                        <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>" class="btn btn-dark-cerulean w-100">
                                                            <i data-feather="info" class="me-1"></i>
                                                            Details
                                                        </a>
                                                    </div>
                                                </div> -->
                                            <?php }elseif(in_array("1", $course_types)){?>
                                            <div class="align-items-center d-flex form-check ps-0">
                                                <input class="me-1" style="width:21px;height:21px" type="radio"
                                                    name="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>"
                                                    id="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>"
                                                    onclick="subscriptionchecedRadio('<?php echo $get_projectsingledata->course_id;?>')"
                                                    disabled>
                                                <label class="form-check-label fw-bold opa-half course_price_cart"
                                                    for="flexRadioDefault1">
                                                    Subscription
                                                </label>
                                            </div>
                                            <div class="form-check d-flex align-items-center ps-0">
                                                <input class="me-1" style="width:21px;height:21px" type="radio"
                                                    name="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>"
                                                    id="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>"
                                                    onclick="coursechecedRadio('<?php echo $get_projectsingledata->course_id;?>')"
                                                    checked>
                                                <label
                                                    class="align-items-center d-flex form-check-label fw-bold justify-content-between"
                                                    style="width:100%"
                                                    for="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>">
                                                    <span class="course_price_cart">Course Price <span
                                                            class="text-success"></span>
                                                    </span>
                                                    <span class="align-items-center d-flex  rounded text-center">
                                                        <span class="d-block fs-16 fw-bold me-2 text-success2">BDT
                                                            <?php echo (($get_projectsingledata->is_offer == 1) ? number_format($get_projectsingledata->offer_courseprice) : number_format($get_projectsingledata->price)); ?></span>
                                                        <?php if(!empty($get_projectsingledata->is_discount==1)){?>
                                                        <del
                                                            class="fs-12 fw-bold text-muted2"><?php echo (($get_projectsingledata->oldprice)?number_format($get_projectsingledata->oldprice) :" "); ?></del>
                                                        <?php }?>
                                                    </span>

                                                </label>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-stretch mt-2">
                                                <div class="flex-grow-1 me-2 w-sub">
                                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>"
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
                                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>"
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
                                                    name="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>"
                                                    id="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>"
                                                    onclick="subscriptionchecedRadio('<?php echo $get_projectsingledata->course_id;?>')"
                                                    checked>
                                                <label class="form-check-label fw-bold course_price_cart"
                                                    for="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>">
                                                    Subscription
                                                </label>
                                            </div>
                                            <div class="form-check d-flex align-items-center ps-0 ">
                                                <input class="me-1" style="width:21px;height:21px" type="radio"
                                                    name="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>"
                                                    id="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>"
                                                    onclick="coursechecedRadio('<?php echo $get_projectsingledata->course_id;?>')"
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
                                                        <span class="text-center w-100 fw-bold fs-13"> Subscription
                                                        </span>
                                                    </a>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>"
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
                                                    name="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>"
                                                    id="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>"
                                                    onclick="subscriptionchecedRadio('<?php echo $get_projectsingledata->course_id;?>')"
                                                    disabled>
                                                <label class="form-check-label fw-bold opa-half course_price_cart"
                                                    for="flexRadioDefault1">
                                                    Subscription
                                                </label>
                                            </div>
                                            <div class="align-items-center d-flex form-check ps-0">
                                                <input class="me-1" style="width:21px;height:21px" type="radio"
                                                    name="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>"
                                                    id="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>"
                                                    onclick="coursechecedRadio('<?php echo $get_projectsingledata->course_id;?>')"
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
                                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>"
                                                        class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                        <span class="shopping me-1 shopping_icon position-relative">
                                                            <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                                style="width: 14px;">
                                                        </span>
                                                        <span class="text-center w-100 fw-bold fs-13"> Enroll Free </span>
                                                    </a>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>"
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
                                                    name="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>"
                                                    id="flexRadioDefault1_<?php echo $get_projectsingledata->course_id?>"
                                                    onclick="subscriptionchecedRadio('<?php echo $get_projectsingledata->course_id;?>')"
                                                    disabled>
                                                <label class="form-check-label fw-bold opa-half course_price_cart"
                                                    for="flexRadioDefault1">
                                                    Subscription
                                                </label>
                                            </div>
                                            <div class="align-items-center d-flex form-check ps-0">
                                                <input class="me-1" style="width:21px;height:21px" type="radio"
                                                    name="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>"
                                                    id="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>"
                                                    onclick="coursechecedRadio('<?php echo $get_projectsingledata->course_id;?>')"
                                                    disabled>
                                                <label
                                                    class="align-items-center d-flex form-check-label fw-bold justify-content-between opa-half"
                                                    for="flexRadioDefault2_<?php echo $get_projectsingledata->course_id?>">
                                                    <span class="course_price_cart">Course Price</span>
                                                    <span class="bg-danger d-flex px-2 rounded text-center text-white">
                                                        <!-- Govt -->
                                                    </span>
                                                </label>
                                                <span class="badge bg-success me-1 float-end ms-auto"> Govt</span>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-stretch mt-2">
                                                <div class="flex-grow-1 me-2 w-sub">
                                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>"
                                                        class="btn btn-dark-cerulean w-100 btn-cart-2 fs-14">
                                                        <span class="shopping me-1 shopping_icon position-relative">
                                                            <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/cart.png'); ?>"
                                                                style="width: 14px;">
                                                        </span>
                                                        <span class="text-center w-100 fw-bold fs-13"> Govt </span>
                                                    </a>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <a href="<?php echo base_url($enterprise_shortname.'/course-details/'. $get_projectsingledata->course_id); ?>"
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
                                }
                                 ?>
                                <!--End Course Card-->
                            </div>
                            <!--End card-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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
        var user_type = $("#user_type").val();
        var project_id = "<?php echo $get_projectsingledata->project_id?>";
        var comments = getDataFromTheEditor();
        if (user_id == '') {
            toastr.error("Please Login First!");
            return false;
        }
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
                user_type: user_type,
                project_id: project_id,
                enterprise_id: enterprise_id,
                comments: comments,
            },
            success: function(r) {
                theEditor.setData("");
                // console.log(r);
                toastr.success(r);
                loadcomments();
            },
        });
    });

    loadcomments();
});

function loadcomments() {
    var project_id = "<?php echo $get_projectsingledata->project_id?>";
    $.ajax({
        url: base_url + enterprise_shortname + "/loadcomments",
        type: "POST",
        data: {
            csrf_test_name: CSRF_TOKEN,
            // user_id: user_id,
            // user_type: user_type,
            enterprise_id: enterprise_id,
            project_id: project_id,
        },
        success: function(r) {
            // console.log(r);
            $(".load-comments").html(r);
        },
    });
}

function likeunlikethisproject(project_id, status) {
    var user_id = $("#user_id").val();
    var user_type = $("#user_type").val();
    if (user_id == '') {
        toastr.error("Please Login First!");
        return false;
    }
    $.ajax({
        url: base_url + enterprise_shortname + "/likeunlikethisproject",
        type: "POST",
        data: {
            csrf_test_name: CSRF_TOKEN,
            user_id: user_id,
            user_type: user_type,
            enterprise_id: enterprise_id,
            project_id: project_id,
            status: status,
        },
        success: function(r) {
            // toastr.success(r);
            $(".likeunlike-area").html(r);

        },
    });
}
<?php //die();?>
</script>