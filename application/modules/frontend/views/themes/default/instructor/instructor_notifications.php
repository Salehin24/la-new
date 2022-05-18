<!--Start Experience-->
<?php 
	$user_id = $this->session->userdata('user_id');
?>
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
                    //   $allnotification=$this->db->select("*")->from("notifications_tbl")->where('student_id',$user_id)->where('enterprise_id',$enterprise_id)->order_by("id", "desc")->limit(20)->get()->result();
                   
                      foreach($allnotification as $notificationinfo){
                         if($notificationinfo->notification_type==1){
                         
                             //  course notification 
                             $course=$this->db->select('a.*,b.picture')
                             ->from('course_tbl a')
                             ->join('picture_tbl b', 'b.from_id = a.course_id', 'left')
                             ->where('a.course_id',$notificationinfo->notification_id)
                             ->where('a.enterprise_id',$enterprise_id)
                            //  ->where('a.status',1)
                             ->get()
                             ->row();

                            $course_types = json_decode($course->course_type);
                            ?>
                              <?php if($notificationinfo->type =='1'){?>
                              <?php //if(in_array(1,$course_types) && in_array(2,$course_types)){?>
                                <div class="d-sm-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-start">
                                        <img src="<?php echo base_url(!empty($course->picture) ?  $course->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/default.jpg'); ?>"
                                            class="mr-3" alt=""     width="150px">
                                        <div class="ms-4">
                                            <!-- <a href="<?php echo base_url($enterprise_shortname.'/course-details/'.$course->course_id); ?>" class="btn btn-primary mb-2">Purchases & Subscription</a> -->
                                            <h5 ><a class="text-dark" href="<?php echo base_url($enterprise_shortname.'/course-details/'.($course?$course->course_id:'')); ?>"><?php echo  $course->name?$course->name:'';?></a></h5>
                                            <p class="mb-0">Your course has been published successfully by <?php  echo get_userinfo($course->published_by)->name; ?><?php   //$description= $course->description? $course->description:'';  echo  $string = word_limiter($description, 15);?></p>
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
                                <?php }elseif($notificationinfo->type ==2){?>
                                    <div class="d-sm-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-start">
                                            <img src="<?php echo base_url(!empty($course->picture) ?  $course->picture :'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/academy/default.jpg'); ?>"
                                                class="mr-3" alt=""     width="150px">
                                            <div class="ms-4">
                                                <!-- <a href="<?php echo base_url($enterprise_shortname.'/course-details/'.$course->course_id); ?>" class="btn btn-primary mb-2">Purchases & Subscription</a> -->
                                                <h5 ><a class="text-dark" href="<?php echo base_url($enterprise_shortname.'/course-details/'.($course?$course->course_id:'')); ?>"><?php echo  $course->name?$course->name:'';?></a></h5>
                                                <p class="mb-0">Your course has been cancelled by <?php  echo get_userinfo($course->published_by)->name; ?><?php   //$description= $course->description? $course->description:'';  echo  $string = word_limiter($description, 15);?></p>
                                                <p class="mb-0"><b>Resson</b>  <?php   $feedback= $course->feedback? $course->feedback:''; echo $feedback; //echo  $string = word_limiter($feedback, 15);?></p>
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

                        <?php }}?>
                    <?php }?>

                    <?php echo $links;?>

				</div>
			</div>
		</div>
	</div>
	<!--End Experience-->

	<!--Start Experience-->

	<!--End Experience-->