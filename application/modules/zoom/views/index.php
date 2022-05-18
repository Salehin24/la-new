<link href="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css'); ?>"
    rel="stylesheet">
<?php
date_default_timezone_set("Asia/Dhaka");
?>
<div class="row">
    <!-- Form controls -->
    <div class="col-sm-12">
        <div class="col-sm-12">
            <?php
            $error = $this->session->flashdata('error');
            $success = $this->session->flashdata('success');
            $file_uploaderror = $this->session->flashdata('file_uploaderror');
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
        <div class="modal" id="myModal">
            <div class="modal-dialog  modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo display('add_meeting'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <?php echo form_open_multipart(enterpriseinfo()->shortname.'/meeting-save', 'class="myform" id="myform"'); ?>
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 col-form-label"><?php echo display('title') ?> <i
                                    class="text-danger"> *</i></label>
                            <div class="col-sm-8">
                                <input name="title" class="form-control" type="text"
                                    placeholder="<?php echo display('title') ?>" id="title" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="meeting_id" class="col-sm-3 col-form-label"><?php echo display('meeting_id') ?>
                                <i class="text-danger"> *</i></label>
                            <div class="col-sm-8">
                                <input name="meeting_id" class="form-control" type="text"
                                    placeholder="<?php echo display('meeting_id') ?>" id="meeting_id" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="meeting_password"
                                class="col-sm-3 col-form-label"><?php echo display('meeting_password') ?> <i
                                    class="text-danger"> *</i></label>
                            <div class="col-sm-8">
                                <input name="meeting_password" class="form-control" type="text"
                                    placeholder="<?php echo display('meeting_password') ?>" id="meeting_password"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="meeting_date" class="col-sm-3 col-form-label"><?php echo display('date') ?>
                            </label>
                            <div class="col-sm-8">
                                <input name="meeting_date" class="form-control datepicker" type="text" placeholder=""
                                    id="meeting_date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="start_time" class="col-sm-3 col-form-label"><?php echo display('start_time') ?>
                            </label>
                            <div class="col-sm-3">
                                <input name="start_time" class="form-control time_picker" type="text"
                                    placeholder="<?php echo display('start_time') ?>" id="start_time">
                            </div>
                            <label for="end_time" class="col-sm-2 col-form-label"><?php echo display('end_time') ?>
                            </label>
                            <div class="col-sm-3">
                                <input name="end_time" class="form-control time_picker" type="text"
                                    placeholder="<?php echo display('end_time') ?>" id="end_time">
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit"
                                class="btn btn-success w-md m-b-5"><?php echo display('save') ?></button>
                        </div>
                        <?php echo form_close(); ?>
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
                        <a href="<?php echo base_url(enterpriseinfo()->shortname.'/zoom-config'); ?>"
                            class="btn btn-success">
                            <?php echo display('zoom_config'); ?>
                        </a>

                    </small>
                </h4>
            </div>
            <div class="card-body">
                <div class="result_load">
                    <div class="table-responsive">
                        <table id="" class="table display table-bordered table-striped table-hover bg-white m-0">
                            <thead>
                                <tr>
                                    <th><?php echo display('sl') ?></th>
                                    <th><?php echo display('title') ?></th>
                                    <th><?php echo display('meeting_id') ?></th>
                                    <th class="text-center"><?php echo display('meeting_date') ?></th>
                                    <th class="text-center"><?php echo display('start_time') ?></th>
                                    <th class="text-center"><?php echo display('end_time') ?></th>
                                    <th class="text-center"><?php echo display('status') ?></th>
                                    <th class="text-center"><?php echo display('action') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if ($meeting_list) {
                                        $sl = 0 + $pagenum;
                                        foreach ($meeting_list as $single) {
                                            $sl++;
                                    ?>
                                <tr>
                                    <td><?php echo $sl; ?></td>
                                    <td><?php echo html_escape($single->title); ?></td>
                                    <td><?php echo html_escape($single->meeting_id); ?></td>
                                    <th class="text-center">
                                        <?php echo html_escape(date('d M Y', strtotime($single->meeting_date))); ?></th>
                                    <td class="text-center"><?php echo html_escape($single->start_time); ?></td>
                                    <td class="text-center"><?php echo html_escape($single->end_time); ?></td>
                                    <td class="text-center">
                                        <?php
                                        // echo strtotime($single->meeting_date); echo "<br>";
                                        // echo strtotime(date("Y-m-d")); echo "<br>";
                                        // echo ($single->start_time); echo "<br>";
                                        // echo date('H:i:s', time());echo "<br>";
                                        $labelmode = '';
                                        $status = '';
                                        $hostbtn = ''; 
                                                    if (strtotime($single->meeting_date) == strtotime(date("Y-m-d")) && strtotime($single->start_time) <= time() && strtotime($single->end_time) > time()) {
                                                        $status = '<i class="fas fa-video"></i> ' . display('live');
                                                        $labelmode = 'custom-success-soft';
                                                        $hostbtn = "viewHost('$single->meeting_id|$single->id')";
                                                    }elseif (strtotime($single->meeting_date) < strtotime(date("Y-m-d")) || (strtotime($single->meeting_date) <= strtotime(date("Y-m-d")) && strtotime($single->end_time) < time() )) {
                                                        $status = '<i class="far fa-check-square"></i> ' . display('expired');
                                                        $labelmode = 'custom-danger-soft';
                                                        $hostbtn = '';
                                                    }else{
                                                        $status = '<i class="far fa-clock"></i> ' . display('waiting');
                                                        $labelmode = 'custom-info-soft';
                                                        $hostbtn = '';
                                                    }
                                                    echo "<span class='label " . $labelmode . " '>" . $status ."</span>";
                                                    ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if (strtotime($single->meeting_date) == strtotime(date("Y-m-d")) && strtotime($single->start_time) <= time() && strtotime($single->end_time) > time()) { ?>
                                        <a class="" href="javascript:void(0)" onclick="<?php echo $hostbtn; ?>"
                                            data-toggle="tooltip" data-original-title="Host"><i
                                                class="fas fa-network-wired btn btn-primary btn-sm"> </i> </a>
                                                <?php }else{ ?>
                                                    <a class="" href="javascript:void(0)" disabled onclick="<?php echo $hostbtn; ?>"
                                            data-toggle="tooltip" data-original-title="Not Host"><i
                                                class="fas fa-network-wired btn btn-secondary btn-sm"> </i> </a>
                                                <?php } ?>
                                        <a class="" href="javascript:void(0)"
                                            onclick="meeting_delete(<?php echo $single->id; ?>)" data-toggle="tooltip"
                                            data-original-title="Delete"><i
                                                class="far fa-trash-alt btn-danger btn btn-sm"> </i> </a>
                                    </td>
                                </tr>
                                <?php
                                        }
                                    }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="">
                        <?php echo htmlspecialchars_decode($links); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="modal_info" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title modal_ttl"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="info">

            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/moment.js'); ?>" type="text/javascript">
</script>
<script src="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js'); ?>">
</script>
<script src="<?php echo base_url('application/modules/zoom/assets/js/script.js') ?>"></script>