	<!--Start Student Account Settings-->
	<div class="py-5">
		<div class="container-lg">
			<div class="row justify-content-center">
				<div class="col-xl-10">
					<div class="row justify-content-between">
						<div class="col-md-4 col-lg-3 sticky-content">
							<h3 class="fw-semi-bold mb-4">Settings</h3>
							<!--Start Settings Nav-->
                            <ul class="settings-nav list-unstyled">
								<li><a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-account-settings'); ?>"><i data-feather="key" class="me-2"></i>Account</a></li>
								<li><a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-notification-settings'); ?>"><i data-feather="bell" class="me-2"></i>Notifications</a></li>
								<!-- <li><a href="#"><i data-feather="pocket" class="me-2"></i>Manage Subscription (Beta)</a></li> -->
								<li><a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-affiliation-settings'); ?>"><i data-feather="command" class="me-2"></i>Manage Affiliation</a></li>
								<li><a href="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'). '/instructor-payment-setting'); ?>" class="active"><i data-feather="credit-card" class="me-2"></i>Payments & Payouts</a></li>
							</ul>
                            <!--End Settings Nav-->
						</div>
						<div class="col-md-8 col-lg-8 sticky-content">
							<h3 class="fw-semi-bold">Payouts</h3>
							<hr>
							<div class="d-flex align-items-center justify-content-between mb-3">
								<!--Start Section Header-->
								<div class="section-header">
									<h5 class="mb-0">Subscription</h5>
								</div>
								<!--End Section Header-->
								<div><button type="button" class="btn btn-dark-cerulean">Cancel Subscription</button></div>
							</div>
							<p>Your next yearly charge of $20451 will be applied to your payment method on October 08, 2021</p>
							<hr>
							<h5>Payments Account</h5>
							<p>In order to earn money, you'll need to set up your payment account</p>
							<a href="#" class="border-bottom">Learn More About Our company</a>
							<h5 class="mt-5 mb-3">Payout Account</h5>
							<div class="card text-center col-lg-6 py-4 mb-4">
								<div class="card-body">
									<img src="assets/img/brand-logo/PayPal_logo.png" class="mb-3" alt="">
									<p>We'll send your payouts to your Paypal account</p>
									<a href="#" class="btn btn-success px-4">Connect</a>
								</div>
							</div>
							<a href="#" class="border-bottom">Add a payout account</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--End Student Account Settings-->