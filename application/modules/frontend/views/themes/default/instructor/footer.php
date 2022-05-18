<?php $user_type = $this->session->userdata('user_type');?>
<div class="main-footer bg-prussian-blue text-white fw-medium py-5">
    <div class="container-lg">
        <div class="row">
            <div class="col-6 col-sm-6 col-md-3">
                <div class="footer-logo mb-4">
                    <img src="<?php echo base_url(html_escape(!empty($get_appseeting->footer_logo) ? "$get_appseeting->footer_logo" : 'application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/img/footer-logo.png')); ?>"
                        class="img-fluid" alt="">
                </div>
                <p class="mb-0 text">
                    <?php echo html_escape(!empty($get_appseeting->footer_about) ? $get_appseeting->footer_about : ''); ?>
                </p>
            </div>
            <div class="col-6 col-sm-6 col-md-3 mt-5 mt-md-0">
                <ul class="nav-list list-unstyled mb-0">
                    <?php
                    if($user_type==5){?>
                    <li><a href="<?php echo base_url($enterprise_shortname . '/instructor-dashboard'); ?>"
                            class="text-white text-decoration-none mb-3 d-inline-block">Become an instructor</a></li>
                    <?php }else{ ?>
                    <li><a href="<?php echo base_url($enterprise_shortname . '/ins-signup'); ?>"
                            class="text-white text-decoration-none mb-3 d-inline-block">Become an instructor</a></li>
                    <?php }?>
                    <li><a href="<?php echo base_url($enterprise_shortname . '/comming-soon'); ?>"
                            class="text-white text-decoration-none mb-3 d-inline-block">Become an enterprise</a></li>
                    <li><a href="<?php echo base_url($enterprise_shortname . '/comming-soon'); ?>"
                            class="text-white text-decoration-none mb-3 d-inline-block">Become an affiliate</a></li>
                    <li><a href="<?php echo base_url($enterprise_shortname . '/comming-soon'); ?>"
                            class="text-white text-decoration-none mb-3 d-inline-block">Become Our partner</a></li>
                </ul>
            </div>
            <div class="col-6 col-sm-6 col-md-3 mt-5 mt-md-0">
                <ul class="nav-list list-unstyled mb-0">                    
                    <li><a href="<?php echo base_url($enterprise_shortname . '/comming-soon'); ?>"
                            class="text-white text-decoration-none mb-3 d-inline-block">Request new course</a></li>
                    <li><a href="<?php echo base_url($enterprise_shortname . '/comming-soon'); ?>"
                            class="text-white text-decoration-none mb-3 d-inline-block">Feedback</a></li>
                    <li><a href="<?php echo base_url($enterprise_shortname. '/faq-page/'); ?>"
                            class="text-white text-decoration-none mb-3 d-inline-block">Faq</a></li>
                            <li><a href="<?php echo base_url($enterprise_shortname. '/contact/'); ?>"
                            class="text-white text-decoration-none mb-3 d-inline-block">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
                <ul class="nav-list list-unstyled mb-0">
                    <li><a href="<?php echo base_url($enterprise_shortname. '/about/'); ?>"
                            class="text-white text-decoration-none mb-3 d-inline-block"><?php echo display('about_us');?></a>
                    </li>
                    <li><a href="<?php echo base_url($enterprise_shortname. '/terms-condition/'); ?>"
                            class="text-white text-decoration-none mb-3 d-inline-block"><?php echo display('terms_condition');?></a>
                    </li>
                    <li><a href="<?php echo base_url($enterprise_shortname. '/refund-policy/'); ?>"
                            class="text-white text-decoration-none mb-3 d-inline-block">Refund and Return Policy</a>
                    </li>
                    <li><a href="<?php echo base_url($enterprise_shortname. '/privacy-policy/'); ?>"
                            class="text-white text-decoration-none mb-3 d-inline-block"><?php echo display('privacy_policy');?></a>
                    </li>                    
                </ul>
            </div>
        </div>
    </div>
