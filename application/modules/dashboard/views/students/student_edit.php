<link rel="stylesheet" href="<?php echo base_url('application/modules/dashboard/assets/css/student.css') ?>">
<div class="row">
    <!-- Form controls -->
    <div class="col-sm-12">
        <div class="card">
            <div class="row">
                <div class="col-sm-3">
                    <div class="nav flex-column nav-pills custom_tablist">
                        <ul class="nav nav-pills displayinline_block" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="v-pills-basic-tab" data-toggle="pill" href="#v-pills-basic" role="tab" aria-controls="v-pills-basic" aria-selected="true"><?php echo display('basic_info'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-credential-tab" data-toggle="pill" href="#v-pills-credential" role="tab" aria-controls="v-pills-credential" aria-selected="false"><?php echo display('credentials_info'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-social-tab" data-toggle="pill" href="#v-pills-social" role="tab" aria-controls="v-pills-social" aria-selected="false"><?php echo display('social_info'); ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="v-pills-payment-tab" data-toggle="pill" href="#v-pills-payment" role="tab" aria-controls="v-pills-payment" aria-selected="false"><?php echo display('payment_info'); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-9 p-15">
                    <?php echo form_open_multipart('student-update', 'class="myform" id="myform"'); ?>
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-basic" role="tabpanel" aria-labelledby="v-pills-basic-tab">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2"><?php echo display('name') ?><i class="text-danger"> *</i></label>
                                <div class="col-sm-9">
                                    <input name="name" class="form-control" type="text" placeholder="<?php echo display('name') ?>" id="name" value="<?php echo html_escape($edit_data->name); ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mobile" class="col-sm-2"><?php echo display('mobile') ?><i class="text-danger"> *</i></label>
                                <div class="col-sm-6">
                                    <input name="mobile" class="form-control" type="number" placeholder="<?php echo display('mobile') ?>" id="mobile" value="<?php echo html_escape($edit_data->mobile); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-sm-2"><?php echo display('address') ?></label>
                                <div class="col-sm-6">
                                    <textarea name="address" class="form-control" placeholder="<?php echo display('address') ?>" id="address"><?php echo html_escape($edit_data->address); ?></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-2"><?php echo display('biography') ?> </label>
                                <div class="col-sm-9">
                                    <textarea name="biography" id="description" rows="10" cols="80"><?php echo html_escape($edit_data->biography); ?></textarea> <!-- /.Ck Editor -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="picture" class="col-sm-2"><?php echo display('picture') ?> 
                                    <span class="text-danger f-s-10">( 118×118 )</span>
                                </label>
                                <div class="col-sm-6">
                                    <div>
                                        <input type="file" name="picture" id="picture" class="custom-input-file" />
                                        <label for="picture">
                                            <i class="fa fa-upload"></i>
                                            <span>Choose a file…</span>
                                        </label>
                                    </div>
                                </div>
                                <?php if ($edit_data->picture) { ?>
                                    <div class="img_border col-sm-3">
                                        <img src="<?php echo base_url(html_escape($edit_data->picture)); ?>" alt="<?php echo html_escape($edit_data->name); ?>" width="25%">
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="offset-3 mb-3 group-end">
                                <a class="btn btn-success btnNext " id="v-pills-credential-tab" data-toggle="pill" href="#v-pills-credential">Next</a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-credential" role="tabpanel" aria-labelledby="v-pills-credential-tab">
                            <div class="form-group row">
                                <label for="email" class="col-sm-2"><?php echo display('email') ?><i class="text-danger"> *</i></label>
                                <div class="col-sm-6">
                                    <input name="email" class="form-control" type="email" placeholder="<?php echo display('email') ?>" id="email" value="<?php echo html_escape($edit_data->username); ?>" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2"><?php echo display('password') ?><i class="text-danger"> *</i></label>
                                <div class="col-sm-6">
                                    <input name="oldpass" class="form-control" type="hidden" placeholder="<?php echo display('password') ?>" id="old_password" value="<?php echo html_escape($edit_data->password); ?>" required>
                                    <input name="password" class="form-control" type="password" placeholder="<?php echo display('password') ?>" id="password" >
                                </div>
                            </div>
                            <div class="offset-3 mb-3 group-end">
                                <a class="btn btn-danger btnPrevious" id="v-pills-basic-tab" data-toggle="pill" href="#v-pills-basic">Previous</a>
                                <a class="btn btn-success btnNext" id="v-pills-social-tab" data-toggle="pill" href="#v-pills-social">Next</a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-social" role="tabpanel" aria-labelledby="v-pills-social-tab">
                            <div class="form-group row">
                                <label for="facebook" class="col-sm-2"><?php echo display('facebook') ?><i class="text-danger"> </i></label>
                                <div class="col-sm-6">
                                    <input name="facebook" class="form-control" type="text" placeholder="<?php echo display('facebook') ?>" id="facebook" value="<?php echo html_escape($edit_data->facebook); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="twitter" class="col-sm-2"><?php echo display('twitter') ?><i class="text-danger"> </i></label>
                                <div class="col-sm-6">
                                    <input name="twitter" class="form-control" type="text" placeholder="<?php echo display('twitter') ?>" id="twitter" value="<?php echo html_escape($edit_data->twitter); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="linkedin" class="col-sm-2"><?php echo display('linkedin') ?><i class="text-danger"> </i></label>
                                <div class="col-sm-6">
                                    <input name="linkedin" class="form-control" type="text" placeholder="<?php echo display('linkedin') ?>" id="linkedin" value="<?php echo html_escape($edit_data->linkedin); ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="instagram" class="col-sm-2"><?php echo display('instagram') ?><i class="text-danger"> </i></label>
                                <div class="col-sm-6">
                                    <input name="instagram" class="form-control" type="text" placeholder="<?php echo display('instagram') ?>" id="instagram" value="<?php echo html_escape($edit_data->instagram); ?>">
                                </div>
                            </div>
                            <div class="offset-3 group-end">
                                <a class="btn btn-danger btnPrevious" id="v-pills-credential-tab" data-toggle="pill" href="#v-pills-credential">Previous</a>
                                <a class="btn btn-success btnNext" id="v-pills-payment-tab" data-toggle="pill" href="#v-pills-payment">Next</a>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-payment" role="tabpanel" aria-labelledby="v-pills-payment-tab">
                            <div class="form-group row">
                                <label for="paypal" class="col-sm-2"><?php echo display('paypal') ?><i class="text-danger"> </i></label>
                                <div class="col-sm-6">
                                    <input name="paypal" class="form-control" type="text" placeholder="<?php echo display('paypal') ?>" id="paypal" value="<?php echo html_escape($edit_data->paypal); ?>">
                                </div>
                            </div>
                            <div class="offset-3 mb-3 group-end">
                                <input type="hidden" name="student_id" value="<?php echo html_escape($edit_data->student_id); ?>">
                                <a class="btn btn-danger btnPrevious" id="v-pills-social-tab" data-toggle="pill" href="#v-pills-social">Previous</a>
                                <input type="submit" class="btn btn-success" id="studentsave_btn" value="<?php echo display('update'); ?>">
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

<script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.active.js'); ?>"></script>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/student.js') ?>"></script>
