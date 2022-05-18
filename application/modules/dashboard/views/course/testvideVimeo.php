<?php 
    $urls   = array();
    $videos = array();
    // vimeo test
    $urls[] = 'https://vimeo.com/551835274';
    // $urls[] = 'https://vimeo.com/243438242';

    foreach ($urls as $url) {
    $videos[] = getVideoDetails($url);
    }
    function getVideoDetails($url)
    {
    $host = explode('.', str_replace('www.', '', strtolower(parse_url($url, PHP_URL_HOST))));
    $host = isset($host[0]) ? $host[0] : $host;
    switch ($host) {
    case 'vimeo':
    $video_id = substr(parse_url($url, PHP_URL_PATH), 1);
    $hash = json_decode(file_get_contents("http://vimeo.com/api/v2/video/{$video_id}.json"));
    // header("Content-Type: text/plain");
    // print_r($hash);
    // exit;
    print_r($hash);
    return array(
    'provider'          => 'Vimeo',
    'title'             => $hash[0]->title,
    'description'       => str_replace(array("<br>", "<br/>", "<br />"), NULL, $hash[0]->description),
    'description_nl2br' => str_replace(array("\n", "\r", "\r\n", "\n\r"), NULL, $hash[0]->description),
    'thumbnail'         => $hash[0]->thumbnail_large,
    'video'             => "https://vimeo.com/" . $hash[0]->id,
    'embed_video'       => "https://player.vimeo.com/video/" . $hash[0]->id,
    );
    break;

    }
    }
    // header("Content-Type: text/plain");
    ?>


<script src="https://f.vimeocdn.com/js/froogaloop2.min.js"></script>
<iframe id="player1" src="https://player.vimeo.com/video/76979871?api=1&player_id=player1" width="630" height="354"
    frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

<div>
    <!-- <button>Play</button>
  <button>Pause</button> -->
    <p>Status: <span class="status">&hellip;</span></p>
