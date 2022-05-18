<?php 
$user_id = $this->session->userdata('user_id');
$user_type=$this->session->userdata('user_type');
?>
<!-- <div class="py-5">
            <div class="container-lg">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="row mx-0 align-items-center border-md rounded-3">
                            <?php 
                          
                            foreach($subscription_info as $subscription){
                                
                                ?>
                            <div class="col-md-4 p-4 p-sm-5">
                                <div class="mb-4">
                          
                                </div>
                                <h2><b><?php echo $subscription->title;?></b></h2>
                                <h4 class="h3 mb-4 mb-sm-5"><?php if($subscription->is_free==1){ echo "Free";}else{ echo "Premium";}?></h4>
                                <p>Star Date : <?php echo $subscription->start_time;?></p>
                                <p>End Date : <?php echo $subscription->end_time;?></p>
                                <p>Duration : <?php if($subscription->duration==1){ echo "Monthly";}elseif($subscription->duration==2){ echo "Yearly" ;}else{ echo "Free";}?></p>
                                <?php echo $subscription->description;?>
                                <div class="mb-4">
                                   <a class='btn btn-primary' href="<?php echo base_url($enterprise_shortname.'/subscription-checkout/'.$subscription->subscription_id); ?>">Checkout</a>
                                 
                                 </div>

                            </div>
                            <?php }?>

                        </div>
                    </div>
                </div>
            </div>
        </div> -->


        <div class="pricing-content bg-alice-blue py-5">
		<div class="container-lg">
			<div class="text-center mb-5">
				<h3 class="fw-bold mb-1">Ready To Start?</h3>
				<!-- <div class="">Save 30% an annual plan.we support bKASH/ Nagad for an individual<br> annual plan only.Any Question ? <a href="#">Contact Us</a></div> -->
			</div>
			<div class="row justify-content-center">
				<div class="col-xl-10">
					<div class="pricing-container">
						<ul class="bounce-invert d-flex g-3 justify-content-center list-unstyled mb-0 mt-5 pricing-list row">
						
							<?php foreach($subscription_info as $subscription){
								if($subscription->duration==1 || $subscription->duration==2){
							?>
							<li class="col-sm-6 col-md-6 col-lg-4 d-flex exclusive">
								<ul class="pricing-wrapper list-unstyled position-relative">
									<li class="d-flex flex-wrap h-100 align-content-between">
										<?php 
										if($subscription->oldprice){ ?>   
										<h6 class=" p-2 position-absolute rounded-pill start-50 text-capitalize text-center translate-middle w-sub text-white" style="background-color:#fe0000;">Limited time only</h6>
										<?php }?>
										<header class="pricing-header text-center pt-5 pb-4 w-100">
											<?php if($subscription->duration==3){?>
                                             <h2 class="mb-0"><?php echo $subscription->title?$subscription->title:'';?></h2>
		                                        <div class="price">
		                                            <span class="value fw-semi-bold">Free</span>
		                                       </div>
											<?php }elseif ($subscription->duration==4) {?>
                                            <div class="price">
	                                            <span class="fs-1 fw-bold lh-md2">Enterprise <br> Package</span>
	                                        </div>
										   <?php }else{?>
											<h2><?php echo $subscription->title;?></h2>
											<?php if($subscription->oldprice){ ?>   
											<h6 class="mx-auto p-2 rounded text-capitalize text-center text-warning w-sub" style="background-color: #15243a;">Before :BDT <del><?php echo $subscription->oldprice;?></del>/<?php if($subscription->duration==1){ echo "monthly";}elseif($subscription->duration==2){ echo "yearly" ;}else{ echo "Free";}?></h6>
											<!-- <span>End Time <p id="example"></p></span> -->
											<?php }?>
											<div class="align-items-center d-flex justify-content-center price">
												<span class="currency fs-5 fw-bold mt-0">BDT</span>
												<span class="fw-bold value"><?php echo html_escape(number_format($subscription->price)); ?></span>
												<span class="duration fw-bold text-lowercase text-white"><?php if($subscription->duration==1){ echo "Monthly";}elseif($subscription->duration==2){ echo "Yearly" ;}else{ echo "Free";}?></span>
											</div>
										  <?php }?>
											<!-- <p class="mb-0">Per Month / billed Monthly</p> -->
										</header>
										<div class="pricing-body w-100">

											<ul class="list-unstyled pricing-features px-5 text-start">
												<?php 
												if($subscription->course_sub_content){
													$course_content=json_decode($subscription->course_sub_content);
												 }
												foreach($course_content as $contentval){
												 ?>

												<li>
													<svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="12.574" height="9.234" viewBox="0 0 12.574 9.234">
														<path data-name="Path 8" d="M12.389,68.182a.629.629,0,0,0-.889,0L3.968,75.714l-2.9-2.9a.629.629,0,0,0-.889.889l3.34,3.34a.629.629,0,0,0,.889,0l7.977-7.977A.629.629,0,0,0,12.389,68.182Z" transform="translate(0 -67.997)" fill="#fff" />
													</svg>
													<?php echo html_escape($contentval);?>
												</li>
											   <?php }?>
												
											</ul>
											<p class="mx-5"><?php echo $subscription->description;?></p>
										</div>
										<footer class="pricing-footer">
											<a class="select d-inline-flex justify-content-center align-items-center" href="<?php echo base_url($enterprise_shortname.'/subscription-checkout/'.$subscription->subscription_id); ?>">
												<div class="btn-icon d-flex align-items-center justify-content-center me-2">
													<svg xmlns="http://www.w3.org/2000/svg" width="15.793" height="15.793" viewBox="0 0 15.793 15.793">
														<path data-name="Path 357" d="M15.3,1.922,13.87.491a1.679,1.679,0,0,0-2.372,0L.851,11.139a.471.471,0,0,0-.128.243L.008,15.246a.463.463,0,0,0,.539.539l3.864-.716a.471.471,0,0,0,.243-.128L15.3,4.294A1.676,1.676,0,0,0,15.3,1.922ZM1.04,14.753l.433-2.338,1.9,1.9Zm3.287-.792L1.833,11.466l9.106-9.107,2.494,2.494ZM14.647,3.639l-.56.56L11.593,1.705l.56-.56a.752.752,0,0,1,1.063,0l1.431,1.431A.751.751,0,0,1,14.647,3.639Z" transform="translate(0 0)" fill="#fff"></path>
													</svg>
												</div>
												Subscribe
											</a>
										</footer>
									</li>
								</ul>
							</li>
							<?php }}?>
						
						</ul>
					</div>
				</div>
			</div>
			<div class="text-center mt-5">
				<?php echo !empty($get_appseeting->subscription_savetitle) ? $get_appseeting->subscription_savetitle : ''; ?> <br> <?php echo display('any_question');?>
            ? <a href="<?php echo base_url($enterprise_shortname . '/contact'); ?>">Contact Us</a>

			</div>
		</div>
	</div>
	