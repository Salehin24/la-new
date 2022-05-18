<!-- =============================================================================== -->
<?php  //d($vimeodata['embed_video']); ?>
<script src="https://f.vimeocdn.com/js/froogaloop2.min.js"></script>
<iframe id="player1" src="<?php echo $vimeodata['embed_video']; ?>?api=1&player_id=player1" width="630" height="354"
    frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
<!--End Start Course Preview Video-->
<script src="https://cdn.rawgit.com/jrue/Vimeo-jQuery-API/master/dist/jquery.vimeo.api.min.js"></script>
<input type="text" id="timevalue">
<input type="text" id="timecountstart">
<input type="hidden" id="today" value="<?php echo date('Y-m-d'); ?>">
<br>
<input type="text" id="summation_time" value="0">

<script>

$("#player1").on("playProgress", function(event, data){
    var dt = new Date();
    var today = $("#today").val();
    var starttime = $("#timevalue").val();
    var running_time = data.seconds;
    var stoptime = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
    $("#timevalue").attr("value", stoptime);
    var type = 'playProgress';
    var summation_time = $("#summation_time").val();

    var t1 = new Date(today +" "+stoptime);
    var t2 = new Date(today +" "+starttime);
    var dif = ( t1.getTime() - t2.getTime() ) / 1000;
    console.log(today+ ' ' + stoptime);
    console.log(today+ ' ' + starttime);
    var total_caltime = parseFloat(summation_time) + parseFloat(dif);
    $("#summation_time").val(total_caltime);
    console.log(dif);

  


    // var stop_a = stoptime.split(':'); // split it at the colons
    // // minutes are worth 60 seconds. Hours are worth 60 minutes.
    // var stop_seconds = (+stop_a[0]) * 60 * 60 + (+stop_a[1]) * 60 + (+stop_a[2]);

    // var start_a = starttime.split(':'); // split it at the colons
    // // minutes are worth 60 seconds. Hours are worth 60 minutes.
    // var start_seconds = (+start_a[0]) * 60 * 60 + (+start_a[1]) * 60 + (+start_a[2]);
    // var start_stop_difference = stop_seconds-start_seconds
    // var start_stop_summation = start_stop_difference+ +start_stop_difference
    
    // console.log(start_stop_summation);

    // var t1 = new Date("2021-08-25 07:41:07");
    // var t2 = new Date("2021-08-25 07:50:07");
    // var dif = ( t2.getTime() - t1.getTime() ) / 1000;
    // console.log(dif)

    // console.log(running_time);

    // $.ajax({
    //     url: base_url + enterprise_shortname + "/set-timewatch",
    //     type: "POST",
    //     data: {
    //         csrf_test_name: CSRF_TOKEN,
    //         starttime: starttime,
    //         stoptime: stoptime,
    //         running_time : running_time,
    //         type : type,
    //     },
    //     success: function(r) {
    //         // console.log(r);
    //         // $("#timecountstart").attr("value", '');
    //         // $("#timevalue").attr("value", '');
    //     },
    // });
});

$(function() {
    var iframe = $('#player1')[0];
    var player = $f(iframe);
    var status = $('.status');

    // When the player is ready, add listeners for pause, finish, and playProgress
    player.addEvent('ready', function() {
        status.text('ready');
        player.addEvent('play', onPlay);
        player.addEvent('pause', onPause);
        player.addEvent('finish', onFinish);
        // player.addEvent('playProgress', onPlayProgress);
        player.addEvent('playProgress', playProgress);
        player.addEvent('bufferend', onPlayBufferend);
        player.addEvent('bufferstart', onPlayBufferstart);
    });

    // Call the API when a button is pressed
    $('button').bind('click', function() {
        player.api($(this).text().toLowerCase());
    });
});

function onPlay() {
    $("#timecountstart").attr("value", '');
    $("#timevalue").attr("value", '');
    var dt = new Date();
    var starttime = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
    $("#timecountstart").attr("value", starttime);
    $("#timevalue").attr("value", starttime);
}

var onPlayBufferstart = function(data) {
  console.log('onPlayBufferstart');
};


var onPlayBufferend = function(data) {
  console.log('onPlayBufferend');
};


// startBtn.addEventListener('click', function(){
// var start = 1;

