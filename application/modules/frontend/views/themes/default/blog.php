
	<!--Start Course Preview Header-->
	<div class="hero-header text-white position-relative bg-img" data-image-src="<?php echo base_url(!empty(getappsettings($enterprise_id)->forum_header_image) ? getappsettings($enterprise_id)->forum_header_image : default_600_400()); ?>">
		<div class="container-lg hero-header_wrap position-relative">
			<div class="row align-items-end my-5">
				<div class="col-8 offset-2 text-center">
					<h1 class="fw-semi-bold mb-3">Forum</h1>
					<!-- <h5>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries.</h5> -->
				</div>
			</div>
		</div>
	</div>
	<!--End Course Preview Header-->
	<div class="bg-alice-blue pt-5">
		<div class="container-xl">
			<div class="row g-4">
				<div class="col-lg-8 sticky-content">
					<div class="row mb-4 g-3">
                        <?php 
						 foreach($get_forumlist as $forum_data){
						?>
						<div class="col-sm-6">
							<!--Start Course Card-->
							<div class="course-card rounded bg-white position-relative overflow-hidden shadow-none border">
								<!--Start Course Image-->
								<a href="<?php echo base_url($enterprise_shortname.'/forum-details/'.$forum_data->forum_id); ?>" class="course-card_img">
									<img src="<?php echo base_url((!empty($forum_data->picture)?$forum_data->picture:default_600_400()));?>" class="img-fluid w-100" alt="">
								</a>
								<!--End Course Image-->
								<!--Start Course Card Body-->
								<div class="course-card_body bg-prussian-blue p-4 position-relative m-0 rounded-0 bg-white">
									<!--Start Course Title-->
									<div class="badge px-0 mb-2">
										<a href="<?php echo base_url($enterprise_shortname.'/forum-category-page/'.$forum_data->category_id); ?>" class="text-danger fs-6"><?php echo $forum_data->cat_name;?></a>
									</div>
									<h3 class="course-card__course--title text-capitalize fs-6">
										<a href="<?php echo base_url($enterprise_shortname.'/forum-details/'.$forum_data->forum_id); ?>" class="text-dark text-decoration-none"><?php echo (!empty($forum_data->title)?$forum_data->title:'');?></a>
									</h3>
									<!--End Course Title-->
									<!--Start Course instructor-->
									<div class="course-card__instructor mb-3">
										<div class="course-card__instructor--name text-black-50 text-uppercase fw-medium fs-13"><?php 
											$description = word_limiter($forum_data->description, 10);
											echo (!empty($description) ? $description : ''); ?>
							            </div>
									</div>
									<!--End Course instructor-->
									<!-- <div class="d-flex justify-content-between">
										<div class="avatar d-flex align-items-center">
											<div class="avatar-img blog me-3">
												<img src="assets/img/avatar-01.jpg" alt="">
											</div>
											<div class="avatar-text">
												<h6 class="avatar-name mb-0">Mostofa S. Farooki</h6>
												<div class="avatar-designation">Writer, Director &amp; Arts</div>
											</div>
										</div>
										<div class="">
											<div>8 Min Read</div>
										</div>
									</div> -->
									<!--Start Course Hints-->
								</div>
								<!--End Course Card Body-->
							</div>
							<!--End Course Card-->
						</div>
                        <?php }?>
					</div>
					<div class="row mb-4 g-3">
						<div class="col-sm-6">
						<?php echo $links;?>
						</div>
					</div>
				</div>
				<div class="col-lg-4 sticky-content">
					<div class="sidebar-block mb-4 p-4 bg-white box-shadow">
						<!--Start Section Header-->
						<div class="section-header mb-4">
							<h4 class="h5">Recent Post</h4>
							<div class="section-header_divider"></div>
						</div>
						<!--End Section Header-->
						<?php 
						 $recent_post_list= $this->db->select('a.forum_id,a.title')
						 ->from('forum_tbl a')
						 ->where('a.enterprise_id', $enterprise_id)
						 ->order_by('id','desc')
						 ->limit(5)->get()->result();
						 foreach($recent_post_list as $recent_post){
						?>
						<div class="d-flex align-items-center mb-3">
							<a href="<?php echo base_url($enterprise_shortname.'/forum-details/'.$recent_post->forum_id); ?>" class="text-dark">
								 <?php echo $recent_post->title;?>
							</a>
						</div>
						<?php }?>
						
					</div>
					<div class="sidebar-block bg-white box-shadow mb-4 p-4">
						<!--Start Section Header-->
						<div class="section-header mb-4">
							<h4 class="h5">Categories</h4>
							<div class="section-header_divider"></div>
						</div>
						<!--End Section Header-->
						<ul class="mb-0 list-unstyled">
							<?php 
							$category_list= $this->db->select('a.forum_category_id,a.title')
							->from('forum_category_tbl a')
							->where('a.enterprise_id', $enterprise_id)
							->order_by('id','desc')
							->limit(10)->get()->result();
							foreach($category_list as $category){
							?>
							<li class="mb-1">
								<a href="<?php echo base_url($enterprise_shortname.'/forum-category-page/'.$category->forum_category_id); ?>" class="text-dark"><i data-feather="arrow-right" class="me-2 width-15"></i><?php echo $category->title;?></a>
							</li>
							<?php }?>
						</ul>
					</div>
					<div class="sidebar-block bg-white box-shadow mb-4 p-4" data-image-src="assets/img/sidebar-bg-02.jpg">
						<!--Start Section Header-->
						<div class="section-header mb-4">
							<h4 class="h5">Archive</h4>
							<div class="section-header_divider"></div>
						</div>
						<!--End Section Header-->
						<ul class="mb-0 list-unstyled">
							<li class="mb-1">
								<a href="#" class="text-dark"><i data-feather="arrow-right" class="me-2 width-15"></i>March-2021</a>
							</li>
							<li class="mb-1">
								<a href="#" class="text-dark"><i data-feather="arrow-right" class="me-2 width-15"></i>Feb-2021</a>
							</li>
							<li class="mb-1">
								<a href="#" class="text-dark"><i data-feather="arrow-right" class="me-2 width-15"></i>Jan-2021</a>
							</li>
							<li class="mb-1">
								<a href="#" class="text-dark"><i data-feather="arrow-right" class="me-2 width-15"></i>Dec-2020</a>
							</li>
						</ul>
					</div>					
					<div class="sidebar-block bg-white box-shadow mb-4 p-4">
						<!--Start Section Header-->
						<div class="section-header mb-4">
							<h4 class="h5">Tags</h4>
							<div class="section-header_divider"></div>
						</div>
						<!--End Section Header-->
						<!--Start Tags-->
						<div class="tags">
							<a href="#" class="tag-link text-dark text-decoration-none d-inline-block mb-1 px-3 py-2 border">Business</a>
							<a href="#" class="tag-link text-dark text-decoration-none d-inline-block mb-1 px-3 py-2 border">E-commerce</a>
							<a href="#" class="tag-link text-dark text-decoration-none d-inline-block mb-1 px-3 py-2 border">Course</a>
							<a href="#" class="tag-link text-dark text-decoration-none d-inline-block mb-1 px-3 py-2 border">Dashboard</a>
							<a href="#" class="tag-link text-dark text-decoration-none d-inline-block mb-1 px-3 py-2 border">Landings</a>
							<a href="#" class="tag-link text-dark text-decoration-none d-inline-block mb-1 px-3 py-2 border">Marketing</a>
						</div>
						<!--End Tags-->
					</div>
				</div>
			</div>
		</div>
	</div>