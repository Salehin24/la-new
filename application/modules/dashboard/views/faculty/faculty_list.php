<!-- <div class="row collapse" id="collapseExample">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?></h4>
            </div>
            <div class="card-body"> -->
<!-- <form action="javascript:void(0)" method="post">
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label for="faculty_id" class="col-sm-6"><?php echo display('faculty') ?></label>
                            <div class="col-sm-12">
                                <select class="form-control placeholder-single" name="faculty_id" id="faculty_id" data-placeholder="<?php echo display('select_one'); ?>">
                                    <option value=""></option>
                                    <?php foreach ($get_faculty as $faculty) { ?>
                                        <option value="<?php echo html_escape($faculty->faculty_id); ?>">
                                            <?php echo html_escape($faculty->name); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="email" class="col-sm-5"><?php echo display('email') ?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="email" placeholder="<?php echo display('email'); ?>">
                            </div>
                        </div>
                        <div class="form-group col-sm-1">
                            <label for="" class="col-sm-12">&nbsp;</label>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success" onclick="faculty_filter()"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form> -->
<!-- </div>
        </div>
    </div>
</div> -->
<br>
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
            echo "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>$file_uploaderror</div>";
        }
        ?>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>
                    <?php echo html_escape((!empty($title) ? $title : null)) ?>
                    <small class="float-right">
                        <!-- <button type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Filter</button> -->
                        <?php //if ($this->permission->check_label('event_list')->read()->access()) { ?>
                            <a href="<?php echo base_url(enterpriseinfo()->shortname.'/add-faculty'); ?>" class="btn btn-success" >
                                <?php echo display('add_instructor'); ?>
                            </a>
                        <?php //} ?>
                    </small>
                </h4>
            </div>
            <div class="card-body">

                <table class="table display table-bordered table-striped table-hover bg-white m-0" id="facultylists">
                    <thead>
                        <tr>
                            <th width="5%"><?php echo display('sl') ?></th>
                            <th width="20%"><?php echo display('name') ?></th>
                            <th width="10%"><?php echo display('email') ?></th>
                            <th width="10%"><?php echo display('mobile') ?></th>
                            <th width="30%"><?php echo display('courses') ?></th>
                            <th width="10%" class="text-center"><?php echo display('picture') ?></th>
                            <th width="15%" class="text-center"><?php echo display('action') ?></th>
                        </tr>
                    </thead>

                </table>


            </div>
        </div>
    </div>
</div>
<input type="hidden" id="total_faculty" value="<?php echo ($total_faculty)? $total_faculty:''; ?>">
<script src="<?php echo base_url('application/modules/dashboard/assets/js/faculty.js') ?>"></script>