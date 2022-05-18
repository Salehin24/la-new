<link rel="stylesheet" href="<?php echo base_url('application/modules/dashboard/assets/css/faculty.css') ?>">
<div class="row">
    <div class="col-sm-12">
        <?php
        $error = $this->session->flashdata('error');
        $success = $this->session->flashdata('success');
        if ($error != '') {
            echo $error;
            unset($_SESSION['error']);
        }
        if ($success != '') {
            echo $success;
            unset($_SESSION['success']);
        }
        ?>
    </div>
    <!-- Form controls -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <?php echo html_escape((!empty($title) ? $title : null)) ?>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="nav flex-column nav-pills custom_tablist">
                        <ul class="nav nav-pills displayinline_block" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="v-pills-basic-tab" data-toggle="pill"
                                    href="#v-pills-basic" role="tab" aria-controls="v-pills-basic"
                                    aria-selected="true"><?php echo display('basic_info'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-credential-tab" data-toggle="pill"
                                    href="#v-pills-credential" role="tab" aria-controls="v-pills-credential"
                                    aria-selected="false">Login Info</a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-sm-9 p-15">

                    <?php echo form_open_multipart(enterpriseinfo()->shortname . '/faculty-update', 'class="myform" id="myform"'); ?>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-basic" role="tabpanel"
                            aria-labelledby="v-pills-basic-tab">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="name" class="col-sm-4"><?php echo display('name') ?><i
                                            class="text-danger"> *</i></label>
                                    <div class="col-sm-12">
                                        <input name="name" class="form-control" type="text"
                                            placeholder="<?php echo display('name') ?>" id="name"
                                            value="<?php echo html_escape($edit_data->name); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">

                                    <label for="email" class="col-sm-4"><?php echo display('email') ?><i
                                            class="text-danger"> *</i></label>
                                    <div class="col-sm-12">
                                        <input name="email" class="form-control" type="text"
                                            placeholder="<?php echo display('email') ?>" id="email"
                                            value="<?php echo html_escape($edit_data->email); ?>"
                                            onkeyup="email_goto_username(this.value)">
                                        <input type="hidden" name="original_email"
                                            value="<?php echo html_escape($edit_data->email); ?>" id="original_email">
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="mobile" class="col-sm-4"><?php echo display('mobile') ?><i
                                            class="text-danger"> *</i></label>
                                    <div class="col-sm-12">
                                        <input name="mobile" class="form-control" type="number"
                                            placeholder="<?php echo display('mobile') ?>" id="mobile"
                                            value="<?php echo html_escape($edit_data->mobile); ?>">
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="dateofbirth" class="col-sm-4"><?php echo display('birthday'); ?><i
                                            class="text-danger"> </i></label>
                                    <div class="col-sm-12">
                                        <input name="dateofbirth" class="form-control datepicker" type="text"
                                            id="dateofbirth"
                                            value="<?php
                                                                                                                                        if ($edit_data->birthday == '0000-00-00') {
                                                                                                                                            echo date('Y-m-d');
                                                                                                                                        } else {
                                                                                                                                            echo html_escape($edit_data->birthday);
                                                                                                                                        }
                                                                                                                                        ?>">
                                    </div>
                                </div>

                            </div>



                            <!-- <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="picture" class="col-sm-5"><?php echo display('picture') ?>
                                        <span class="text-danger f-s-10">( 118×118 )</span>
                                    </label>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div>
                                                <input type="file" name="picture" id="picture" class="custom-input-file" />
                                                <label for="picture">
                                                    <i class="fa fa-upload"></i>
                                                    <span><?php echo display('choose_file'); ?>…</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 img_border">
                                            <img src="<?php echo base_url((html_escape($edit_data->picture)) ? "$edit_data->picture" : "assets/img/icons/default.png"); ?>" alt="<?php echo html_escape($edit_data->name); ?>">
                                        </div>
                                        
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">

                                <div class="form-group col-sm-6">
                                    <label for="picture" class="col-sm-4"><?php echo display('picture') ?>
                                        <!-- <span class="text-danger f-s-10">( 118×118 )</span> -->
                                    </label>
                                    <div class="col-sm-12">
                                        <div>
                                            <input type="file" name="picture" id="picture" class="custom-input-file" onchange="fileValueOne(this,'editinstructor')" />
                                            <label for="picture">
                                                <i class="fa fa-upload"></i>
                                                <span class="filename"><?php echo display('choose_file'); ?>…</span>
                                            </label>
                                        </div>
                                        <span class="text-danger">Size:( 120×120 ) Formats:(png,jpeg,jpeg)</span>
                                    </div>
                                </div>
                                <!-- <div class="form-group col-sm-6">
                                    <label for="paypal" class="col-sm-4"><?php echo display('paypal') ?><i
                                            class="text-danger"> </i></label>
                                    <div class="col-sm-12">
                                        <input name="paypal" class="form-control" type="text"
                                            placeholder="<?php echo display('paypal') ?>" id="paypal"
                                            value="<?php echo html_escape($edit_data->paypal); ?>">
                                    </div>
                                </div> -->
                                <div class="form-group col-sm-6">
                                    <label for="address" class="col-sm-4"><?php echo display('address') ?> </label>
                                    <div class="col-sm-12">
                                        <input name="address" class="form-control" type="text"
                                            placeholder="<?php echo display('address') ?>" id="address"
                                            value="<?php echo html_escape($edit_data->address); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-sm-4 img_border">
                                    <div class="col-sm-6">
                                        <img src="<?php echo base_url((html_escape($edit_data->picture)) ? "$edit_data->picture" : "assets/img/icons/default.png"); ?>"
                                            alt="<?php echo html_escape($edit_data->name); ?>" width="200px">
                                    </div>
                                </div>
                                <div class="form-group col-sm-4">
                                    <div class="col-sm-6">
                                      <img id="image-preview-editinstructor" src="" alt="" class="border border-2" width="200px">
                                    </div>
                                </div>
                            </div>

                            <div class="offset-3 mb-3 group-end">
                                <a class="btn btn-success btnNext " id="v-pills-credential-tab"
                                    data-toggle="pill" href="#v-pills-credential">Next</a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-credential" role="tabpanel"
                            aria-labelledby="v-pills-credential-tab">
                            <div class="form-group row">
                                <label for="username" class="col-sm-2"><?php echo display('username') ?><i
                                        class="text-danger"> *</i></label>
                                <div class="col-sm-6">
                                    <input name="username" class="form-control" type="text"
                                        placeholder="<?php echo display('username') ?>" id="username"
                                        onblur="getUniqueusername(this.value)"
                                        value="<?php echo html_escape($edit_data->username); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="edtpassword" class="col-sm-2"><?php echo display('password') ?></label>
                                <div class="col-sm-6">
                                    <input name="oldpass" class="form-control" type="hidden"
                                        placeholder="<?php echo display('password') ?>" id="oldpass"
                                        value="<?php echo html_escape($edit_data->password); ?>">
                                    <input name="password" class="form-control" type="password"
                                        placeholder="<?php echo display('password') ?>" id="edtpassword" value="">
                                </div>
                            </div>
                            <div class="offset-3 mb-3 group-end">
                                <a class="btn btn-danger btnPrevious" id="v-pills-basic-tab" data-toggle="pill"
                                    href="#v-pills-basic"><?php echo display('previous') ?></a>
                                <input type="hidden" name="faculty_id" id="faculty_id"
                                    value="<?php echo html_escape($edit_data->faculty_id); ?>">
                                <input type="submit" class="btn btn-success" id="facultysave_btn"
                                    value="<?php echo display('finish'); ?>">
                            </div>
                        </div>


                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="total_faculty" value="">
<script src="<?php echo base_url('application/modules/dashboard/assets/js/faculty.js') ?>"></script>