<div class="row">
    <!-- Form controls -->
    <div class="col-md-12">
        <div class="col-sm-12">
            <?php
            $error = $this->session->flashdata('error');
            $success = $this->session->flashdata('success');
            $file_uploaderror = $this->session->flashdata('file_uploaderror');
            if ($error != '') {
                echo $error;
            }
            if ($success != '') {
                echo $success;
            }
            if ($file_uploaderror != '') {
                echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>$file_uploaderror</div>";
            }
            ?>
        </div>
        <div class="modal" id="myModal">
            <div class="modal-dialog  modal-md">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title"> <?php echo display('add_subscription'); ?></h4>
                        <button type="button" class="close" id="btnClose" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <?php echo form_open_multipart('#', 'class="myform" id="myform"'); ?>
                        <div class="form-group">
                            <label for="name" class="col-md-3"><?php echo display('title') ?> <i class="text-danger">
                                    *</i></label>
                            <div class="col-md-12">
                                <input name="title" class="form-control" type="text"
                                    placeholder="<?php echo display('title') ?>" id="title">
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="" class="col-md-3">Course Select<i class="text-danger"> *</i></label>
                            <div class="col-md-12">
                                <select name="course_id[]"  id="course_id" class="form-control placeholder-single"  data-placeholder="<?php echo display('select_one'); ?>" multiple>

                                    <?php if($subscription_course){
                                        foreach($subscription_course as $subscription){
                                    ?>
                                    <option value="<?php echo $subscription->course_id;?>"><?php echo $subscription->name;?></option>
                                    <?php }}?>
                                </select>

                            </div>
                        </div> -->
                        <!-- <div class="form-group">
                            <label for="start_date" class="col-md-3"><?php echo display('start_date') ?> <i class="text-danger"> *</i></label>
                            <div class="col-md-12">
                                <input name="start_date" class="form-control start_datas" type="text" id="start_datas" placeholder="<?php echo display('start_date') ?>" id="end_dates">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="end_date" class="col-md-3"><?php echo display('end_date') ?> <i class="text-danger"> *</i></label>
                            <div class="col-md-12">
                                <input name="end_date" class="form-control end_dates" type="text" placeholder="<?php echo display('end_date') ?>" id="end_dates">
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label for="duration_id" class="col-md-3"><?php echo display('duration') ?><i
                                    class="text-danger"> *</i></label>
                            <div class="col-md-12">

                                <select name="duration" class="form-control placeholder-single" id="duration"
                                    data-placeholder="<?php echo display('select_one'); ?>">
                                    <option value=""><?php echo display('select_one');?></option>
                                    <option value="1">Monthly</option>
                                    <option value="2">Yearly</option>
                                    <option value="3">Free</option>
                                    <option value="4">Enterprise Package</option>
                                </select>

                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <input id="is_free" name="is_free" type="checkbox" value="0">
                            <label for="is_free"><?php echo display('free'); ?></label>
                        </div> -->
                        <div class="form-group" id="freesubscription">
                            <label for="end_date" class="col-md-3"><?php echo display('price') ?> <i
                                    class="text-danger"> *</i></label>
                            <div class="col-md-12">
                                <input name="price" class="form-control" type="number"
                                    placeholder="<?php echo display('price') ?>" id="price">
                            </div>
                        </div>
                        <div class="form-group" id="freesubscription">
                            <label for="end_date" class="col-md-3"><?php echo display('oldprice') ?></label>
                            <div class="col-md-12">
                                <input name="oldprice" class="form-control" type="number"
                                    placeholder="<?php echo display('oldprice') ?>" id="oldprice">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-md-3"><?php echo 'Content' ?> <i class="text-danger">
                                    *</i></label>
                            <div class="col-md-12">
                                <div id="subscription_content">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="course_sub_content[]"
                                                    id="course_sub_content_0" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <a href="javascript:void(0)"
                                                class="btn btn-success text-white btn-md custom_btn"
                                                onclick="appendContent()"><i class="fa fa-plus"></i> </a>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-md-3"><?php echo display('description') ?></label>
                            <div class="col-md-12">
                                <textarea name="description" class="form-control" cols="5" rows="5" type="text"
                                    placeholder="<?php echo display('description') ?>" id="description"></textarea>
                            </div>
                        </div>


                        <div class="form-group text-right">
                            <button type="button" onclick="subscription_save()"
                                class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>


                </div>
            </div>
        </div>

        <!--========edit form===========-->
        <div class="modal" id="edit">
            <div class="modal-dialog  modal-md">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title"> <?php echo display('update'); ?> Subscription</h4>
                        <button type="button" class="close" id="btnClose" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body editinfos">
                    </div>


                </div>
            </div>
        </div>



    </div>
    <!-- Inline form -->
</div>
<br>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?>
                    <small class="float-right">
                        <!-- Button to Open the Modal -->
                        <?php //if ($this->permission->check_label('category')->create()->access()) { 
                        ?>
                        <button type="button" class="btn btn-success text-white" data-toggle="modal"
                            data-target="#myModal">
                            <?php echo display('add_subscription'); ?>
                        </button>
                        <?php //} 
                        ?>
                        <!-- The Modal -->
                    </small>
                </h4>

            </div>
            <div class="card-body">

                <div class="result_load">
                    <table class="table display table-bordered table-striped table-hover bg-white m-0"
                        id="subscriptionlist">
                        <thead>
                            <tr>
                                <th><?php echo display('sl') ?></th>
                                <th><?php echo display('title') ?></th>
                                <!-- <th><?php echo display('start_date') ?></th>
                                <th><?php echo display('end_date') ?></th> -->
                                <th><?php echo display('duration') ?></th>
                                <th><?php echo display('price') ?></th>
                                <th class="text-center"><?php echo display('action') ?></th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<input type='hidden' id='total_subscription' value='<?php echo $total_subscription; ?>'>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/subscription.js') ?>"></script>

<script>
$("body").on("click", "#is_free", function() {
    if ($("#is_free").is(":checked")) {
        $("#is_free").attr("value", "1");
        $('#freesubscription').hide();
    } else {
        $("#is_free").attr("value", "0");
        $('#freesubscription').show();
    }
});
</script>