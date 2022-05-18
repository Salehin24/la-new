<!DOCTYPE html>
<head>
    <title>Live Meeting</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/bootstrap-4.5.0/css/bootstrap.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome/css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('application/modules/zoom/assets/css/style.css'); ?>">

    <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.9.1/css/react-select.css" />
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body oncontextmenu="return false;">

    <?php
    $getStudent = get_userinfo(get_userid());
    $config = $this->db->get('zoomconfig_tbl')->row();
    // d($enterprise_shortname);
    // dd($config);
    $zoom_api_key = $config->zoom_api_key;
    $zoom_api_secret = $config->zoom_api_secret;
    
    $meetingID = $meetingID; //$this->input->get('meeting_id', true);
    $liveID = $liveID; //$this->input->get('live_id', true);
    $this->db->where('id', $liveID);
    $this->db->where('meeting_id', $meetingID);
    $liveClass = $this->db->get('meeting_tbl')->row_array();
    
    ?>
    <nav id="nav-tool" class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <h4><i class="fab fa-chromecast"></i> Live Event Title : <?php echo $liveClass['title'] ?></h4>
            </div>
            <div class="navbar-form navbar-right">
                <h5><i class="far fa-user-circle" style=""></i> Host By : <?php echo get_type_name_by_id('loginfo_tbl', $liveClass['created_by']) ?></h5>
            </div>
        </div>
    </nav>
    <input type="hidden" name="zoom_api_key" id="zoom_api_key" value="<?php echo $zoom_api_key; ?>">
    <input type="hidden" name="zoom_api_secret" id="zoom_api_secret" value="<?php echo $zoom_api_secret; ?>">
    <input type="hidden" name="meetingID" id="meetingID" value="<?php echo $meetingID; ?>">
    <input type="hidden" name="name" id="name" value="<?php echo $getStudent->name . ' (Username - ' . $getStudent->username . ')' ?>">
    <input type="hidden" name="meeting_password" id="meeting_password" value="<?php echo $liveClass['meeting_password']; ?>">
    <input type="hidden" name="leaveUrl" id="leaveUrl" value="<?php echo base_url('join-zoom-meeting'); ?>">

    <script src="https://source.zoom.us/1.7.8/lib/vendor/jquery.min.js"></script>
    <script src="https://source.zoom.us/1.9.1/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/1.9.1/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/1.9.1/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/1.9.1/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/1.9.1/lib/vendor/lodash.min.js"></script>
    <script src="https://source.zoom.us/1.7.8/lib/vendor/jquery.min.js"></script>
    <script src="https://source.zoom.us/zoom-meeting-1.9.1.min.js"></script>
    <!-- <script src="https://source.zoom.us/zoom-meeting-1.9.1.min.js"></script> -->
    <script src="https://source.zoom.us/zoom-meeting-2.1.1.min.js"></script>
    <script src="<?php echo base_url('application/modules/zoom/assets/js/joinscript.js'); ?>"></script>

</body>
</html>