</div>
<!--End Footer-->
<!--Start Sub Footer-->
<div class="sub-footer bg-prussian-blue text-white py-4">
    <div class="container-lg d-sm-flex align-items-center justify-content-between">
        <div class="text-center text-md-start">
            <span class="copy d-block d-md-inline-block">
                <?php echo html_escape(!empty($get_appseeting->footer_text) ? $get_appseeting->footer_text : ''); ?>
            </span>
        </div>
        <div class="text-center">
            <span class="ms-md-5 d-block d-md-inline-block">
                <?php echo display('secured_with_SSL');?>
            </span>
        </div>
        <div class="text-center text-md-start">
        <span class="ms-md-5 d-block d-md-inline-block">
            License No
            </span>
            <span class="fw-semi-bold ms-3 px-3 py-2 ">283870</span>
            <!-- <span class="bg-alice-blue fw-semi-bold ms-3 px-3 py-2 rounded text-dark-cerulean">English</span> -->

        </div>
        <!--Start Footer Social Icon-->
        <ul class="footer-social list-unstyled mb-0 d-flex align-items-center justify-content-center mt-3 mt-sm-0">
            <li class="me-3 d-none d-md-block">Follow Us On : </li>
            <li class="mx-1">
                <a
                    href="<?php echo html_escape(!empty($get_appseeting->facebook_link) ? $get_appseeting->facebook_link : ''); ?>">
                    <svg width="9" height="15" viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.234863 8.88536V5.48922C0.325483 5.43618 0.432579 5.41839 0.535563 5.43928H2.26458C2.29982 5.39374 2.32477 5.34117 2.33774 5.28514C2.35072 5.22912 2.3514 5.17096 2.33976 5.11465V3.74121C2.32902 2.92806 2.61143 2.13807 3.13565 1.51485C3.65988 0.891624 4.3911 0.476544 5.1964 0.345065C5.45302 0.302702 5.71325 0.285972 5.97321 0.295122H8.32868C8.3788 0.444951 8.35374 3.36663 8.32868 3.59138C8.22341 3.62423 8.11201 3.63277 8.00293 3.61635H6.29896C6.20148 3.62983 6.11059 3.67309 6.03879 3.74017C5.96699 3.80725 5.91782 3.89485 5.89803 3.99092V4.09081C5.86492 4.48946 5.85655 4.88977 5.87297 5.28945C5.99827 5.43928 6.0985 5.38933 6.22379 5.38933H7.97787C8.07038 5.37416 8.16525 5.38276 8.25351 5.41431C8.0781 6.51306 7.90269 7.63678 7.75234 8.78548C7.12589 8.81045 6.52449 8.7605 5.94815 8.78548C5.8783 8.88778 5.85133 9.01323 5.87297 9.13508V14.6039C5.64745 14.6538 2.66552 14.6788 2.36482 14.6288C2.32371 14.5171 2.30663 14.398 2.3147 14.2792V9.30988C2.33154 9.23772 2.33356 9.16292 2.32064 9.08997C2.30772 9.01701 2.28013 8.94742 2.23952 8.88536H0.234863ZM4.94582 6.3882C4.92885 6.35766 4.92021 6.32322 4.92076 6.28831V3.94098C4.9274 3.79145 4.9704 3.64577 5.04605 3.51646C5.16058 3.27186 5.34035 3.06331 5.56572 2.91358C5.79109 2.76386 6.0534 2.67871 6.32402 2.66743C6.6654 2.63381 7.0088 2.62547 7.35141 2.64245C7.40149 2.2027 7.40149 1.75871 7.35141 1.31896C7.26425 1.28259 7.1702 1.26555 7.07577 1.26902H5.77274C5.58644 1.26927 5.40102 1.29447 5.22146 1.34393C4.70417 1.4743 4.24147 1.76425 3.89944 2.17236C3.55742 2.58048 3.35357 3.08587 3.31703 3.61635C3.34209 4.46538 3.31703 5.28945 3.31703 6.13848C3.31703 6.2134 3.34209 6.31328 3.31703 6.36323C3.29766 6.38273 3.27396 6.39741 3.24784 6.40609C3.22172 6.41476 3.19392 6.41719 3.16668 6.41317H1.58801C1.46272 6.41317 1.33743 6.36323 1.18708 6.48809C1.17058 6.94601 1.17895 7.4045 1.21214 7.86153C1.30883 7.89414 1.41206 7.90271 1.51284 7.8865H2.99127C3.09151 7.91147 3.2168 7.86153 3.31703 7.96141V10.9081C3.31703 11.7321 3.29197 12.5562 3.29197 13.3803C3.2865 13.4248 3.29036 13.47 3.3033 13.513C3.31624 13.5559 3.33798 13.5958 3.36715 13.63C3.88412 13.6844 4.40582 13.676 4.92076 13.605V7.8865H5.89803C6.22366 7.91602 6.55163 7.90764 6.8753 7.86153C7.0006 7.63678 6.95048 7.38706 7.0006 7.16232C7.05303 6.92453 7.07825 6.68159 7.07577 6.43814L4.94582 6.3882Z" fill="white"/>
                    </svg>

                </a>
            </li>
            <li class="mx-1">
                <a
                    href="<?php echo html_escape(!empty($get_appseeting->twitter_link) ? $get_appseeting->twitter_link : ''); ?>">
                    <svg width="17" height="13" viewBox="0 0 17 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.620618 10.3326C0.745595 10.3201 0.871516 10.3201 0.996493 10.3326C1.73011 10.3908 2.46686 10.3992 3.20162 10.3575C3.82128 10.3467 4.43335 10.2196 5.00582 9.98297C5.05593 9.958 5.13111 9.93302 5.15617 9.88308C5.15775 9.86384 5.16673 9.84595 5.18122 9.83314C5.15617 9.75822 5.08099 9.73325 5.00582 9.70828C4.31574 9.41966 3.76688 8.8727 3.47726 8.18501C3.42714 8.03518 3.35197 7.88535 3.30185 7.71055C3.17752 7.33774 3.00032 6.98456 2.77563 6.66174C2.47605 6.20097 2.31918 5.66252 2.32458 5.1135C2.29952 4.78887 2.32458 4.46424 2.32458 4.13961C2.32458 3.81498 2.47493 4.18955 2.57516 4.08967C2.49376 3.80185 2.42685 3.51014 2.3747 3.21566C2.34518 2.89948 2.35359 2.58093 2.39976 2.26674C2.44138 1.95702 2.52571 1.6545 2.65034 1.36776C2.77727 1.09369 2.91948 0.826904 3.07633 0.568667C3.10887 0.566828 3.14112 0.575576 3.16824 0.593591C3.19536 0.611607 3.21587 0.637915 3.22668 0.668554C3.59321 1.32091 4.11895 1.8706 4.75523 2.26674C5.51414 2.82426 6.34963 3.27 7.236 3.59023C7.53803 3.69147 7.84822 3.76666 8.16316 3.81498C8.19092 3.82665 8.22074 3.83267 8.25086 3.83267C8.28099 3.83267 8.31081 3.82665 8.33857 3.81498C8.3777 3.77637 8.40717 3.72913 8.42458 3.67707C8.44199 3.62501 8.44687 3.5696 8.4388 3.51532C8.49167 2.72466 8.83073 1.98 9.393 1.41968C9.95526 0.859358 10.7025 0.521468 11.4959 0.468781C12.4732 0.393866 13.0746 0.568667 14.0268 1.19296C14.1651 1.21999 14.3086 1.19318 14.4277 1.11804L15.2547 0.768441L15.4301 0.693526C15.5106 0.657031 15.5994 0.642429 15.6874 0.6512C15.7754 0.659972 15.8595 0.691807 15.9312 0.743469C15.9938 0.808609 16.0365 0.890189 16.0543 0.978646C16.072 1.0671 16.0641 1.15877 16.0315 1.2429L15.8811 1.64245C15.9312 1.76731 16.0064 1.74233 16.0816 1.74233C16.5577 1.84222 16.708 2.21679 16.4324 2.61634C16.1787 3.01826 15.8662 3.38018 15.5052 3.69012C15.4158 3.76346 15.3428 3.85471 15.291 3.95795C15.2392 4.06119 15.2097 4.17413 15.2045 4.28944C15.1263 6.1142 14.478 7.86903 13.3502 9.30873C12.2047 10.808 10.5616 11.8524 8.71444 12.2554C7.89315 12.4425 7.05024 12.5181 6.20861 12.4801C5.41012 12.4258 4.62013 12.2835 3.85314 12.0556C3.04967 11.7864 2.28352 11.4173 1.57283 10.9569C1.29719 10.7571 0.996491 10.5823 0.695792 10.4075C0.395093 10.2327 0.620618 10.3825 0.620618 10.3326ZM6.50931 7.63564L5.80768 7.83541L5.15617 8.01021C4.9557 8.08512 4.70512 8.06015 4.52971 8.20998C4.52741 8.23704 4.53066 8.26428 4.53928 8.29004C4.5479 8.3158 4.56169 8.33954 4.57983 8.35981C4.80567 8.59212 5.06806 8.78612 5.35663 8.93416C5.79506 9.08402 6.24893 9.18453 6.70978 9.23382C6.98238 9.24955 7.25185 9.2999 7.51165 9.38365L6.88519 9.83314L6.23367 10.2826C6.02868 10.4274 5.81056 10.5528 5.58216 10.6572C5.35663 10.7821 5.10605 10.857 4.88053 10.9569C4.63991 11.009 4.40493 11.0843 4.17889 11.1816C4.23543 11.2503 4.31606 11.2949 4.40442 11.3065C5.67843 11.6561 7.01631 11.7074 8.31351 11.4563C10.0538 11.1313 11.6091 10.1692 12.6737 8.75936C13.7067 7.46235 14.2951 5.86942 14.3526 4.21452C14.3462 4.01748 14.3833 3.82144 14.4613 3.64023C14.5392 3.45902 14.6561 3.29705 14.8036 3.16572L15.5303 2.54143C15.5614 2.51817 15.5867 2.488 15.6041 2.45333C15.6215 2.41865 15.6305 2.38042 15.6305 2.34165C15.2547 2.31668 14.9038 2.51645 14.5029 2.54143C14.7591 2.27932 15.0017 2.00427 15.2296 1.71736C15.1043 1.64245 15.0542 1.69239 15.0041 1.74233L14.4027 2.01702C14.2598 2.1135 14.0862 2.1541 13.9152 2.13107C13.7441 2.10804 13.5876 2.02298 13.4755 1.89216C13.1794 1.61055 12.8029 1.42734 12.398 1.36776C12.0995 1.32211 11.7965 1.31372 11.4959 1.34279C9.96736 1.49262 9.14043 2.916 9.29078 4.16458C9.34054 4.30174 9.34054 4.45194 9.29078 4.5891C8.79784 4.70972 8.28399 4.71826 7.78729 4.61407C7.19365 4.52217 6.61847 4.33673 6.08332 4.06469C5.15544 3.62823 4.28794 3.07429 3.50232 2.41657C3.48585 2.37923 3.45679 2.3488 3.42018 2.33056C3.38357 2.31231 3.34171 2.30741 3.30185 2.31668C3.25174 2.34165 3.25174 2.3916 3.22668 2.44154C3.14514 3.07604 3.30616 3.71788 3.67773 4.2395C3.8754 4.47788 4.11273 4.68061 4.37936 4.83882L5.15617 5.41316C4.9458 5.48118 4.7258 5.51491 4.50465 5.51305C4.29701 5.54206 4.08782 5.55874 3.8782 5.56299C3.66834 5.53041 3.45373 5.54752 3.25174 5.61294C3.30529 5.86301 3.41402 6.09808 3.57005 6.30108C3.72608 6.50409 3.9255 6.66994 4.15384 6.7866C4.4541 6.96355 4.77355 7.10597 5.10605 7.21112L6.50931 7.63564Z" fill="white"/>
                    </svg>
                </a>
            </li>
            
            <li class="mx-1">
                <a
                    href="<?php echo html_escape(!empty($get_appseeting->instagram_link) ? $get_appseeting->instagram_link : ''); ?>">
                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.31467 14.6538H3.73134C2.88692 14.6337 2.07507 14.3251 1.43183 13.7795C0.788583 13.234 0.35302 12.4847 0.198119 11.6572C0.148323 11.4022 0.123153 11.1429 0.122947 10.8831V3.99092C0.119881 3.10604 0.437673 2.24983 1.01782 1.57991C1.59798 0.909998 2.40143 0.471474 3.28029 0.345066L3.83157 0.295123H10.8228C11.7766 0.288848 12.6947 0.656585 13.3788 1.31896C13.7401 1.64933 14.029 2.05056 14.2274 2.49747C14.4257 2.94439 14.5293 3.42734 14.5315 3.91601C14.5315 6.31328 14.5565 8.68559 14.5315 11.0579C14.5054 11.9082 14.1878 12.7239 13.6315 13.3691C13.0752 14.0143 12.3139 14.4501 11.4743 14.6039L10.8228 14.6538H7.31467ZM13.3537 7.48695V3.91601C13.3286 3.27069 13.0584 2.65898 12.5978 2.20465C12.1373 1.75032 11.5207 1.4873 10.873 1.46879H3.40558C2.8085 1.57539 2.26892 1.89014 1.88331 2.35676C1.49769 2.82339 1.29118 3.41148 1.30069 4.01589V11.0079C1.28513 11.355 1.363 11.6999 1.52621 12.0068C2.02737 12.9058 2.77912 13.4801 3.85663 13.4801H10.7978C11.0006 13.4798 11.2025 13.4546 11.3992 13.4052C12.5769 13.1305 13.3788 12.0318 13.3537 11.0329V7.48695Z" fill="white"/>
                    <path d="M7.33976 3.81613C9.1189 3.71624 11.0233 5.23951 11.0233 7.48696C11.0234 8.44959 10.6414 9.37316 9.96066 10.0562C9.27996 10.7392 8.35583 11.1262 7.38988 11.1328C6.90075 11.1361 6.4158 11.0429 5.96295 10.8587C5.5101 10.6744 5.0983 10.4027 4.75127 10.0592C4.40423 9.7157 4.12881 9.30716 3.94087 8.85713C3.75293 8.4071 3.65618 7.92446 3.65619 7.43702C3.65619 5.31443 5.53556 3.71624 7.33976 3.81613ZM7.33976 9.98412C7.6719 9.98754 8.00136 9.92444 8.30857 9.79858C8.61578 9.67273 8.89451 9.48667 9.12821 9.25145C9.36191 9.01623 9.54583 8.73663 9.66906 8.42924C9.79229 8.12185 9.85232 7.79293 9.84559 7.46199C9.84575 7.12766 9.77853 6.7967 9.64792 6.48874C9.51732 6.18078 9.32599 5.90209 9.08528 5.6692C8.84457 5.43631 8.55938 5.25397 8.24663 5.13297C7.93388 5.01197 7.59993 4.9548 7.26459 4.96483C6.64044 5.03563 6.06502 5.33521 5.65021 5.80533C5.23541 6.27544 5.01086 6.88248 5.02023 7.50842C5.02961 8.13435 5.27224 8.73444 5.70094 9.19201C6.12964 9.64958 6.71377 9.93191 7.33976 9.98412Z" fill="white"/>
                    <path d="M11.9505 3.61633C11.9551 3.72579 11.9357 3.83493 11.8934 3.93606C11.8511 4.03719 11.7871 4.12786 11.7059 4.20167C11.6247 4.27548 11.5282 4.33064 11.4232 4.36326C11.3183 4.39587 11.2074 4.40516 11.0985 4.39045C10.992 4.38753 10.8872 4.36279 10.7906 4.31778C10.6941 4.27276 10.6079 4.20844 10.5374 4.1288C10.4669 4.04916 10.4136 3.95592 10.3808 3.85487C10.348 3.75382 10.3364 3.64712 10.3468 3.54142C10.3597 3.33387 10.4533 3.13952 10.6077 2.99964C10.7621 2.85976 10.9651 2.78537 11.1737 2.79227C11.2811 2.78815 11.3882 2.80706 11.4877 2.84772C11.5872 2.88837 11.6768 2.94983 11.7505 3.02794C11.8241 3.10605 11.8801 3.199 11.9146 3.3005C11.9491 3.40201 11.9613 3.50971 11.9505 3.61633Z" fill="white"/>
                    </svg>

                </a>
            </li>

            <li class="mx-1">
                <a
                    href="<?php echo html_escape(!empty($get_appseeting->youtube_link) ? $get_appseeting->youtube_link : ''); ?>">
                    <svg width="18" height="13" viewBox="0 0 18 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.12004 12.5051H5.06061C4.56653 12.5179 4.07418 12.4418 3.60723 12.2804C2.97296 12.0624 2.40517 11.6865 1.95781 11.1882C1.51045 10.6899 1.19839 10.0859 1.05129 9.43361C0.960134 9.04073 0.918052 8.63813 0.925995 8.23497V4.48923C0.918027 3.98469 1.01176 3.48368 1.20164 3.0159C1.44705 2.33694 1.8769 1.73925 2.44325 1.2895C3.0096 0.839754 3.69018 0.555624 4.40909 0.468797L4.8852 0.418854H13.3048C14.3468 0.418347 15.348 0.822114 16.0964 1.54461C16.8448 2.26711 17.2815 3.25158 17.3141 4.28946V8.63452C17.2858 9.53837 16.9507 10.4059 16.3636 11.0954C15.7764 11.7849 14.9719 12.2554 14.0816 12.4302C13.8005 12.481 13.5153 12.5061 13.2296 12.5051H9.12004ZM9.06993 11.2066H13.0041C13.2391 11.2148 13.4743 11.1981 13.7057 11.1567C14.0608 11.1105 14.4023 10.9911 14.7086 10.8063C15.0149 10.6214 15.2793 10.3751 15.4849 10.0829C15.8084 9.68626 15.9931 9.19526 16.0111 8.68446C16.0111 7.26108 16.0361 5.81272 16.0111 4.36437C16.0041 3.87253 15.8597 3.39237 15.5941 2.97775C15.3285 2.56313 14.9523 2.23045 14.5076 2.01704C14.0621 1.80555 13.5725 1.70283 13.0793 1.71738H5.23601L4.53438 1.76732C4.01647 1.85276 3.53381 2.0838 3.14317 2.43328C2.75253 2.78275 2.47016 3.23613 2.32926 3.74008C2.25749 4.04272 2.22382 4.35309 2.22902 4.66403V8.40977C2.22797 8.65315 2.25318 8.89594 2.3042 9.13395C2.44604 9.72809 2.78603 10.2567 3.26856 10.6332C3.75108 11.0097 4.34756 11.2119 4.96038 11.2066H9.06993Z" fill="white"/>
                    <path d="M11.5507 6.46197C11.3001 6.66174 7.81701 8.73438 7.61655 8.83427V4.08966L11.5507 6.46197Z" fill="white"/>
                    </svg>
                </a>
            </li>
        </ul>
        <!--End Footer Social Icon-->
    </div>
    <div class="container-lg">
        <div class="d-flex align-items-center mt-4">
            <div class="d-block minw_65">
                <h6 class="fs-12 me-2 my-0 text-capitalize">pay with</h6>
            </div>
            <div class="d-flex flex-wrap justify-content-center logo_ssl-middle">
                <?php
                    $get_paywithlogo = get_paywithlogo($enterprise_id);
                    //dd($get_paywithlogo);
                    if($get_paywithlogo){
                        foreach($get_paywithlogo as $paylogo){  ?>
                <a href="#" class="logo_ssl-block">
                    <img src="<?php echo base_url(!empty($paylogo->logo) ? $paylogo->logo : ''); ?>" class="img-fluid"
                        alt="">
                </a>
                <?php } } ?>
            </div>
            <div class="d-block maxw_75 ms-2">
                <h6 class="fs-12">Verified by:</h6>
                <img src="<?php echo base_url('application/modules/frontend/views/themes/default/assets/img/32.png'); ?>"
                    class="img-fluid" alt="">
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="security_character" value="<?php echo display('security_character'); ?>">
<input type="hidden" id="mail_specialcharacter_remove" value="<?php echo display('mail_specialcharacter_remove'); ?>">
<input type="hidden" id="onlynumber_allow" value="<?php echo display('onlynumber_allow'); ?>">
<input type="hidden" id="coursespecial_character" value="<?php echo display('coursespecial_character'); ?>">
<input type="hidden" name="csrf_test_name" id="CSRF_TOKEN" value="<?php echo $this->security->get_csrf_hash();?>">
<input type="hidden" name="" id="base_url"
    value="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>">
