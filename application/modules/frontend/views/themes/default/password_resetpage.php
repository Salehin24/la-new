
	
	<div class="align-items-center d-flex py-5 full_page_cover">
		<div class="container-lg">
			<div class="row g-3 align-items-center reverse-md">
				<div class="col-xl-4 offset-xl-2 col-md-6">
					<h2 class="fw-bolder text-dark-cerulean text-uppercase">Reset Your Password!</h2>
				
					<div class="input-group">
						<input type="password" id="newpassword" class="form-control form-control-lg" placeholder="Your New Password" aria-label="Recipient's username" aria-describedby="button-addon2" autofocus>
						<button class="btn btn-primary fw-medium" type="button" onclick="resetpassword('<?php echo $this->input->get('log_id'); ?>')">Reset</button>
					</div>
				</div>
				<div class="col-xl-4 col-md-6 text-lg-end">
					<img src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/coming-soon.png'); ?>" class="img-fluid" alt="">
				</div>
			</div>
		</div>
	</div>
	

	<script src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/js/countdown.js'); ?>"></script>