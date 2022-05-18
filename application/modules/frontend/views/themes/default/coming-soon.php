
	
	<div class="align-items-center d-flex py-5 full_page_cover">
		<div class="container-lg">
			<div class="row g-3 align-items-center reverse-md">
				<div class="col-xl-4 offset-xl-2 col-md-6">
					<h2 class="fw-bolder text-dark-cerulean text-uppercase">We're coming soon</h2>
					<p class="fs-6 my-4">Our website is under construction. We'll be here soon with our new awesome site, subscribe to be notified</p>
					<div id="timer" class="d-flex align-items-center my-4 border-bottom pb-4">
						<div id="days" class="fs-2 bg-light-blue p-3 me-2 rounded text-center w-25"></div>
						<div id="hours" class="fs-2 bg-light-blue p-3 me-2 rounded text-center w-25"></div>
						<div id="minutes" class="fs-2 bg-light-blue p-3 me-2 rounded text-center w-25"></div>
						<div id="seconds" class="fs-2 bg-light-blue p-3 me-2 rounded text-center w-25"></div>
					</div>
					<p class="fs-6">Notify me when it's ready</p>
					<div class="input-group">
						<input type="text" class="form-control form-control-lg" placeholder="example@email.com" aria-label="Recipient's username" aria-describedby="button-addon2">
						<button class="btn btn-primary fw-medium" type="button">Subscribe</button>
					</div>
				</div>
				<div class="col-xl-4 col-md-6 text-lg-end">
					<img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/coming-soon.png'); ?>" class="img-fluid" alt="">
				</div>
			</div>
		</div>
	</div>
	

	<script src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/js/countdown.js'); ?>"></script>