<!--============ its for header file call start =============-->
<?php $this->load->view('frontend/themes/default/header'); ?>
<!--============ its for header file call close =============-->
<!-- Main content -->    
<div class="content_search">
    <?php echo $this->load->view(html_escape($module) . '/' . html_escape($page)) ?>
</div>
<!--======== main content close ==========-->
<?php $this->load->view('frontend/themes/default/footer'); ?>