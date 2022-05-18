<link href="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css'); ?>" rel="stylesheet">

<?php echo form_open_multipart('meeting-update', 'class="myform" id="myform"'); ?>
<div class="form-group row">
    <label for="title" class="col-sm-3 col-form-label"><?php echo display('title') ?> <i class="text-danger"> *</i></label>
    <div class="col-sm-8">
        <input name="title" class="form-control" type="text" placeholder="<?php echo display('title') ?>" id="title" value="<?php echo (!empty($get_meetinginfo->title) ? $get_meetinginfo->title : ''); ?>" required>
    </div>
</div>
<div class="form-group row">
    <label for="meeting_id" class="col-sm-3 col-form-label"><?php echo display('meeting_id') ?>  <i class="text-danger"> *</i></label>
    <div class="col-sm-8">
        <input name="meeting_id" class="form-control" type="text" placeholder="<?php echo display('meeting_id') ?>" id="meeting_id" value="<?php echo (!empty($get_meetinginfo->meeting_id) ? $get_meetinginfo->meeting_id : ''); ?>" required>
    </div>
</div>
<div class="form-group row">                            
    <label for="meeting_password" class="col-sm-3 col-form-label"><?php echo display('meeting_password') ?> <i class="text-danger"> *</i></label>
    <div class="col-sm-8">
        <input name="meeting_password" class="form-control" type="text" placeholder="<?php echo display('meeting_password') ?>"  id="meeting_password" value="<?php echo (!empty($get_meetinginfo->meeting_password) ? $get_meetinginfo->meeting_password : ''); ?>" required>
    </div>
</div>
<div class="form-group row">                            
    <label for="meeting_date" class="col-sm-3 col-form-label"><?php echo display('date') ?> </label>
    <div class="col-sm-8">
        <input name="meeting_date" class="form-control datepicker" type="text" placeholder="" id="meeting_date" value="<?php echo (!empty($get_meetinginfo->meeting_date) ? $get_meetinginfo->meeting_date : ''); ?>">
    </div>
</div>
<div class="form-group row">                            
    <label for="start_time" class="col-sm-3 col-form-label"><?php echo display('start_time') ?> </label>
    <div class="col-sm-3">
        <input name="start_time" class="form-control time_picker" type="text" placeholder="<?php echo display('start_time') ?>" id="start_time" value="<?php echo (!empty($get_meetinginfo->start_time) ? $get_meetinginfo->start_time : ''); ?>">
    </div>
    <label for="end_time" class="col-sm-2 col-form-label"><?php echo display('end_time') ?> </label>
    <div class="col-sm-3">
        <input name="end_time" class="form-control time_picker" type="text" placeholder="<?php echo display('end_time') ?>" id="end_time" value="<?php echo (!empty($get_meetinginfo->end_time) ? $get_meetinginfo->end_time : ''); ?>">
    </div>
</div> 
<input type="hidden" class="form-control" id="id" name="id" value="<?php echo (!empty($get_meetinginfo->id) ? $get_meetinginfo->id : ''); ?>">
<div class="form-group text-right">
    <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('update') ?></button>
</div>
<?php echo form_close(); ?>

<script src="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/moment.js'); ?>" type="text/javascript" ></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js'); ?>"></script>
<script>
    $(document).ready(function () {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });

        $('.time_picker').datetimepicker({
            format: 'HH:mm:ss',
        });
    });
</script>