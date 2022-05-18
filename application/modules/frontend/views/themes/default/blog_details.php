<!--Start Course Preview Header-->
<div class="hero-header text-white position-relative bg-img" data-image-src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/header-bg-02.jpg');?>">
		<div class="container-lg hero-header_wrap position-relative">
			<div class="row align-items-end my-5">
				<div class="col-8 offset-2 text-center">
					<h1 class="fw-semi-bold mb-3">Forum Details</h1>
				</div>
			</div>
		</div>
	</div>
<meta property="og:title" content="ggggggggggggggggggggggggggggggggggggggggggggggggggggggggg"/>
<meta property="og:image" content="<?php echo base_url((!empty($get_forum_details->picture)?$get_forum_details->picture:default_600_400()));?>"/>
<meta property="og:url" content="https://lead.academy"/>
<meta property="og:description" content="social media sharing buttons php onlinecode.org"/>
<?php 
    // pass web-site url
    $site_url  = 'https://lead.academy/';
    // post title
    $site_title  = $get_forum_details->title;
?>

<!-- <a> tab for http://www.onlinecode/blog share link for social media -->
<!-- <div id="button_share"> -->
    
    
    <!-- Facebook Social Media -->
    <!-- <a href="http://www.facebook.com/sharer.php?u=<?php echo $site_url?>" target="_blank">
        <img src="http://www.onlinecode/example/images/facebook.png" alt="Facebook share link" />
    </a> -->
    
   
<!-- </div> -->
	<!--End Course Preview Header-->
	<div class="bg-alice-blue pt-5">
		<div class="container-lg">
			<div class="row">
				<div class="col-xl-10 offset-xl-1 sticky-content">
					<div class="blog_single mb_50">
						<div class="row">
							<div class="col-lg-10 text-justify  my-5">
								<div class="badge px-0 mb-2">
									<a href="<?php echo base_url($enterprise_shortname.'/forum-category-page/'.$get_forum_details->category_id); ?>" class="text-danger fs-6"><?php echo $get_forum_details->cat_name; ?></a>
								</div>
								<h2 class="mb-4"><?php echo $get_forum_details->title; ?></h2>
								<!-- <div class="mb-5">4 min read</div> -->
								<div class="row mb-4 border-top pt-4 justify-content-between mx-0">
									<div class="col-md-8">
										<div class="avatar d-flex align-items-center">
											<!-- <div class="avatar-img blog me-3">
												<img src="assets/img/avatar-01.jpg" alt="">
											</div> -->
											<!-- <div class="avatar-text">
												<h6 class="avatar-name mb-0">Mostofa S. Farooki</h6>
												<div class="avatar-designation">Writer, Director &amp; Arts</div>
											</div> -->
										</div>
									</div>
									<div class="col-md-4">
										<div class="text-end">
										<ul class="list-unstyled d-flex justify-content-end">
												<li class="me-2"><span>Share</span></li>
												<li class="me-2"><a  class="text-dark-cerulean" href="http://www.facebook.com/sharer.php?u=<?php echo base_url($enterprise_shortname.'/forum-details/'.$get_forum_details->forum_id); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
												<li class="me-2"><a href="https://twitter.com/share?text=<?php echo $get_forum_details->title;?> &url=<?php echo base_url($enterprise_shortname.'/forum-details/'.$get_forum_details->forum_id); ?> " target="_blank" class="text-dark-cerulean"><i class="fab fa-twitter"></i></a></li>
												<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo base_url($enterprise_shortname.'/forum-details/'.$get_forum_details->forum_id); ?>"  target="_blank"  class="text-dark-cerulean"><i class="fab fa-linkedin"></i></a></li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						<img class="img-fluid" src="<?php echo base_url((!empty($get_forum_details->picture)?$get_forum_details->picture:default_600_400()));?>" alt="">
						<div class="blog_content">
							<div class="row">
								<div class="col-lg-10 text-justify my-5">
									<?php echo $get_forum_details->description; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
            <?php 
            $related_post=$this->db->select('a.*,a.title, b.picture,c.title as cat_name')
            ->from('forum_tbl a')
            ->join('picture_tbl b', 'b.from_id = a.forum_id', 'left')
            ->join('forum_category_tbl c', 'c.forum_category_id = a.category_id', 'left')
            ->where('a.category_id', $get_forum_details->category_id)
            ->where_not_in('a.forum_id',$get_forum_details->forum_id)
            ->where('a.enterprise_id', $enterprise_id)
            ->order_by('id','desc')
            ->limit('9')
            ->get()->result();
            if( $related_post){
            foreach( $related_post as $related_post_list){
            ?>
				<div class="col-lg-4">
					<!--Start Course Card-->
					<div class="course-card mb-4 rounded bg-white position-relative overflow-hidden shadow-none border">
						<!--Start Course Image-->
						<a href="<?php echo base_url($enterprise_shortname.'/forum-details/'.$related_post_list->forum_id); ?>" class="course-card_img">
							<img src="<?php echo base_url((!empty($related_post_list->picture)?$related_post_list->picture:'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/course/08.jpg'))?>" class="img-fluid w-100" alt="">
						</a>
						<!--End Course Image-->
						<!--Start Course Card Body-->
						<div class="course-card_body bg-prussian-blue p-4 position-relative m-0 rounded-0 bg-white">
							<!--Start Course Title-->
							<div class="badge px-0 mb-2">
								<a href="<?php echo base_url($enterprise_shortname.'/forum-category-page/'.$related_post_list->category_id); ?>" class="text-danger fs-6"><?php echo (!empty($related_post_list->cat_name) ? $related_post_list->cat_name : '');?></a>
							</div>
							<h3 class="course-card__course--title text-capitalize fs-6">
								<a href="<?php echo base_url($enterprise_shortname.'/forum-details/'.$related_post_list->forum_id); ?>" class="text-dark text-decoration-none"><?php echo $related_post_list->title;?></a>
							</h3>
							<!--End Course Title-->
							<!--Start Course instructor-->
							<div class="course-card__instructor mb-3">
								<div class="course-card__instructor--name text-black-50 text-uppercase fw-medium fs-13"><?php 
											$description = word_limiter($related_post_list->description, 10);
											echo (!empty($description) ? $description : ''); ?></div>
							</div>
							<!--End Course instructor-->
							<!-- <div class="row mb-4">
								<div class="col-md-8">
									<div class="avatar d-flex align-items-center">
										<div class="avatar-img blog me-3">
											<img src="assets/img/avatar-01.jpg" alt="">
										</div>
										<div class="avatar-text">
											<h6 class="avatar-name mb-0">Mostofa S. Farooki</h6>
											<div class="avatar-designation">Writer, Director &amp; Arts</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div>8 Min Read</div>
								</div>
							</div> -->
							<!--Start Course Hints-->
						</div>
						<!--End Course Card Body-->
					</div>
					<!--End Course Card-->
				</div>
		    <?php }}?>
			</div>
		</div>
	</div>