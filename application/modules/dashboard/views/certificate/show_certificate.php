<!--================================
    START AUTHOR AREA
=================================-->
<div class="author-profile-area py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- <h4>
                    <?php echo html_escape(!empty($title) ? $title : ''); ?>
                    <small class="float-right">
                        <a class="btn btn-info btn-sm" onclick="printDiv('printableArea')"> 
                            <i class="fas fa-download"></i>
                        </a>
                    </small>
                </h4> -->
                <div id="printableArea">
                    <style>
                    .first-hr {
                        width: 30%;
                    }

                    .certificate-wrapper {
                        padding: 80px;
                        max-width: 842px;
                        display: grid;
                        position: relative;
                        margin: 0 auto;
                    }

                    .dateText {
                        margin-bottom: 0;
                    }

                    .signDirector,
                    .dateOfCertificat {
                        border-top: 1px solid #8a8a8a;
                        padding-top: 5px;
                        margin-bottom: 0;
                    }

                    .dateOfCertificat {
                        margin-top: 5px;
                    }

                    .signDirector {
                        margin-top: 25px;
                    }

                    .certificate-bg {
                        position: absolute;
                        top: 0;
                        left: 0;
                        right: 0;
                        bottom: 0;
                        display: block;
                        z-index: 0;
                    }

                    .logocls {
                        height: 30px;
                    }
                    .certificate-body{
                        display: block;
                        overflow: hidden;
                    }
                    </style>
                    <div class="certificate-wrapper text-center">
                        <div class="certificate-bg">
                            <img src="<?php echo base_url('assets/img/certificate-bg.png'); ?>"
                                alt="" class="img-fluid">
                        </div>
                        <div class="certificate-body">
                            <?php echo $template; ?>
                        </div>
                    </div>
                </div>
                <!--</div>-->
            </div>

        </div>
    </div>
</div>
<!--================================
    END AUTHOR AREA
=================================-->
<!-- <script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        // document.body.style.marginTop="-45px";
        window.print();
        document.body.innerHTML = originalContents;
    }
</script> -->