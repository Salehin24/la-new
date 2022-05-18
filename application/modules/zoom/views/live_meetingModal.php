<?php
date_default_timezone_set("Asia/Dhaka");
$uID = explode('|', $meetingID);
// dd($uID);
$this->db->select('*');
$this->db->from('meeting_tbl');
$this->db->where('id', $uID[1]);
$liveclass_info = $this->db->get()->row();

$this->db->select('a.*,b.name');
$this->db->from('meeting_tbl a');
$this->db->join('loginfo_tbl b', 'b.log_id = a.created_by', 'left');
$this->db->order_by('a.id', 'ASC');
$this->db->where('a.meeting_id', $uID[0]);

$this->db->where('a.id', $uID[1]);
$row = $this->db->get()->row_array();
// d($row);
?>
<div class="row">
    <div class="col-md-8">
        <label><span class="text-weight-semibold"><?php echo display('remarks') ?> :</span></label>
        <div id="loadliveevent"></div>
        <?php if (empty($row['remarks'])) { ?>
            <div class="alert alert-subl text-dark text-center"><i class="fas fa-exclamation-circle"></i> No information was found</div>
        <?php } else { ?>
            <div class="alert alert-subl text-dark"><?= nl2br($row['remarks']) ?></div>
        <?php } ?>
    </div>
    <div class="col-md-4">
        <label><span class="text-weight-semibold"><i class="far fa-calendar"></i> <?php echo display('meeting_date') ?></span> : <span class="text-dark"><?php echo ($row['meeting_date']) ?></span></label><br>
        <label><span class="text-weight-semibold"><i class="far fa-clock"></i> <?php echo display('start_time') ?></span> : <span class="text-dark"><?php echo date("h:i A", strtotime($row['start_time'])); ?></span> </label><br>
        <label><span class="text-weight-semibold"><i class="far fa-clock"></i> <?php echo display('end_time') ?></span> : <span class="text-dark"><?php echo date("h:i A", strtotime($row['end_time'])); ?></span> </label><br>
        <label><span class="text-weight-semibold"><i class="far fa-user-circle"></i> <?php echo display('host') . " " . display('by') ?></span> : <span class="text-dark"><?php echo $row['name'] ?></span></label><br>
        <label><span class="text-weight-semibold"> <?php echo display('status') ?></span> : <?php
            $status = '<i class="far fa-clock"></i> ' . display('waiting');
            $labelmode = 'btn btn-info-soft';
            if (strtotime($row['meeting_date']) == strtotime(date("Y-m-d")) && strtotime($row['start_time']) <= time() && time() >= strtotime(date("h:i"))) {
                $status = '<i class="fas fa-video"></i> ' . display('live');
                $labelmode = 'label custom-success-soft';
            }
            if (strtotime($row['meeting_date']) < strtotime(date("Y-m-d")) || strtotime($row['end_time']) <= time()) {
                $status = '<i class="far fa-check-square"></i> ' . display('expired');
                $labelmode = 'btn btn-danger-soft';
            }
            echo "<span class='label " . $labelmode . " '>" . $status . "</span>";
            ?>
        </label>
        <br>
        <a href="<?php echo base_url('zoom/zoomcontroler/livejoin?meeting_id=' . $row['meeting_id'] . "&live_id=" . $row['id'] . "&enterprise_id=" . $enterprise_id . "&enterprise_shortname=" . $enterprise_shortname . "&event_id=" . $row['course_id']) ?>" target="_new" class="btn btn-success mt-md mb-md"><i class="fas fa-video"></i> <?php echo display('join_live_meeting') ?></a>
        <!-- <a href="javascript:void(0)" onclick="loadlivejoin('<?php echo $row['meeting_id']; ?>', '<?php echo $row['id']; ?>', '<?php echo $enterprise_id; ?>', '<?php echo $enterprise_shortname; ?>')" class="btn btn-success mt-md mb-md">
            <?php echo display('join_live_meeting') ?>
        </a> -->
    </div>
</div>
