
<!--Start Course Preview Header-->
<div class="hero-header text-white position-relative bg-img" data-image-src="<?php echo base_url(!empty(getappsettings($enterprise_id)->faq_header_image) ? getappsettings($enterprise_id)->faq_header_image : default_600_400()); ?>">
    <div class="container-lg hero-header_wrap position-relative">
        <div class="row align-items-end my-5">
            <div class="col-12">
                <h1 class="fw-semi-bold my-4">Frequently Asked Questions</h1>
            </div>
        </div>
    </div>
</div>
<!--End Course Preview Header-->
<!--Start F.A.Q-->
<div class="bg-alice-blue py-4" id="faq">
    <div class="container-lg">
        <!--Start Section Header-->
        <div class="section-header mb-4">
            <h4><?php echo display('frequently_asked_questions'); ?></h4>
            <div class="section-header_divider"></div>
        </div>
        <!--End Section Header-->
        <div class="row">
            <div class="accordion faq-accordion" id="faqAccordion1">
                <div class="row">
                    <?php
                    if ($get_faqs) {
                        $sl = 0;
                        foreach ($get_faqs as $faq) {
                            $sl++;
                            ?>
                    <div class="col-md-6">
                        <div class="accordion-item border-0 shadow-sm mb-2">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button fw-medium <?php if($sl=='1'){echo "" ;}else{ echo "collapsed";}?>" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_<?php echo $sl; ?>" aria-expanded="<?php if($sl==1){echo 'true';}else{ echo "false";}?>"
                                    aria-controls="collapse_<?php echo $sl; ?>">
                                    <strong> <?php echo (!empty($faq->question) ? $faq->question : ''); ?></strong>
                                    
                                </button>
                            </h2>
                            <div id="collapse_<?php echo $sl; ?>"
                                class="accordion-collapse collapse <?php echo (($sl == '1') ? 'show' : ''); ?>"
                                aria-labelledby="headingOne" data-bs-parent="#faqAccordion1">
                                <div class="accordion-body">
                                    <!-- <strong> -->
                                       <p> <?php echo (!empty($faq->answer) ? $faq->answer : ''); ?></p>
                                    <!-- </strong> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
     
        </div>
    </div>
</div>
<!--End F.A.Q-->