<input type="hidden" name="" id="base_urlrm"
    value="<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>">

<?php  $user_id = $this->session->userdata('user_id');?>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/Sortable/Sortable.min.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/feather-font/feather.min.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/mmenu-light/dist/mmenu-light.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/jquery.counterup/jquery.waypoints.min.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/jquery.counterup/jquery.counterup.min.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/OwlCarousel2/owl.carousel.min.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/video-popup/videoPopUp.jquery.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/Magnific-Popup/dist/jquery.magnific-popup.min.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/scrolling-tabs/dist/jquery.bs4-scrolling-tabs.min.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/modernizr/modernizr.min.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/sweetalert/sweet-alert.min.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/theia-sticky-sidebar/dist/ResizeSensor.min.js'); ?>">
</script>
<script src="<?php echo base_url() ?>assets/plugins/select2/dist/js/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/dist/js/pages/select2.js"></script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) )?>/assets/plugins/datatables/dataTables.min.js">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) )?>/assets/plugins/datatables/dataTables.bootstrap4.min.js">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) )?>/assets/plugins/datatables/dataTables.responsive.min.js">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) )?>/assets/plugins/datatables/responsive.bootstrap4.min.js">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) )?>/assets/plugins/datatables/dataTables.buttons.min.js">
</script>

<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) )?>/assets/plugins/datatables/buttons.bootstrap4.min.js">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) )?>/assets/plugins/datatables/jszip.min.js">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) )?>/assets/plugins/datatables/pdfmake.min.js">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) )?>/assets/plugins/datatables/vfs_fonts.js">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) )?>/assets/plugins/datatables/buttons.html5.min.js">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) )?>/assets/plugins/datatables/buttons.print.min.js">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) )?>/assets/plugins/datatables/data-bootstrap4.active.js">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/theia-sticky-sidebar/dist/theia-sticky-sidebar.min.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/ckeditor5-classic/ckeditor.js'); ?>"
    type="text/javascript"></script>