</div>
<script>
$(function() {
    var iframe = $('#player1')[0];
    var player = $f(iframe);
    var status = $('.status');

    // When the player is ready, add listeners for pause, finish, and playProgress
    player.addEvent('ready', function() {
        status.text('ready');

        player.addEvent('pause', onPause);
        player.addEvent('play', onPlay);
        player.addEvent('finish', onFinish);
        player.addEvent('playProgress', onPlayProgress);
    });

    // Call the API when a button is pressed
    $('button').bind('click', function() {
        player.api($(this).text().toLowerCase());
    });

    // function onPause(data) {
    //status.text('paused');
    // alert('After-finish-pause');
    // status.text(data);
    // data.seconds
    // var video_watch_time=data.seconds;
    // var after_finish_pause="finish";
    //    $.ajax({
    //         url: base_url + enterprise_shortname + "/video-watch-time",
    //         type: "POST",
    //         data: { video_watch_time: video_watch_time,after_finish_pause:after_finish_pause, csrf_test_name: CSRF_TOKEN },
    //         success: function (r) {
    //            console.log(r);
    //         },
    //     }); 


    // }

    // function onFinish(data) {
    // alert('finish-pause');
    // status.text('finished');
    // console.log(data);
    // console.log('finished');
    //  var finish='finish';
    //  var finishtime=data.seconds;
    //    $.ajax({
    //         url: base_url + enterprise_shortname + "/video-watch-time",
    //         type: "POST",
    //         data: { finish: finish,finishtime:finishtime, csrf_test_name: CSRF_TOKEN },
    //         success: function (r) {
    //            console.log(r);
    //         },
    //     }); 
    // }

    // function onPlayProgress(data) {
    //     status.text(data.seconds + 's played');


    // }





    // var hour = 00;    
    // var min = 00;
    // var sec = 00;
    // var msec = 00;    
    // var elemHour = document.getElementById("hour");
    // var elemMin = document.getElementById("min");
    // var elemSec = document.getElementById("sec");
    // var elemMsec = document.getElementById("msec");


    // var bStart = document.getElementById("start");
    // var bStop = document.getElementById("stop");
    // var bRestart = document.getElementById("restart");
    // var Interval;

    //  function onPlayProgress() {
    // 	clearInterval(Interval);
    //   Interval = setInterval(timer, 10);

    // }

    function convert_time(myNumber) {
        return (myNumber.toString().length < 2) ? "0" + myNumber : myNumber;
    }

    // function onPause() {
    //   clearInterval(Interval);
    //    var total=convert_time(hour)+":"+convert_time(min)+":"+convert_time(sec)+":"+convert_time(msec);
    //    alert(total);
    //   // alert(min);
    //   // alert(sec+);
    //   // alert(msec+=msec);
    // }
    // bRestart.onclick = function() {
    //   clearInterval(Interval);
    //   sec = "00";
    //   msec = "00";
    //   elemMsec.innerHTML = msec;
    //   elemSec.innerHTML = sec;
    // }

    // function timer () {
    //        msec++;


    //       if(msec <= 9){
    //         elemMsec.innerHTML = "0" + msec;
    //       }
    //       if(msec > 9){
    //         elemMsec.innerHTML = msec;
    //       }
    //       if (msec > 99) {
    //         console.log("sec");
    //         sec++;
    //         elemSec.innerHTML = "0" + sec;
    //         msec = 0;
    //         elemMsec.innerHTML = "0" + 0;
    //       }
    //       if(sec > 9){
    //         elemSec.innerHTML = sec;
    //       }
    //       if(sec > 59){
    //         console.log("min");
    //         min++;
    //         elemMin.innerHTML = "0" + min;
    //         sec = 0;
    //         elemSec.innerHTML = "0" + 0;
    //       }
    //       if(min > 9){
    //         elemMin.innerHTML = min;
    //       }
    //       // if(hour <= 9 && hour > 0){
    //       //   elemHour.innerHTML = "0" + hour;
    //       // }
    //       // if(hour > 9){
    //       // elemHour.innerHTML = hour;
    //       // }

    // }






    let tens = 0;
    let seconds = 0;
    let minutes = 0;
    let hours = 0;

    const appendHours = document.getElementById('hours');
    const appendMinutes = document.getElementById('minutes');
    const appendSeconds = document.getElementById('seconds');
    const appendTens = document.getElementById('tens');

    const startBtn = document.querySelector('.start-btn');
    const stopBtn = document.querySelector('.stop-btn');
    const resetBtn = document.querySelector('.reset-btn');


    let Interval;

    // startBtn.addEventListener('click', function(){
    function onPlayProgress() {
        clearInterval(Interval);
        Interval = setInterval(startTimer, 10);

        var started = "start";
        var second = seconds * 1000;
        var minute = minutes * 60000;
        var hour = hours * 3600000;
        var total = hour + minute + second + tens;
        //  $.ajax({
        //     url: base_url + enterprise_shortname + "/video-watch-time",
        //     type: "POST",
        //     data: {watch_time:total,started:started, csrf_test_name: CSRF_TOKEN},
        //     success: function (r) {
        //         console.log(r);
        //     },
        // });

    }
    // });

    // stopBtn.addEventListener('click', function(){
    function onPause() {
        var second = seconds * 1000;
        var minute = minutes * 60000;
        var hour = hours * 3600000;
        var total = hour + minute + second + tens;
        // var total=convert_time(hours)+":"+convert_time(minutes)+":"+convert_time(seconds)+":"+convert_time(tens);
        clearInterval(Interval);
        // alert(total);
        var pause = "pause";
        $.ajax({
            url: base_url + enterprise_shortname + "/video-watch-time",
            type: "POST",
            data: {
                watch_time: total,
                pause: pause,
                csrf_test_name: CSRF_TOKEN
            },
            success: function(r) {
                console.log(r);
            },
        });
    }
    // });

    function onFinish() {
        // var total=convert_time(hours)+":"+convert_time(minutes)+":"+convert_time(seconds)+":"+convert_time(tens);

        clearInterval(Interval);
        var second = seconds * 1000;
        var minute = minutes * 60000;
        var hour = hours * 3600000;
        var total = hour + minute + second + tens;
        var finish = 'finish';
        $.ajax({
            url: base_url + enterprise_shortname + "/video-watch-time",
            type: "POST",
            data: {
                watch_time: total,
                finish: finish,
                csrf_test_name: CSRF_TOKEN
            },
            success: function(r) {
                console.log(r);
            },
        });

    }
    
    function onPlay(){
        alert('Test');
    }
    resetBtn.addEventListener('click', function() {
        clearInterval(Interval);
        tens = "00";
        seconds = "00";
        minutes = "00";
        hours = "00";
        appendSeconds.innerHTML = seconds;
        appendMinutes.innerHTML = minutes;
        appendHours.innerHTML = hours;
        appendTens.innerHTML = tens;
    });




    function startTimer() {
        tens++;

        // tens
        if (tens <= 9) {
            appendTens.innerHTML = "0" + tens;
        }
        if (tens > 9) {
            appendTens.innerHTML = tens;
        }
        if (tens > 99) {
            seconds++;
            appendSeconds.innerHTML = "0" + seconds;
            tens = 0;
            appendTens.innerHTML = "0" + 0;
        }
        // seconds
        if (seconds <= 9 && seconds > 0) {
            appendSeconds.innerHTML = "0" + seconds;
        }
        if (seconds > 9) {
            appendSeconds.innerHTML = seconds;
        }
        if (seconds > 59) {
            minutes++;
            appendMinutes.innerHTML = "0" + minutes;
            seconds = 0;
            appendSeconds.innerHTML = "0" + 0;
        }
        // minutes
        if (minutes <= 9 && minutes > 0) {
            appendMinutes.innerHTML = "0" + minutes;
        }
        if (minutes > 9) {
            appendMinutes.innerHTML = minutes;
        }
        if (minutes > 59) {
            minutes++;
            appendHours.innerHTML = "0" + hours;
            minutes = 0;
            appendMinutes.innerHTML = "0" + 0;
        }
        // hours
        if (hours <= 9 && hours > 0) {
            appendHours.innerHTML = "0" + hours;
        }
        if (hours > 9) {
            appendHours.innerHTML = hours;
        }

    }






});
</script>
<style>
div {
    margin-top: 3px;
    padding: 0 10px;
}

