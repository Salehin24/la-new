<!--============ its for header file call start =============-->
<?php $uri_segment = $this->uri->segment(2);?>
<?php 

$this->load->view('frontend/themes/default/header');?>

<!--============ its for header file call close =============-->
<!-- Main content -->    
<div class="content_search">
<?php if($uri_segment != 'instructor-affiliation-settings'){?>
    <?php  $this->load->view('frontend/themes/default/instructor/dashboard_coverpage'); ?>
    
    <!--End Student Profile Header-->
    <div class="bg-dark-cerulean sticky-nav">
        <div class="container-lg">
          <?php $this->load->view('frontend/themes/default/instructor/top_menu'); ?>
        </div>
    </div>
    <?php }?>
    <?php echo $this->load->view(html_escape($module) . '/' . html_escape($page)) ?>
</div>
<!--======== main content close ==========-->
<?php $this->load->view('frontend/themes/default/instructor/footer'); ?>