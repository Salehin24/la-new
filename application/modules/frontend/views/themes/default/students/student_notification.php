      <div id="pending-faculty-count"></div>
      
      <!--Start Student Profile Header-->
      <?php
                $this->load->view('dashboard_coverpage');
        ?>
      <!--End Student Profile Header-->
      <div class="bg-dark-cerulean sticky-nav">
          <div class="container-lg">
              <?php
                $this->load->view('dashboard_topmenu');
                ?>
          </div>
      </div>
    <?php 
      $user_id = $this->session->userdata('user_id');
    ?>
      <!--Student Profile Edit Option-->
      <!--Start Experience-->
      <div class="bg-alice-blue pt-5">
          <div class="container-lg">
              <div class="card border-0 rounded-0 shadow-sm">
                  <div class="card-body p-4 p-xl-5">
                      <div class="d-flex align-items-center justify-content-between mb-4">
                          <!--Start Section Header-->
                          <div class="section-header">
                              <h4>Academy &amp; Community</h4>
                              <div class="section-header_divider"></div>
                          </div>
                          <!--End Section Header-->
                          <div>
                              <!-- <select class="form-select rounded-0" aria-label="Default select example">
                                  <option selected>All</option>
                                  <option value="1">Lead Academy</option>
                                  <option value="2">Instructor</option>
                                  <option value="3">Subscription</option>
                                  <option value="4">Offers &amp; Updates</option>
                                  <option value="5">Event</option>
                                  <option value="6">Blog</option>
                                  <option value="7">Purchase</option>
                              </select> -->
                          </div>
                      </div>
                      <hr>
                      <?php 
                    //   d($allnotification);
                    //   $allnotification=$this->db->select("*")->from("notifications_tbl")->where('student_id',$user_id)->where('enterprise_id',$enterprise_id)->order_by("id", "desc")->limit(20)->get()->result();
                      foreach($allnotification as $notificationinfo){
                         if($notificationinfo->notification_type==1){
                             //  course notification 
                             $course=$this->db->select('a.*,b.picture')
                             ->from('course_tbl a')
                             ->join('picture_tbl b', 'b.from_id = a.course_id', 'left')
                             ->where('a.course_id',$notificationinfo->notification_id)
                             ->where('a.enterprise_id',$enterprise_id)
                             ->where('a.status',1)
                             ->get()
                             ->row();
                            $course_types = json_decode($course->course_type);
                            ?>
                              <?php if(in_array(1,$course_types) && in_array(2,$course_types)){?>
                                <div class="d-sm-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo base_url(!empty($course->picture) ?  $course->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/default.jpg'); ?>"
                                            class="mr-3" alt=""     width="150px">
                                        <div class="ms-4">
                                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'.($course?$course->course_id:'')); ?>" class="btn btn-primary mb-2">Purchases & Subscription</a>
                                            <h5 class="mb-2"><a class="text-dark" href="<?php echo base_url($enterprise_shortname.'/course-details/'.($course?$course->course_id:'')); ?>"><?php echo  ($course?$course->name:'');?></a></h5>
                                            <p class="mb-0"><?php  
                                                    $description= $course->description? $course->description:'';
                                                    echo  $string = word_limiter($description, 15);?></p>
                                        </div>
                                    </div>
                                    <div class="fs-6 px-4 py-2 rounded text-nowrap mt-2 mt-sm-0 ms-sm-2">
                                        About <?php 
                                        $created_date=$notificationinfo->created_date?$notificationinfo->created_date:'';
                                        datetimeagoformate($created_date);
                                        ?>
                                    </div>
                                </div>
                                <hr>
                              <?php }if(in_array(3,$course_types) && in_array(4,$course_types)){?>
                                <div class="d-sm-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo base_url(!empty($course->picture) ?  $course->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/default.jpg'); ?>"
                                            class="mr-3" alt=""     width="150px">
                                        <div class="ms-4">
                                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'.($course?$course->course_id:'')); ?>" class="btn btn-primary mb-2">Free & Gov</a>
                                            <h5 class="mb-2"><a class="text-dark" href="<?php echo base_url($enterprise_shortname.'/course-details/'.($course?$course->course_id:'')); ?>"><?php echo  ($course?$course->name:'');?></a></h5>
                                            <p class="mb-0"><?php  
                                                    $description= $course->description? $course->description:'';
                                                    echo  $string = word_limiter($description, 15);?></p>
                                        </div>
                                    </div>
                                    <div class="fs-6 px-4 py-2 rounded text-nowrap mt-2 mt-sm-0 ms-sm-2">
                                        About <?php 
                                        $created_date=$notificationinfo->created_date?$notificationinfo->created_date:'';
                                        datetimeagoformate($created_date);
                                        ?>
                                    </div>
                                </div>
                                <hr>
                              <?php }elseif(in_array(1,$course_types)){?>
                                <div class="d-sm-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo base_url(!empty($course->picture) ?  $course->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/default.jpg'); ?>"
                                            class="mr-3" alt=""     width="150px">
                                        <div class="ms-4">
                                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'.($course?$course->course_id:'')); ?>" class="btn btn-primary mb-2">Purchase</a>
                                            <h5 class="mb-2"><a class="text-dark" href="<?php echo base_url($enterprise_shortname.'/course-details/'.($course?$course->course_id:'')); ?>"><?php echo ($course?$course->name:'');?></a></h5>
                                            <p class="mb-0"><?php  
                                                    $description= $course->description? $course->description:'';
                                                    echo  $string = word_limiter($description, 15);?></p>
                                        </div>
                                    </div>
                                    <div class="fs-6 px-4 py-2 rounded text-nowrap mt-2 mt-sm-0 ms-sm-2">
                                        About <?php 
                                        $created_date=$notificationinfo->created_date?$notificationinfo->created_date:'';
                                        datetimeagoformate($created_date);
                                        ?>
                                    </div>
                                </div>
                                <hr>

                              <?php }elseif(in_array(2,$course_types)){?>  
                                <div class="d-sm-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo base_url(!empty($course->picture) ?  $course->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/default.jpg'); ?>"
                                            class="mr-3" alt=""     width="150px">
                                        <div class="ms-4">
                                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'.($course?$course->course_id:'')); ?>" class="btn btn-primary mb-2">Subscription</a>
                                            <h5 class="mb-2"><a class="text-dark" href="<?php echo base_url($enterprise_shortname.'/course-details/'.($course?$course->course_id:'')); ?>"><?php echo ($course?$course->name:'');?></a></h5>
                                            <p class="mb-0"><?php  
                                                    $description= $course->description? $course->description:'';
                                                    echo  $string = word_limiter($description, 15);?></p>
                                        </div>
                                    </div>
                                    <div class="fs-6 px-4 py-2 rounded text-nowrap mt-2 mt-sm-0 ms-sm-2">
                                        About <?php 
                                        $created_date=$notificationinfo->created_date?$notificationinfo->created_date:'';
                                        datetimeagoformate($created_date);
                                        ?>
                                    </div>
                                </div>
                                <hr>
                              <?php }elseif(in_array(3,$course_types)){?>
                                <div class="d-sm-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo base_url(!empty($course->picture) ?  $course->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/default.jpg'); ?>"
                                            class="mr-3" alt=""     width="150px">
                                        <div class="ms-4">
                                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'.($course?$course->course_id:'')); ?>"class="btn btn-primary mb-2">Enroll Free</a>
                                            <h5 class="mb-2"><a class="text-dark" href="<?php echo base_url($enterprise_shortname.'/course-details/'.($course?$course->course_id:'')); ?>"><?php echo ($course?$course->name:'');?></a></h5>
                                            <p class="mb-0"><?php  
                                                    $description= $course->description? $course->description:'';
                                                    echo  $string = word_limiter($description, 15);?></p>
                                        </div>
                                    </div>
                                    <div class="fs-6 px-4 py-2 rounded text-nowrap mt-2 mt-sm-0 ms-sm-2">
                                        About <?php 
                                        $created_date=$notificationinfo->created_date?$notificationinfo->created_date:'';
                                        datetimeagoformate($created_date);
                                        ?>
                                    </div>
                                </div>
                                <hr>
                              <?php }elseif(in_array(4,$course_types)){?>
                                <div class="d-sm-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo base_url(!empty($course->picture) ?  $course->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/default.jpg'); ?>"
                                            class="mr-3" alt=""     width="150px">
                                        <div class="ms-4">
                                            <a href="<?php echo base_url($enterprise_shortname.'/course-details/'.($course?$course->course_id:'')); ?>" class="btn btn-primary mb-2">Govt</a>
                                            <h5 class="mb-2"><a class="text-dark" href="<?php echo base_url($enterprise_shortname.'/course-details/'.($course?$course->course_id:'')); ?>"><?php echo ($course?$course->name:'');?></a></h5>
                                            <p class="mb-0"><?php  
                                                    $description= $course->description? $course->description:'';
                                                    echo  $string = word_limiter($description, 15);?></p>
                                        </div>
                                    </div>
                                    <div class="fs-6 px-4 py-2 rounded text-nowrap mt-2 mt-sm-0 ms-sm-2">
                                        About <?php 
                                        $created_date=$notificationinfo->created_date?$notificationinfo->created_date:'';
                                        datetimeagoformate($created_date);
                                        ?>
                                    </div>
                                </div>
                                <hr>

                               <?php  }else{?>
                             
                               <?php }?>
                         
                        <?php }elseif($notificationinfo->notification_type==2){
                            //  event notification 
                            $event=$this->db->select('a.name,a.course_id,a.description,a.created_date,b.picture,a.is_livecourse')
                            ->from('course_tbl a')
                            ->join('picture_tbl b', 'b.from_id = a.course_id', 'left')
                            ->where('a.course_id',$notificationinfo->notification_id)
                            ->where('a.enterprise_id',$enterprise_id)
                            ->where('a.status',1)
                            ->get()
                            ->row();
                            if($event->is_livecourse==1){
                            ?>
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo base_url(!empty($event->picture) ? $event->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/default.jpg'); ?>"
                                        class="mr-3" alt=""     width="150px">
                                    <div class="ms-4">
                                        <a href="<?php echo base_url($enterprise_shortname.'/event-details/'.($event?$event->course_id:'')); ?>" class="btn btn-dark-cerulean me-2 mb-2">Live Class</a>
                                        <h5 class="mb-2"><a class="text-dark" href="<?php echo base_url($enterprise_shortname.'/event-details/'.($event?$event->course_id:'')); ?>"><?php echo ($event?$event->name:'');?></a></h5>
                                        <p class="mb-0" >New live class quick enroll this <a href="<?php echo base_url($enterprise_shortname.'/event-details/'.($event?$event->course_id:'')); ?>">click here</a><?php  
                                                //$description=$event->description?$event->description:'';
                                               // echo  $string = word_limiter($description, 15);?></p>
                                    </div>
                                </div>
                                <div class="fs-6 px-4 py-2 rounded text-nowrap mt-2 mt-sm-0 ms-sm-2">
                                    About <?php 
                                    $created_date=$notificationinfo->created_date?$notificationinfo->created_date:'';
                                    datetimeagoformate($created_date);
                                    ?>
                                </div>
                            </div>
                            <hr>

                        <?php }elseif($event->is_livecourse==2){?>
                            <div class="d-sm-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="<?php echo base_url(!empty($event->picture) ? $event->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/default.jpg'); ?>"
                                        class="mr-3" alt=""     width="150px">
                                    <div class="ms-4">
                                        <a href="<?php echo base_url($enterprise_shortname.'/event-details/'.($event?$event->course_id:'')); ?>" class="btn  btn-dark-cerulean me-2 mb-2">event</a>
                                        <h5 class="mb-2"><a class="text-dark" href="<?php echo base_url($enterprise_shortname.'/event-details/'.($event?$event->course_id:'')); ?>"><?php echo ($event?$event->name:'');?></a></h5>
                                        <p class="mb-0">New live event quick enroll this <a href="<?php echo base_url($enterprise_shortname.'/event-details/'.($event?$event->course_id:'')); ?>">click here</a><?php  
                                                //$description=$event->description?$event->description:'';
                                               // echo  $string = word_limiter($description, 15);?></p>
                                    </div>
                                </div>
                                <div class="fs-6 px-4 py-2 rounded text-nowrap mt-2 mt-sm-0 ms-sm-2">
                                    About <?php 
                                    $created_date=$notificationinfo->created_date?$notificationinfo->created_date:'';
                                    datetimeagoformate($created_date);
                                    ?>
                                </div>
                            </div>
                            <hr>
                        <?php }?>
                        <?php }elseif($notificationinfo->notification_type==3){
                        //  forum notification 
                         $forum=$this->db->select('a.*,b.picture')
                        ->from('forum_tbl a')
                        //  ->join('picture_tbl b','b.from_id=a.forum_id')
                        ->join('picture_tbl b', 'b.from_id = a.forum_id', 'left')
                        ->where('a.forum_id',$notificationinfo->notification_id)
                        ->where('a.enterprise_id',$enterprise_id)
                        ->where('a.status',1)
                        ->get()
                        ->row();
                      
                    ?>
                     <div class="d-sm-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="<?php echo base_url(!empty($forum->picture) ? $forum->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/default.jpg'); ?>"
                                class="mr-3" alt=""     width="150px">
                            <div class="ms-4">
                                <a href="<?php echo base_url($enterprise_shortname.'/forum-details/'.($forum?$forum->forum_id:'')); ?>" class="btn btn-primary mb-2">Forum</a>
                                <h5 class="mb-2"><a class="text-dark" href="<?php echo base_url($enterprise_shortname.'/forum-details/'.($forum?$forum->forum_id:'')); ?>"><?php echo (!empty($forum->title) ? $forum->title : ''); ?></a></h5>
                                <p class="mb-0"><?php  
                                            $description=(!empty($forum->description) ? $forum->description : '');
                                           echo  $string = word_limiter($description, 15);?></p>
                            </div>
                        </div>
                        <div class="fs-6 px-4 py-2 rounded text-nowrap mt-2 mt-sm-0 ms-sm-2">
                            About <?php 
                             $created_date=$notificationinfo->created_date?$notificationinfo->created_date:'';
                            datetimeagoformate($created_date);
                            ?>
                        </div>
                    </div>
                    <hr>
                    <?php  }elseif($notificationinfo->notification_type==4){
                    
                        $course=$this->db->select('a.name,a.course_id,a.course_type,a.description,a.created_date,b.picture')
                        ->from('course_tbl a')
                        ->join('picture_tbl b', 'b.from_id = a.course_id', 'left')
                        ->where('a.course_id',$notificationinfo->notification_id)
                        ->where('a.enterprise_id',$enterprise_id)
                        ->where('a.status',1)
                        ->get()
                        ->row();
                    ?>

                        <div class="d-sm-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="<?php echo base_url(!empty($course->picture) ?  $course->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/default.jpg'); ?>"
                                    class="mr-3" alt=""     width="150px">
                                <div class="ms-4">
                                    <a <?php echo base_url($enterprise_shortname.'/course-details/'.($course?$course->course_id:'')); ?> class="btn btn-primary mb-2">Offer & Update</a>
                                    <h5 class="mb-2"><a class="text-dark" href="<?php echo base_url($enterprise_shortname.'/course-details/'.($course?$course->course_id:'')); ?>"><?php echo  ($course->name?$course->name:'');?></a></h5>
                                    <p class="mb-0"><?php  
                                            $description= $course->description? $course->description:'';
                                            echo  $string = word_limiter($description, 15);?></p>
                                </div>
                            </div>
                            <div class="fs-6 px-4 py-2 rounded text-nowrap mt-2 mt-sm-0 ms-sm-2">
                                About <?php 
                                $created_date=$notificationinfo->created_date?$notificationinfo->created_date:'';
                                datetimeagoformate($created_date);
                                ?>
                            </div>
                        </div>
                        <hr>
                    <?php }elseif($notificationinfo->notification_type==6){
                      $project =$this->db->select('*')->from("project_tbl")->where('project_id',$notificationinfo->notification_id)->get()->row();

                        if($notificationinfo->type== 1){
                        ?>
                            <div class="d-sm-flex justify-content-between align-items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <img src="<?php  echo base_url((!empty($project->coverpic) ? $project->coverpic : default_600_400()));?>"
                                        class="mr-3" alt=""     width="150px">
                                    <div class="ms-4">
                                        <!-- <a <?php //echo base_url($enterprise_shortname.'/student-project-view/'.($project?$project->project_id:'')); ?> class="btn btn-primary mb-2">Offer & Update</a> -->
                                        <h5 class="mb-2"><a class="text-dark" href="<?php echo base_url($enterprise_shortname.'/student-project-view/'.($project?$project->project_id:''));; ?>"><?php echo  ($project?$project->title:'');?></a></h5>
                                        <p class="mb-0"> Your project <b><?php echo $project->title;?></b>- is approved successfully.</p>
                                    </div>
                                </div>
                                <div class="fs-6 px-4 py-2 rounded text-nowrap mt-2 mt-sm-0 ms-sm-2">
                                    About <?php 
                                    $created_date=$notificationinfo->created_date?$notificationinfo->created_date:'';
                                    datetimeagoformate($created_date);
                                    ?>
                                </div>
                            </div>
                            <hr>
                        <?php }elseif($notificationinfo->type== 2){?>
                            <div class="d-sm-flex justify-content-between align-items-center mb-4">
                                <div class="d-flex align-items-center">
                                    <img src="<?php  echo base_url((!empty($project->coverpic) ? $project->coverpic : default_600_400()));?>"
                                        class="mr-3" alt=""     width="150px">
                                    <div class="ms-4">
                                        <!-- <a <?php //echo base_url($enterprise_shortname.'/student-project-view/'.($project?$project->project_id:'')); ?> class="btn btn-primary mb-2">Offer & Update</a> -->
                                        <h5 class="mb-2"><a class="text-dark" href="<?php echo base_url($enterprise_shortname.'/student-project-view/'.($project?$project->project_id:''));; ?>"><?php echo  ($project?$project->title:'');?></a></h5>
                                        <p class="mb-0"> Your project <b><?php echo $project->title;?></b>- is rejected and submit again.</p>
                                        <p class="mb-0"> <b>Reason</b>-<?php echo $project->comment;?></p>
                                    </div>
                                </div>
                                <div class="fs-6 px-4 py-2 rounded text-nowrap mt-2 mt-sm-0 ms-sm-2">
                                    About <?php 
                                    $created_date=$notificationinfo->created_date?$notificationinfo->created_date:'';
                                    datetimeagoformate($created_date);
                                    ?>
                                </div>
                            </div>
                            <hr>
                        <?php }?>
                   <?php }elseif($notificationinfo->notification_type==8){
                         $course=$this->db->select('a.name,a.course_id,a.course_type,a.description,a.created_date,b.picture')
                         ->from('course_tbl a')
                         ->join('picture_tbl b', 'b.from_id = a.course_id', 'left')
                         ->where('a.course_id',$notificationinfo->notification_id)
                         ->where('a.enterprise_id',$enterprise_id)
                         ->where('a.status',1)
                         ->get()
                         ->row();
                        //  d($course->course_id);
                        //  d($course);
                         
                         
                    ?>
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-items-center">
                                <img src="<?php  echo base_url(!empty($course->picture) ?  $course->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/default.jpg'); ?>"
                                    class="mr-3" alt=""     width="150px">
                                <div class="ms-4">
                                    <!-- <a <?php echo base_url($enterprise_shortname.'/course-details/'.($course?$course->course_id:'')); ?> class="btn btn-primary mb-2">Offer & Update</a> -->
                                    <h5 class="mb-2"><a class="text-dark" href="<?php echo base_url($enterprise_shortname.'/course-details/'.($course?$course->course_id:'')); ?>"><?php echo  ($course?$course->name:'');?></a></h5>
                                    <p class="mb-0"><?php echo $notificationinfo->message; ?></p>
                                </div>
                            </div>
                            <div class="fs-6 px-4 py-2 rounded text-nowrap mt-2 mt-sm-0 ms-sm-2">
                                About <?php 
                                $created_date=$notificationinfo->created_date?$notificationinfo->created_date:'';
                                datetimeagoformate($created_date);
                                ?>
                            </div>
                        </div>
                        <hr>
                    <?php }elseif($notificationinfo->notification_type==9){?>
                
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <div class="d-flex align-items-center">
                                <!-- <img src="<?php  echo base_url(!empty($course->picture) ?  $course->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/default.jpg'); ?>"
                                    class="mr-3" alt=""     width="150px"> -->
                                <div class="ms-4">
                                    <!-- <a <?php echo base_url($enterprise_shortname.'/course-details/'.($course?$course->course_id:'')); ?> class="btn btn-primary mb-2">Offer & Update</a> -->
                                    <!-- <h5 class="mb-2"><a class="text-dark" href="<?php echo base_url($enterprise_shortname.'/course-details/'.($course?$course->course_id:'')); ?>"><?php echo  ($course?$course->name:'');?></a></h5> -->
                                    <p class="mb-0">Your subscription package has been expired for 5 days left and please <a href="<?php echo base_url($enterprise_shortname.'/subscription-details'); ?>"><b>click here</b></a> update it.</p>
                                </div>
                            </div>
                            <div class="fs-6 px-4 py-2 rounded text-nowrap mt-2 mt-sm-0 ms-sm-2">
                                About <?php 
                                $created_date=$notificationinfo->created_date?$notificationinfo->created_date:'';
                                datetimeagoformate($created_date);
                                ?>
                            </div>
                        </div>
                        <hr>
                     <?php  }}?>
                     <?php echo $links;?>

                  </div>
              </div>
          </div>
      </div>
      <!--End Experience-->

      <!--Start Experience-->
      <!-- <div class="bg-alice-blue py-5">
          <div class="container-lg">
              <div class="card border-0 rounded-0 shadow-sm">
                  <div class="card-body p-4 p-xl-5">
                      <div class="d-flex align-items-center justify-content-between mb-4">
                           Start Section Header
                          <div class="section-header">
                              <h4>Course Updates</h4>
                              <div class="section-header_divider"></div>
                          </div>
                          End Section Header
                          <div>
                              <select class="form-select rounded-0" aria-label="Default select example">
                                  <option selected>All</option>
                                  <option value="1">Message</option>
                                  <option value="2">Course</option>
                                  <option value="3">Quiz</option>
                                  <option value="4">Project</option>
                                  <option value="5">Certificate</option>
                              </select>
                          </div>
                      </div>
                      <hr>
                      <div class="d-sm-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center">
                              <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/1.jpg'); ?>"
                                  class="mr-3" alt="">
                              <div class="ms-4">
                                  <button type="button" class="btn btn-primary mb-2">Instructor</button>
                                  <h5 class="mb-2">New Registration: Financial Banking Courses</h5>
                                  <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting.</p>
                              </div>
                          </div>
                          <div class="fs-6 px-4 py-2 rounded text-nowrap mt-2 mt-sm-0 ms-sm-2">
                              About 5 hours ago
                          </div>
                      </div>
                      <hr>
                      <div class="d-sm-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center">
                              <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/2.jpg'); ?>"
                                  class="mr-3" alt="">
                              <div class="ms-4">
                                  <button type="button" class="btn btn-danger mb-2">Subscription</button>
                                  <h5 class="mb-2">New Registration: Financial Banking Courses</h5>
                                  <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting.</p>
                              </div>
                          </div>
                          <div class="fs-6 px-4 py-2 rounded text-nowrap mt-2 mt-sm-0 ms-sm-2">
                              About 5 hours ago
                          </div>
                      </div>
                      <hr>
                      <div class="d-sm-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center">
                              <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/3.jpg'); ?>"
                                  class="mr-3" alt="">
                              <div class="ms-4">
                                  <button type="button" class="btn btn-info mb-2">Offers &amp; Updates</button>
                                  <h5 class="mb-2">New Registration: Financial Banking Courses</h5>
                                  <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting.</p>
                              </div>
                          </div>
                          <div class="fs-6 px-4 py-2 rounded text-nowrap mt-2 mt-sm-0 ms-sm-2">
                              About 5 hours ago
                          </div>
                      </div>
                      <hr>
                      <div class="d-sm-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center">
                              <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/4.jpg'); ?>"
                                  class="mr-3" alt="">
                              <div class="ms-4">
                                  <button type="button" class="btn btn-success mb-2">Event</button>
                                  <h5 class="mb-2">New Registration: Financial Banking Courses</h5>
                                  <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting.</p>
                              </div>
                          </div>
                          <div class="fs-6 px-4 py-2 rounded text-nowrap mt-2 mt-sm-0 ms-sm-2">
                              About 5 hours ago
                          </div>
                      </div>
                      <hr>
                      <div class="d-sm-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center">
                              <img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/1.jpg'); ?>"
                                  class="mr-3" alt="">
                              <div class="ms-4">
                                  <button type="button" class="btn btn-warning mb-2">Subscription</button>
                                  <h5 class="mb-2">New Registration: Financial Banking Courses</h5>
                                  <p class="mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting.</p>
                              </div>
                          </div>
                          <div class="fs-6 px-4 py-2 rounded text-nowrap mt-2 mt-sm-0 ms-sm-2">
                              About 5 hours ago
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div> -->
      <!--End Experience-->