button {
    font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    cursor: pointer;
    font-weight: 700;
    font-size: 13px;
    padding: 8px 18px 10px;
    line-height: 1;
    color: #fff;
    background: #345;
    border: 0;
    border-radius: 4px;
    margin-left: 0.75em;
}

p {
    display: inline-block;
    margin-left: 10px;
}
</style>

<!-- <iframe src="https://player.vimeo.com/video/76979871" width="640" height="360" frameborder="0" allowfullscreen allow="autoplay; encrypted-media"></iframe> -->

<!-- <script src="https://player.vimeo.com/api/player.js"></script> -->
<script>
// var iframe = document.querySelector('iframe');
// var player = new Vimeo.Player(iframe);

// player.on('play', function() {
//     console.log('played the video!');
// });

// player.getVideoTitle().then(function(title) {
//     console.log('title:', title);
// });
</script>
<!-- <iframe src="https://player.vimeo.com/video/76979871?title=0&byline=0&portrait=0&transparent=0&autoplay=1" width="640" height="480" frameborder="0" title="Funny Cat Videos For Kids" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" data-ready="true"></iframe> -->



<!-- <div class="container">
	<span class="ora"> Timer </span>
	<p><span id="hour">00</span> <span id="min">00</span>:<span id="sec">00</span>:<span id="msec">00</span></p>
	<button id="start"> Start </button>
	<button id="stop"> Stop </button>
	<button id="restart"> Restart </button>
</div> -->



<script>
// window.onload = function () {



// }
</script>
<main>
    <div class="container">
        <h1>Stopwatch</h1>
    </div>
    <section class="timer">
        <span id="hours">00</span>
        <span>:</span>
        <span id="minutes">00</span>
        <span>:</span>
        <span id="seconds">00</span>
        <span>:</span>
        <span id="tens">00</span>
    </section>
    <div class="button-container">
        <button class="btn start-btn">start</button>
        <button class="btn stop-btn">stop</button>
        <button class="btn reset-btn">reset</button>
    </div>
</main>
<script type="text/javascript">
//check for Navigation Timing API support

function pageReload() {
    var csrf = $("#CSRF_TOKEN").val();
    var enterprise_shortname = $("#enterprise_shortname").val();
    var target_url = "<?php echo base_url();?>" + enterprise_shortname + '/video-watch-time';
    // alert(base_url + enterprise_shortname + "/video-watch-time");
    var pagereload = 'pagereload';
    $.ajax({
        url: target_url,
        type: "POST",
        data: {
            pagereload: pagereload,
            csrf_test_name: csrf
        },
        success: function(r) {
            console.log(r);
        },
    });
}
pageReload();





</script>

<iframe src="https://player.vimeo.com/video/154192057" id="rrr" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

<script src="https://player.vimeo.com/api/player.js"></script>
<script>
	
    var iframe = document.querySelector('#rrr');
    var player = new Vimeo.Player(iframe);

 
	player.on('pause', function(){
    	alert('Video play completed');
    });
    player.on('ended', function(){
        alert('Video end');
    });
    // player.getVideoTitle().then(function(title) {
    //     console.log('title:', title);
    // });
</script>