<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/raty/lib/jquery.raty.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/js/jquery.easing.min.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/toastr/toastr.min.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/bootstrap-wizard/form.scripts.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/apexcharts/dist/apexcharts.min.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/plugins/apexcharts/dist/apexcharts.active2.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/js/upload.js'); ?>">
</script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/js/video-upload.js'); ?>">
</script>

<script src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/js/jquery-ui.min.js'); ?>"></script>
<script
    src="<?php echo base_url('application/modules/frontend/views/themes/' . html_escape(get_activethemes()->name) . '/assets/js/custom.js'); ?>">
</script>

<script type="text/javascript">
$(document).ready(function() {
    $(".hideClass .course").each(function(index) {
        var p_course_id = $(this).attr('id');
        $("#course_subscription_" + p_course_id).first().hide();
        $('#course_subscription_' + p_course_id).first().removeClass('d-flex');
    });
});

function coursechecedRadio(s) {
    if (!$('#flexRadioDefault2_' + s).is('.checked')) {
        $('#flexRadioDefault2_' + s).addClass('checked');
        $('#flexRadioDefault2_' + s).prop('checked', true);
        $('#flexRadioDefault2_' + s).val("1");


        $('#flexRadioDefault1_' + s).val("0");
        $('#flexRadioDefault1_' + s).removeClass('checked');
        $('#flexRadioDefault1_' + s).prop('checked', false);

        $("#course_subscription_" + s).hide();
        $('#course_subscription_' + s).removeClass('d-flex');
        $('#course_purchase_' + s).addClass('d-flex');
        $("#course_purchase_" + s).show();
    }

}

