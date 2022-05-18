

<div class="row collapse" id="collapseExample">
    <div class="col-sm-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)); ?></h4>
            </div>
            <div class="card-body">
                <form action="javascript:void(0)" method="post">
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label for="forum_name" class="col-sm-8"><?php echo display('title') ?></label>
                            <div class="col-sm-12">
                                <select class="form-control placeholder-single" name="forum_id" id="forum_id" data-placeholder="<?php echo display('select_one'); ?>">
                                    <option value=""></option>
                                    <?php foreach ($get_evetnts as $forum) { ?>
                                        <option value="<?php echo html_escape($forum->forum_id); ?>">
                                            <?php echo html_escape($forum->title); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="category_id" class="col-sm-8"><?php echo display('category') ?></label>
                            <div class="col-sm-12">
                                <select class="form-control placeholder-single" name="category_id" id="category_id" data-placeholder="<?php echo display('select_one'); ?>">
                                    <option value=""></option>
                                    <?php foreach ($get_forumcategory as $forumcategory) { ?>
                                        <option value="<?php echo html_escape($forumcategory->forum_category_id); ?>">
                                            <?php echo html_escape($forumcategory->title); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-1">
                            <label for="" class="col-sm-12">&nbsp;</label>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success" onclick="forum_filter()"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="col-sm-12 msg_autohide">
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
        <div class="card">
            <div class="card-header">
                <h4><?php echo html_escape((!empty($title) ? $title : null)) ?>
                    <small class="float-right">
                        <?php if ($this->permission->check_label('add_forum')->create()->access()) { ?>
                            <a href="<?php echo base_url(enterpriseinfo()->shortname.'/add-forum'); ?>" class="btn btn-primary" >
                                <?php echo display('add_forum'); ?>
                            </a>
                        <?php } ?>
                    </small>
                    <small class="float-right m-r-15">
                        <button type="button" class="btn btn-success" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Filter</button>
                    </small>
                </h4>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table display table-bordered table-striped table-hover bg-white m-0 results">
                        <thead>
                            <tr>
                                <th width="5%"><?php echo display('sl') ?></th>
                                <th width="30%"><?php echo display('title') ?></th>
                                <th width="15%"><?php echo display('category') ?></th>
                                <th width="35%"><?php echo display('description') ?></th>
                                <th width="15%" class="text-center"><?php echo display('action') ?></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($forum_list) {
                                $sl = 0;
                                foreach ($forum_list as $single) {
                                    $sl++;
                                    ?>
                                    <tr class=''>
                                        <td><?php echo $sl+$pagenum; ?></td>
                                        <td>
                                            <a href="javascript:void(0)<?php //echo base_url('forum-details/' . html_escape($single->forum_id) . "/" . html_escape($single->slug)); ?>">
                                                <?php echo html_escape($single->title); ?>    
                                            </a>
                                        </td>
                                        <td><?php echo html_escape($single->category_name); ?></td>
                                        <td><?php echo substr($single->description, 0, 150) . " ...."; ?></td>
                                        <td class="text-center">
                                        <?php 
                        
                                         if($single->status==1){
                                        ?>
                                      
                                        <a class="" onclick="foruminactive('<?php echo $single->forum_id?>')" href="javascript:void(0)" title="inactive"><i class="fa fa-check btn btn-sm btn-success"></i></a>
                                        <?php }else{?>
                                        <a  href="javascript:void(0)"  onclick="forumactive('<?php echo $single->forum_id?>')" title="active"><i class="fa fa-times btn btn-sm btn-warning"></i></a>
                                        <?php }?>
                                           
                                        
                                        
                                        <?php if ($this->permission->check_label('forum_list')->update()->access()) { ?>
                                                <a class="" href="<?php echo base_url(enterpriseinfo()->shortname.'/forum-edit/' . html_escape($single->forum_id)); ?>" title="Edit"><i class="fa fa-edit btn btn-success btn-sm"> </i> </a>
                                                <?php
                                            }
                                            if ($this->permission->check_label('forum_list')->delete()->access()) {
                                                ?>
                                                <a class="" href="<?php echo base_url(enterpriseinfo()->shortname .'/forum-delete/' . html_escape($single->forum_id)); ?>" title="Delete" id="forumdisabled_btn" onclick="return confirm('Are you sure')"><i class="far fa-trash-alt btn-danger btn btn-sm"> </i> </a>
                                            <?php } ?>
                                            
                                        </td>
                                        
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <?php if (empty($forum_list)) { ?>
                                <tr>
                                    <th class="text-danger text-center" colspan="6"><?php echo display('record_not_found'); ?></th>
                                </tr>
                            <?php } ?>
                        </tfoot>
                    </table>
                </div>
                <div class="mt-2">
                    <?php echo htmlspecialchars_decode($links); ?>
                </div>
            </div> 
        </div>
    </div>
</div>
<script src="<?php echo base_url('application/modules/dashboard/assets/js/forum.js') ?>"></script>
<script>
    //its for forum inactive
("use strict");
function foruminactive(forum_id) {
    // var base_url = $("#base_url").val();
    // var CSRF_TOKEN = $("#CSRF_TOKEN").val();
    var d = confirm("Are you sure?");
    if (d == true) {
        $.ajax({
            url: base_url + enterprise_shortname + "/forum-inactive",
            type: "POST",
            data: {csrf_test_name: CSRF_TOKEN, forum_id: forum_id},
            success: function (r) {
                toastrSuccessMsg(r);
                location.reload();
                // return false;
            },
        });
    }
}
//============= its for forum active ===========
("use strict");
function forumactive(forum_id) {
    var d = confirm("Are you sure?");
    if (d == true) {
        $.ajax({
            url: base_url + enterprise_shortname + "/forum-active",
            type: "POST",
            data: {csrf_test_name: CSRF_TOKEN, forum_id: forum_id},
            success: function (r) {
                // console.log(r);
                // return false;
                toastrSuccessMsg(r);
                location.reload();
            },
        });
    }
}
</script>