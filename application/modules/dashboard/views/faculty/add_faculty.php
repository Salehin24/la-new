<link rel="stylesheet" href="<?php echo base_url('application/modules/dashboard/assets/css/faculty.css') ?>">
<div class="row">
    <div class="col-sm-12">
        <?php
        $error = $this->session->flashdata('error');
        $file_uploaderror = $this->session->flashdata('file_uploaderror');
        $success = $this->session->flashdata('success');
        if ($error != '') {
            echo $error;
            unset($_SESSION['error']);
        }
        if ($success != '') {
            echo $success;
            unset($_SESSION['success']);
        }
        if ($file_uploaderror != '') {
            echo "<div class='alert alert-danger p_margin_remove'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>$file_uploaderror</div>";
        }
        ?>
    </div>
    <!-- Form controls -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
            <h4><?php echo html_escape((!empty($title) ? $title : null)); ?>
                    <small class="float-right">
                        <?php //if ($this->permission->check_label('event_list')->read()->access()) { ?>
                            <a href="<?php echo base_url(enterpriseinfo()->shortname.'/faculty-list'); ?>" class="btn btn-success" >
                                <?php echo display('instructor_list'); ?>
                            </a>
                        <?php //} ?>
                    </small>
                </h4>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="nav flex-column nav-pills custom_tablist">
                        <ul class="nav nav-pills displayinline_block" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="v-pills-basic-tab" data-toggle="pill" href="#v-pills-basic" role="tab" aria-controls="v-pills-basic" aria-selected="true"><?php echo display('basic_info'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-credential-tab" data-toggle="pill" href="#v-pills-credential" role="tab" aria-controls="v-pills-credential" aria-selected="false">Login Info</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-sm-9 p-15">
                    <?php echo form_open_multipart(enterpriseinfo()->shortname . '/faculty-save', 'class="myform" id="myform"'); ?>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-basic" role="tabpanel" aria-labelledby="v-pills-basic-tab">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="name" class="col-sm-4"><?php echo display('name') ?><i class="text-danger"> *</i></label>
                                    <div class="col-sm-12">
                                        <input name="name" class="form-control" type="text" placeholder="<?php echo display('name') ?>" id="name">
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="email" class="col-sm-4"><?php echo display('email') ?><i class="text-danger"> *</i></label>
                                    <div class="col-sm-12">
                                        <input name="email" class="form-control" type="text" placeholder="<?php echo display('email') ?>" id="email" onblur="email_goto_username(this.value)">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="mobile" class="col-sm-4"><?php echo display('mobile') ?><i class="text-danger"> *</i></label>
                                    <div class="col-sm-12">
                                        <input name="mobile" id="mobile" class="form-control" type="number" placeholder="<?php echo display('mobile') ?>">
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="dateofbirth" class="col-sm-4"><?php echo display('birthday') ?><i class="text-danger"> </i></label>
                                    <div class="col-sm-12">
                                        <input name="dateofbirth" class="form-control datepicker" type="text" id="dateofbirth" placeholder="Enter Birthday">
                                    </div>
                                </div>
                            </div>


                            <div class="row">

                                <div class="form-group col-sm-6">
                                    <label for="picture" class="col-sm-4"><?php echo display('picture') ?>
                                        <!-- <span class="text-danger f-s-10">( 118×118 )</span> -->
                                    </label>
                                    <div class="col-sm-12">
                                        <div>
                                            <input type="file" name="picture" id="picture" class="custom-input-file" onchange="fileValueOne(this,'instructor')"/>
                                            <label for="picture">
                                                <i class="fa fa-upload"></i>
                                                <span class="filename"><?php echo display('choose_file'); ?>…</span>
                                            </label>
                                        </div>
                                        <span class="text-danger">Size:( 120×120 ) Formats:(png,jpeg,jpeg)</span>
                                    </div>
                                </div>

                                <!-- <div class="form-group col-sm-6">
                                    <label for="paypal" class="col-sm-4"><?php echo display('paypal') ?><i class="text-danger"> </i></label>
                                    <div class="col-sm-12">
                                        <input name="paypal" class="form-control" type="text" placeholder="<?php echo display('paypal') ?>" id="paypal">
                                    </div>
                                </div> -->
                                <div class="form-group col-sm-6">
                                    <label for="address" class="col-sm-4"><?php echo display('address') ?> </label>
                                    <div class="col-sm-12">
                                        <input name="address" class="form-control" type="text" placeholder="<?php echo display('address') ?>" id="address">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="picture" class="col-sm-4"></span>
                                </label>
                                <div class="col-sm-12">
                                    <div>
                                    <img id="image-preview-instructor" src="" alt="" class="border border-2" width="200px">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 group-end m-l-20">
                                    <a class="btn btn-success btnNext " id="v-pills-credential-tab" data-toggle="pill" href="#v-pills-credential">Next</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-credential" role="tabpanel" aria-labelledby="v-pills-credential-tab">
                            <div class="form-group row">
                                <label for="username" class="col-sm-2"><?php echo display('email') ?><i class="text-danger"> *</i></label>
                                <div class="col-sm-6">
                                    <input name="username" class="form-control" type="text" placeholder="<?php echo display('email') ?>" id="username" onblur="getUniqueusername(this.value)">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2"><?php echo display('password') ?><i class="text-danger"> *</i></label>
                                <div class="col-sm-6">
                                    <input name="password" class="form-control" type="password" placeholder="<?php echo display('password') ?>" id="password">
                                </div>
                            </div>
                            <div class="offset-3 mb-3 group-end">
                                <a class="btn btn-danger btnPrevious" id="v-pills-basic-tab" data-toggle="pill" href="#v-pills-basic">Previous</a>
                                <!-- <a class="btn btn-success btnNext" id="v-pills-social-tab" data-toggle="pill" href="#v-pills-social">Next</a> -->
                                <input type="submit" class="btn btn-success" id="facultysave_btn" value="<?php echo display('finish'); ?>">
                            </div>
                        </div>

                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Inline form -->
</div>
<input type="hidden" id="total_faculty" value="">
<script src="<?php echo base_url('application/modules/dashboard/assets/js/faculty.js') ?>"></script>