// function onPlayProgress(data, id) {
//     var dt = new Date();
//     var starttime = $("#timevalue").val();
//     var stoptime = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
//     $("#timevalue").attr("value", stoptime);
//     var running_time = data.seconds;
//     // console.log(data);
//     // var currentPercent = Math.ceil(data.percent * 100);

//     // var timestamp = (new Date()).getTime();
//     //     timestamp = Math.floor(timestamp / 1000);

//     // console.log(currentPercent);
//     // console.log(timestamp);

//     $.ajax({
//         url: base_url + enterprise_shortname + "/set-timewatch",
//         type: "POST",
//         data: {
//             csrf_test_name: CSRF_TOKEN,
//             starttime: starttime,
//             stoptime: stoptime,
//             running_time : running_time,
//         },
//         success: function(r) {
//             console.log(r);
//             $("#timecountstart").attr("value", data.seconds);
//             $("#timevalue").attr("value", data.seconds);
//         },
//     });
// }
// });



// stopBtn.addEventListener('click', function(){


function onPause() {
    var dt = new Date();
    var starttime = $("#timecountstart").val();
    var stoptime = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
    $("#timevalue").attr("value", stoptime);
    var type = 'pause';
    // alert(starttime);
    // alert(stoptime);
    $.ajax({
        url: base_url + enterprise_shortname + "/set-timewatch",
        type: "POST",
        data: {
            csrf_test_name: CSRF_TOKEN,
            // starttime: starttime,
            // stoptime: stoptime,
            type: type,
        },
        success: function(r) {
            console.log(r);
            // $("#timecountstart").attr("value", '');
            // $("#timevalue").attr("value", '');
        },
    });
}


// });

// var f = 1;

function onFinish() {
    //     var dt = new Date();
    //     var starttime = $("#timecountstart").val();
    //     var stoptime = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
    //     if (f == 1) {
    //         alert(starttime);
    //         alert(stoptime);
    //         $.ajax({
    //             url: base_url + enterprise_shortname + "/set-timewatch",
    //             type: "POST",
    //             data: {
    //                 csrf_test_name: CSRF_TOKEN,
    //                 starttime: starttime,
    //                 stoptime: stoptime,
    //             },
    //             success: function(r) {
    //                 $("#timecountstart").attr("value", '');
    //                 $("#timevalue").attr("value", '');
    //             },
    //         });
    //     }
}
// f++;
</script>
<!-- =============================================== -->
<style>
.container {
    text-align: center;
    display: block;
    margin: 0 auto;
    top: 30%;
    position: relative;
}

button {
    color: white;
    background: #0b1f69;
    box-shadow: none !important;
    border: 2px solid #0b1f69;
    min-width: 6%;
    padding: 5px;
    border-radius: 50px;
    font-family: MONOSPACE;
    font-size: 18px;
}

body {
    font-family: MONOSPACE;
}

.container .ora,
.container p {
    font-size: 45px;
    text-transform: uppercase;
    color: #0b1f69;
}
</style>
<div class="container">
    <!-- <span class="ora"> Timer </span> -->
    <!-- <p> <span id="min">00</span>:<span id="sec">00</span>:<span id="msec">00</span></p> -->
    <?php 
    // date_default_timezone_set("Asia/Dhaka");
    // $nowtime = date('H:i:s'); 
    ?>
    <!-- <button id="timecountstart" onclick="timecountstart()"> Play </button>
    <button id="timecountstop" onclick="timecountstop()"> Stop </button> -->
    <!-- <button id="restart"> Restart </button> -->
</div>

<script>
"use strict";

function timecountstart() {
    var dt = new Date();
    var starttime = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
    $("#timecountstart").attr("value", starttime);
    // alert(time);
}

function timecountstop() {
    var dt = new Date();
    var starttime = $("#timecountstart").val();
    var stoptime = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
    alert(starttime);
    alert(stoptime);
    $.ajax({
        url: base_url + enterprise_shortname + "/set-timewatch",
        type: "POST",
        data: {
            csrf_test_name: CSRF_TOKEN,
            starttime: starttime,
            stoptime: stoptime,
        },
        success: function(r) {
            console.log(r);
        },
    });
}

function timecount() {}
</script>