function subscriptionchecedRadio(s) {
    if (!$('#flexRadioDefault1_' + s).is('.checked')) {
        $('#flexRadioDefault1_' + s).addClass('checked');
        $('#flexRadioDefault1_' + s).prop('checked', true);
        $('#flexRadioDefault1_' + s).val("1");

        $('#flexRadioDefault2_' + s).val("0");
        $('#flexRadioDefault2_' + s).removeClass('checked');
        $('#flexRadioDefault2_' + s).prop('checked', false);
        $("#course_subscription_" + s).show();
        $('#course_subscription_' + s).addClass('d-flex');
        $('#course_purchase_' + s).removeClass('d-flex');
        $("#course_purchase_" + s).hide();
    }

}


$("document").ready(function() {
            // (function($) {
                "use strict";
                // $("document").ready(function () {
                var CSRF_TOKEN = $('#CSRF_TOKEN').val();
                var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
              
                $(".uiautocomplete").autocomplete({
                    
                    source: function(request, response) {
                        $.ajax({
                            type: "POST",
                            url: base_url +
                                "/autocomplete-course-search",
                            dataType: "json",
                            data: {
                                'csrf_test_name': CSRF_TOKEN,
                                query: request.term,
                                enterprise_id: enterprise_id,
                            },
                            success: function(data) {
                                $("#ui-id-1").addClass("search_autocomplete");
                                // console.log(data);
                                response(data);
                            }
                        });
                    },
                    minLength: 1,
                    select: function(event, ui) {
                        $("#uiitem").val(ui.item.value);
                        // $("#shapla").val(ui.item.course_id);
                    }
                });

                // });
                // });


            //  setInterval(function my_function(){
            //     // load_notify_counter();
            //     $("#notifications").load(window.location.href + " #notifications");
            //     $('.notifications-scroll').each(function() {
            //         const ps = new PerfectScrollbar($(this)[0]);
            //     });
            //    },2000); 
                // load_notify_counter();
                // $("#notifications").load(window.location.href + " #notifications");
                // $('.notifications-scroll').each(function() {
                //     const ps = new PerfectScrollbar($(this)[0]);
                // });


                // $("body").on('click', "#read_notificaiton", function() {
                //     var id = $(this).attr("data-id");
                //     var typ = $("#cotyp").val();
                //     $.ajax({
                //         url: base_url + enterprise_shortname + '/nofity-read',
                //         type: "POST",
                //         data: {
                //             csrf_test_name: CSRF_TOKEN,
                //             user_id: "<?php echo $user_id;?>",
                //             enterprise_id: "<?php echo $enterprise_id;?>",
                //             id: id,
                //         },
                //         success: function(r) {
                //             // location.href = base_url + enterprise_shortname + '/forum-details/'+id;
                //             if (typ == 1) {
                //                 location.href = base_url + enterprise_shortname +
                //                     '/course-details/' + id;
                //             } else if (typ == 2) {
                //                 location.href = base_url + enterprise_shortname +
                //                     '/event-details/' + id;
                //             } else if (typ == 3) {
                //                 location.href = base_url + enterprise_shortname +
                //                     '/forum-details/' + id;

                //             } else if (typ == 4) {
                //                 location.href = base_url + enterprise_shortname +
                //                     '/course-details/' + id;

                //             }
                //             load_notify_counter();
                //             // location.href = base_url + enterprise_shortname;
                //         },
                //     });
                //     return false;


                // });
                $("body").on('click', "#read_notificaiton", function() {
                    var id = $(this).attr("data-id");
                    var userntype = $("#instructor").val();
                    var typ = $("#typ").val();
                    $.ajax({
                        url: base_url+'/nofity-read',
                        type: "POST",
                        data: {
                            csrf_test_name: CSRF_TOKEN,
                            user_id: "<?php echo $user_id;?>",
                            enterprise_id: "<?php echo $enterprise_id;?>",
                            id: id,
                        },
                        success: function(r) {

                            if (typ == 1) {
                                if(userntype =="instructor"){
                                   
                                    location.href = base_url+ '/instructor-notifications/';
                                }else{

                                    location.href = base_url+ '/course-details/' + id;
                                }
                            } else if (typ == 2) {
                                location.href = base_url + '/event-details/' + id;
                            } else if (typ == 3) {
                                location.href = base_url+ '/forum-details/' + id;

                            } else if (typ == 4) {
                                location.href = base_url+ '/course-details/' + id;

                            }
                            load_notify_counter();
                            // location.href = base_url + enterprise_shortname + '/forum-details/'+id;
                        },
                    });
                    return false;

                });



                setTimeout(function() {
                    $(".se-pre-con").fadeOut("slow");
                }, 3000);

            }(jQuery));

            // 	(function ($) {
            // 	"use strict";
            // 	$("document").ready(function () {
            // 	var CSRF_TOKEN = $('#CSRF_TOKEN').val();
            // 	var base_url     = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
            // 	$('input.typeahead').typeahead({
            // 		highlight: true,
            // 		minLength: 1,
            // 		source: function (query, result) {
            // 			$.ajax({
            // 				url: base_url + "/autocomplete-course-search",
            // 				data: {'csrf_test_name': CSRF_TOKEN, query: query},
            // 				dataType: "json",
            // 				type: "POST",
            // 				success: function (data) {
            // 					result($.map(data, function (item) {
            // 						return item.value;
            // 					}));
            // 				},
            // 			});
            // 		},
            // 		autoSelect: false
            // 	});

            //     $(".uiautocomplete").autocomplete({
            //             source: function(request, response) {
            //                 $.ajax({
            //                     type: "POST",
            //                     url: base_url + enterprise_shortname + "/autocomplete-course-search",
            //                     dataType: "json",
            //                     data: {
            //                         'csrf_test_name': CSRF_TOKEN,
            //                         query: request.term
            //                     },
            //                     success: function(data) {
            //                         // console.log(data);
            //                         response(data);
            //                     }
            //                 });
            //             },
            //             minLength: 1,
            //             select: function(event, ui) {
            //                 $("#uiitem").val(ui.item.value);
            //                 // $("#ddd").val(ui.item.course_id);
            //             }
            //         });
            // });

            // }(jQuery));


            //=================header search button  tigger ===============
            "use strict";

            function typeahead_search() {

                var item = $("#uiitem").val();
                var base_url = "<?php echo base_url(($enterprise_shortname?$enterprise_shortname:'admin'))?>";
                var CSRF_TOKEN = $('#CSRF_TOKEN').val();
                // alert(item);
                // return false;
                if (item == '') {
                    toastrErrorMsg("Empty field not allow!");
                    return false;
                }
                location.href = base_url + "/typeahead-search?keyward=" + item;

            }






//  setInterval(function my_function(){
//     load_notify_counter();
//     $("#notifications").load(window.location.href + " #notifications");
//     $('.notifications-scroll').each(function() {
//         const ps = new PerfectScrollbar($(this)[0]);
//     });
//    },2000);

 $("document").ready(function() {
    load_notify_counter();
    $("#notifications").load(window.location.href + " #notifications");
    $('.notifications-scroll').each(function() {
        const ps = new PerfectScrollbar($(this)[0]);

    });
});















            function load_notify_counter() {
                $.ajax({
                    url: base_url + enterprise_shortname + '/nofity_counter',
                    type: "POST",
                    data: {
                        csrf_test_name: CSRF_TOKEN,
                        user_id: "<?php echo $user_id;?>",
                        enterprise_id: "<?php echo $enterprise_id;?>",
                    },
                    success: function(r) {
                        jQuery("#notify_counter").html(r);
                    },
                });
                return false;
            }
</script>