<?php 
	$user_id = $this->uri->segment(3);
    // dd($user_id);
?>
<!--Start Course Completed-->
<style>
.blog-carousel .owl-item .project-card_img img {
    height: 200px;
}
    </style>
<?php  if($instructor_info->is_featureshow == 1){?>
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-3 p-xl-4">
                <div class="d-md-flex align-items-center justify-content-between mb-4">
                    <!--Start Section Header-->
                    <div class="section-header mb-4 mb-md-0">
                        <?php 
						$projectcount = count($get_featuredproject);
						?>
                        <h4>My projects (<?php echo $projectcount; ?>)</h4>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <!--						<div><a href="instructor-project-add.html" class="btn btn-dark-cerulean">+&nbsp;Add New Project</a></div>-->
                </div>
                <div class="position-relative">
                    <div class="project-carousel owl-carousel owl-theme no-transform">
                        <!--Start Project Card-->
                        <?php if($get_featuredproject){ ?>
                        <?php foreach($get_featuredproject as $project){ ?>
                        <div class="project-card">
                            <div class="project-card_img position-relative overflow-hidden rounded">
                                <img src="<?php echo base_url((!empty($project->coverpic) ? $project->coverpic : default_600_400())); ?>"
                                    alt="" class="img-fluid">
                                    <div class="featured-opacity  bottom-0 d-flex end-0 flex-wrap h-100 <?php if($project->publish_status==0){ echo "justify-content-center";}else{ echo "align-items-center";}?> p-3 position-absolute project-card_overlay start-0 top-0">
                                            <div class="w-100">
                                                <div class="align-items-center d-flex text-white mb-1">
                                                    <div class="flex-shrink-0">
                                                        <div
                                                            class="project-card_round--icon bg-danger d-flex align-items-center justify-content-center">
                                                            <i data-feather="bookmark"></i>
                                                        </div>
                                                    </div>
                                                    <div class=" ms-2 fs-13">
                                                    <?php if($project->project_type==1){?>
                                                        Course Project
                                                    <?php }elseif($project->project_type==2){?>
                                                        Personal Project
                                                    <?php }elseif($project->project_type==4){?>
                                                        Client Project
                                                    <?php }?>
                                                    </div>
                                                </div>
                                                <?php if($project->publish_status==0){?>
                                                <div class="align-items-center d-flex  text-white">
                                                    <div class="flex-shrink-0">
                                                        <div
                                                            class="project-card_round--icon bg-primary d-flex align-items-center justify-content-center">
                                                            <i data-feather="anchor"></i>
                                                        </div>
                                                    </div>
                                                    <div class=" ms-2 fs-13">
                                                            Draft
                                                    </div>
                                                </div>
                                                <?php }?>
                                                
                                                
                                            </div>
                                            
                                        </div>
                                <!-- <div
                                    class="align-content-between bottom-0 end-0 flex-wrap h-100 p-3 position-absolute project-card_overlay start-0 top-0">
                                    <div class="w-100">
                                        <div class="d-flex align-items-center text-white mb-1">
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="project-card_round--icon bg-primary d-flex align-items-center justify-content-center">
                                                    <i data-feather="anchor"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-2 fs-13">
                                                Featured
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center text-white">
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="project-card_round--icon bg-danger d-flex align-items-center justify-content-center">
                                                    <i data-feather="bookmark"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-2 fs-13">
                                                Course Project
                                            </div>
                                        </div>
                                    </div>
                                    <div class="project-card_icon text-white w-100">
                                        <div class="mb-1 fs-13"><i data-feather="heart" class="me-1"></i>26
                                        </div>
                                        <div class="mb-1 fs-13"><i data-feather="message-circle" class="me-1"></i>1
                                        </div>
                                        <div class="mb-1 fs-13"><i data-feather="eye" class="me-1"></i>225</div>
                                    </div>
                                </div> -->
                            </div>
                            <h6 class="project-card-title mb-0 mt-2 text-truncate">
                            <a class="text-dark fs-15"
                                            href="<?php echo base_url($enterprise_shortname . '/instructor-project-view/' . $project->project_id); ?>">
                                <?php echo (!empty($project->title) ? $project->title : ''); ?>
                            </a>
                            </h6>
                            <!--Start Action Button-->
                            <!-- <div class="action-btn align-items-center d-flex mt-3">
                                <a href="<?php echo base_url($enterprise_shortname . '/instructor-project-edit/'. $project->project_id); ?>"
                                    class="me-2 text-dark"><i data-feather="edit-3"
                                        class="me-1"></i><span>Edit</span></a>
                                <a href="javascript:void(0)" class="me-2 text-danger"
                                    onclick="instructorprojectdelete('<?php echo $project->project_id; ?>')"><i
                                        data-feather="trash-2" class="me-1"></i><span>Delete</span></a>
                            </div> -->
                            <!--End Action Button-->
                        </div>
                        <?php } ?>
                        <?php }else{ ?>
                        <p>Record not found!</p>
                        <?php } ?>
                        <!--End Project Card-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<!--End Course Completed-->

<!--Start Course Completed-->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-3 p-xl-4">
                <div class="d-md-flex align-items-center justify-content-between mb-4">
                    <!--Start Section Header-->
                    <div class="section-header mb-4 mb-md-0">
                        <?php
						$forumcount = count($get_forumlist);
						?>
                        <h4>Blogs (<?php echo $forumcount; ?>)</h4>
                        <div class="section-header_divider"></div>
                    </div>
                    <!--End Section Header-->
                    <!--						<div><a href="instructor-project-add.html" class="btn btn-dark-cerulean">+&nbsp;Add New Project</a></div>-->
                </div>
                <div class="position-relative">
                    <div class="blog-carousel owl-carousel owl-theme no-transform">
                        <!--Start Project Card-->
                        <?php if($get_forumlist){
							foreach($get_forumlist as $forum){
							?>
                        <div class="project-card">
                            <div class="project-card_img position-relative overflow-hidden rounded">
                                <img src="<?php echo base_url(!empty($forum->picture) ? $forum->picture : default_600_400()); ?>"
                                    alt="" class="img-fluid">
                            </div>
                            <div class="badge bg-success mt-3 me-1">New</div>
                            <h6 class="project-card-title mb-0 mt-2 text-truncate">
                                <a href="<?php echo base_url($enterprise_shortname.'/forum-details/'.$forum->forum_id); ?>" class="text-dark">
                                    <?php echo (!empty($forum->title) ? $forum->title : ''); ?>
                                </a>
                            </h6>
                            <p class="mt-2">
                                <?php 
							$description = word_limiter($forum->description, 10);
							echo (!empty($description) ? $description : ''); ?>
                            </p>
                            <div class="project-card_icon d-flex w-100">
                                <div class="mb-1 fs-13 me-3"><i class="me-1 far fa-heart"></i>26</div>
                                <div class="mb-1 fs-13 me-3"><i class="me-1 far fa-comment"></i>1</div>
                                <div class="mb-1 fs-13 me-3"><i class="me-1 far fa-eye"></i>225</div>
                            </div>
                        </div>
                        <?php } } ?>
                        <!--End Project Card-->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Course Completed-->

<!--Start Course Completed-->
<div class="bg-alice-blue py-3">
    <div class="container-lg">
        <div class="card border-0 rounded-0 shadow-sm">
            <div class="card-body p-3 p-xl-4">
                <div class="d-md-flex align-items-center mb-4">
                    <!--Start Section Header-->
                    <div class="section-header mb-4 mb-md-0">
                        <h4 class="mb-0">Live Course or Events</h4>
                    </div>
                    <!--End Section Header-->
                    <!-- <div class="ms-0 ms-md-4"><a href="#"
                            class="btn btn-dark-cerulean">+&nbsp;Create New Live Event</a></div> -->
                </div>
                <div class="position-relative">
                    <div class="blog-carousel owl-carousel owl-theme">
                        <!--Start Project Card-->
                 
                        <?php
                       $upcoming_liveevents= $this->db->select('a.course_id,a.faculty_id, a.name, b.id, b.meeting_id, b.meeting_date, b.start_time, b.end_time, c.name category_name,d.name as instructor_name,e.picture')
                                            ->from('course_tbl a')
                                            ->join('meeting_tbl b', 'b.course_id = a.course_id')
                                            ->join('category_tbl c', 'c.category_id = a.category_id', 'left')
                                            ->join('faculty_tbl d', 'd.faculty_id = a.faculty_id', 'left')
                                            ->join("picture_tbl e", 'e.from_id = a.course_id', 'left')
                                            ->group_start()
                                            ->where('a.enterprise_id', $enterprise_id)
                                            ->where('a.faculty_id', $user_id)
                                            ->group_end()
                                            ->group_start()
                                            ->where('a.is_livecourse', 1)
                                            ->or_where('a.is_livecourse', 2)
                                            ->group_end()
                                            // ->where('a.faculty_id', $user_id)
                                            ->group_by('b.course_id')
                                            ->order_by('a.id', 'desc')
                                            // ->limit('4')
                                            ->get()->result();
                                            // echo $this->db->last_query();
                        foreach($upcoming_liveevents as $liveevent){
                        $meeting_date = strtotime($liveevent->meeting_date);
                        ?>
                        <div class="project-card">
                            <div class="project-card_img position-relative overflow-hidden rounded">
                                <img src="<?php echo base_url(!empty($liveevent->picture) ? $liveevent->picture : default_600_400()); ?>"
                                    alt="" class="img-fluid">
                                    <!-- btn btn-danger -->
                                <a href="<?php echo base_url($enterprise_shortname.'/event-details/'.$liveevent->course_id);?>" class=" mt-2 position-absolute bottom-0 end-0"> <?php
                                                       
                                                       if (strtotime($liveevent->meeting_date) == strtotime(date("Y-m-d")) && strtotime($liveevent->start_time) <= time() && strtotime($liveevent->end_time) > time()) {
                                                            $status = '<i class="fas fa-video"></i> ' . display('live');
                                                            $labelmode = 'btn btn-success';
                                                            $hostbtn = ''; //"getJoinModal('$liveevent->meeting_id|$liveevent->id')";
                                                        }elseif (strtotime($liveevent->meeting_date) < strtotime(date("Y-m-d")) || (strtotime($liveevent->meeting_date) <= strtotime(date("Y-m-d")) && strtotime($liveevent->end_time) < time() )) {
                                                            $status = '<i class="far fa-check-square"></i> ' . display('expired');
                                                            $labelmode = 'btn btn-danger';
                                                            $hostbtn = '';
                                                        }else{
                                                            $status = '<i class="far fa-clock"></i> ' . display('waiting');
                                                            $labelmode = 'btn btn-info';
                                                            $hostbtn = '';
                                                        }
                                                        echo "<span class='label " . $labelmode . " '>" . $status . "</span>";
                                                        ?>
                                </a>
                            </div>
                             <!-- <h6 class="project-card-title mb-0 mt-3"> -->
                             <a class="project-card-title mb-0 mt-3 text-truncate text-dark" href="<?php echo base_url($enterprise_shortname.'/event-details/'.$liveevent->course_id);?>" class=" mt-2 position-absolute bottom-0 end-0">
                                <?php echo $liveevent->name?>
                             </a>
                            <!-- </h6> -->
                            <p class="mt-2"><?php echo $liveevent->instructor_name?></p>
                            <!-- <div class="h6"><?php echo $liveevent->name?></div> -->
                        </div>
                        <?php }?>
                        <!--End Project Card-->
                        <!--Start Project Card-->
                        <!-- <div class="project-card">
                            <div class="project-card_img position-relative overflow-hidden rounded">
                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/course/course.jpg'); ?>"
                                    alt="" class="img-fluid">
                                <button class="btn btn-warning mt-2 position-absolute bottom-0 end-0">Upcoming
                                    Live</button>
                            </div>
                            <h6 class="project-card-title mb-0 mt-3">Last 6 months current affairs | Combined Revission
                            </h6>
                            <p class="mt-2">Firoz Abdullah</p>
                            <div class="h6">7 Waiting</div>
                            <div class="h6">Scheduled for 04/12/21, 04:25</div>
                        </div> -->
                        <!--End Project Card-->
                        <!--Start Project Card-->
                        <!-- <div class="project-card">
                            <div class="project-card_img position-relative overflow-hidden rounded">
                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/course/course.jpg'); ?>"
                                    alt="" class="img-fluid">
                                <button
                                    class="btn btn-dark-cerulean mt-2 position-absolute bottom-0 end-0">4:25:30</button>
                            </div>
                            <h6 class="project-card-title mb-0 mt-3">Last 6 months current affairs | Combined Revission
                            </h6>
                            <p class="mt-2">Firoz Abdullah</p>
                            <div class="h6">231K View</div>
                            <div class="h6">Streamed 2h ago</div>
                        </div> -->
                        <!--End Project Card-->
                        <!--Start Project Card-->
                        <!-- <div class="project-card">
                            <div class="project-card_img position-relative overflow-hidden rounded">
                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/course/course.jpg'); ?>"
                                    alt="" class="img-fluid">
                                <button
                                    class="btn btn-dark-cerulean mt-2 position-absolute bottom-0 end-0">4:25:30</button>
                            </div>
                            <h6 class="project-card-title mb-0 mt-3">Last 6 months current affairs | Combined Revission
                            </h6>
                            <p class="mt-2">Firoz Abdullah</p>
                            <div class="h6">231K View</div>
                            <div class="h6">Streamed 2h ago</div>
                        </div> -->
                        <!--End Project Card-->
                        <!--Start Project Card-->
                        <!-- <div class="project-card">
                            <div class="project-card_img position-relative overflow-hidden rounded">
                                <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/course/course.jpg'); ?>"
                                    alt="" class="img-fluid">
                            </div>
                            <h6 class="project-card-title mb-0 mt-3">Last 6 months current affairs | Combined Revission
                            </h6>
                            <p class="mt-2">Firoz Abdullah</p>
                            <div class="h6">4k Watching</div>
                        </div> -->
                        <!--End Project Card-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End Course Completed-->
<script>
$(document).ready(function() {

});

// =============== its for instructor projectdelete ====================
"use strict";

function instructorprojectdelete(project_id) {
    var base_url = $("#base_url").val();
    var enterprise_shortname = $("#enterprise_shortname").val();
    var CSRF_TOKEN = $("#CSRF_TOKEN").val();
    var r = confirm("Do you want to delete?");
    if (r == true) {
        $.ajax({
            url: base_url + enterprise_shortname + "/instructor-project-delete",
            type: "POST",
            data: {
                csrf_test_name: CSRF_TOKEN,
                project_id: project_id,
                enterprise_id: enterprise_id,
            },
            success: function(r) {
                toastrErrorMsg(r);
                window.location.reload();
            },
        });
    }
}
</script>