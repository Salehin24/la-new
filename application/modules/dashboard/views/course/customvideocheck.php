<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<script src="<?php echo base_url('assets/dist/video/renderers/mediaelementplayer.css'); ?>"></script>
<script src="<?php echo base_url('assets/dist/video/renderers/mediaelement-and-player.js'); ?>"></script>
<script src="<?php echo base_url('assets/dist/video/renderers/dailymotion.js'); ?>"></script>
<script src="<?php echo base_url('assets/dist/video/renderers/facebook.js'); ?>"></script>
<script src="<?php echo base_url('assets/dist/video/renderers/soundcloud.js'); ?>"></script>
<script src="<?php echo base_url('assets/dist/video/renderers/twitch.js'); ?>"></script>
<script src="<?php echo base_url('assets/dist/video/renderers/vimeo.js'); ?>"></script>
<script src="<?php echo base_url('assets/dist/video/demo.js'); ?>"></script>
<style>
html,
body {
    overflow-x: hidden;
}

#container {
    padding: 0 20px 50px;
}

.error {
    color: red;
}

a {
    word-wrap: break-word;
}

code {
    font-size: 0.8em;
}

#player2-container .mejs__time-buffering,
#player2-container .mejs__time-current,
#player2-container .mejs__time-handle,
#player2-container .mejs__time-loaded,
#player2-container .mejs__time-hovered,
#player2-container .mejs__time-marker,
#player2-container .mejs__time-total {
    height: 2px;
}

#player2-container .mejs__time-total {
    margin-top: 9px;
}

#player2-container .mejs__time-handle {
    left: -5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #ffffff;
    top: -5px;
    cursor: pointer;
    display: block;
    position: absolute;
    z-index: 2;
    border: none;
}

#player2-container .mejs__time-handle-content {
    top: 0;
    left: 0;
    width: 12px;
    height: 12px;
}
</style>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <iframe width="700" height="600" controlsList="nodownload"
            src="<?php echo base_url('assets/Learn PHP in 15 minutes.MP4'); ?>"></iframe>
        <!-- <iframe width="700" height="600" allowfullscreen="true"
            src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe> -->

    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="media-wrapper">
            <video id="player1" width="640" height="360" style="max-width:100%;"
                poster="http://www.mediaelementjs.com/images/big_buck_bunny.jpg" preload="none" controls playsinline
                webkit-playsinline>
                <source src="https://commondatastorage.googleapis.com/gtv-videos-bucket/CastVideos/mp4/BigBuckBunny.mp4"
                    type="video/mp4">
                <track srclang="en" kind="subtitles" src="mediaelement.vtt">
                <track srclang="en" kind="chapters" src="chapters.vtt">
            </video>
        </div>
        <!--<div class="container-player">
             <div id="mediaPlayer">
                <div class="lds-ring" id=preload>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
                <video id='media-video' preload>
                    <source src="https://www.html5rocks.com/en/tutorials/video/basics/devstories.mp4" type='video/mp4'>
                    <source src='parrots.webm' type='video/webm'>
                </video>
                <div id="controls">
                    <button id=play><i class="fas fa-pause"></i></button>
                    <button id=audioVolume class="fas fa-volume-off"></button>
                    <div id="progressBar">
                        <div id="progress"></div>
                    </div>
                    <div id="timer">
                        <span id="start"> 0 : 00</span>
                    </div>
                    <button id=expand><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div id="playlist">
            </div> 
        </div>-->
    </div>
</div>

<hr>
<hr>
<hr>
<div class="row">
    <style>
    @import url(//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css);
    @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800);

    html,
    body,
    div,
    span,
    applet,
    object,
    iframe,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    blockquote,
    pre,
    a,
    abbr,
    acronym,
    address,
    big,
    cite,
    code,
    del,
    dfn,
    em,
    img,
    ins,
    kbd,
    q,
    s,
    samp,
    small,
    strike,
    strong,
    sub,
    sup,
    tt,
    var,
    b,
    u,
    i,
    center,
    dl,
    dt,
    dd,
    ol,
    ul,
    li,
    fieldset,
    form,
    label,
    legend,
    table,
    caption,
    tbody,
    tfoot,
    thead,
    tr,
    th,
    td,
    article,
    aside,
    canvas,
    details,
    embed,
    figure,
    figcaption,
    footer,
    header,
    hgroup,
    menu,
    nav,
    output,
    ruby,
    section,
    summary,
    time,
    mark,
    audio,
    video {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline
    }

    article,
    aside,
    details,
    figcaption,
    figure,
    footer,
    header,
    hgroup,
    menu,
    nav,
    section {
        display: block
    }

    body {
        line-height: 1
    }

    ol,
    ul {
        list-style: none
    }

    blockquote,
    q {
        quotes: none
    }

    blockquote:before,
    blockquote:after,
    q:before,
    q:after {
        content: '';
        content: none
    }

    table {
        border-collapse: collapse;
        border-spacing: 0
    }

    html {
        height: 100%
    }

    body {
        height: 100%;
        margin: 10px;
        paddding: 0;
        background: #F5F5F5;
        font: 14px/21px Helvetica, Arial, sans-serif;
        color: #444;
        -webkit-font-smoothing: antialiased;
        overflow-y: scroll
    }

    .container {
        position: relative;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0
    }

    /* Custom Youtube Player CSS
================================================== */
    .yt-video {
        display: block;
        position: relative;
        width: auto;
        height: auto;
        margin: 0;
        padding: 10px 10px;
        background: #FFF;
        border: 1px solid #DDD;
        border-radius: 3px;
        font: 12px/12px 'Open Sans', Verdana, Arial, sans-serif;
        color: #555
    }

    .yt-video ul,
    .yt-video ul li {
        display: block;
        margin: 0;
        padding: 0;
        list-style: none
    }

    .yt-video .yt-player {
        position: relative;
        width: 100%;
        height: 60%
    }

    .yt-video .yt-player:before {
        content: "";
        display: block;
        padding-top: 60%
    }

    .yt-video .yt-player iframe {
        display: block;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 100%;
        margin: 0
    }

    .yt-video .yt-interface {
        display: block;
        position: relative;
        z-index: 1;
        overflow: visible
    }

    .yt-video .yt-interface .yt-controls-holder {
        position: relative
    }

    .yt-video .yt-interface ul,
    .yt-video .yt-interface ul li {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        margin: 0;
        padding: 0
    }

    .yt-video .yt-interface ul.yt-controls {
        position: relative;
        margin: 0;
        padding: 0;
        width: auto;
        height: 35px;
        list-style: none;
        overflow: hidden
    }

    .yt-video .yt-interface ul.yt-controls a {
        display: block;
        text-indent: -9999px;
        overflow: hidden
    }

    .yt-video .yt-interface ul.yt-controls a.yt-play,
    .yt-video .yt-interface ul.yt-controls a.yt-pause {
        position: absolute;
        top: 0;
        left: 0;
        height: 35px;
        width: 34px;
        border-right: 1px solid #DDD
    }

    .yt-video .yt-interface ul.yt-controls a.yt-mute,
    .yt-video .yt-interface ul.yt-controls a.yt-unmute {
        position: absolute;
        top: 0;
        right: 60px;
        height: 35px;
        width: 34px;
        border-left: 1px solid #DDD
    }

    .yt-video .yt-interface ul.yt-controls a.yt-unmute {
        display: none
    }

    .yt-video .yt-interface ul.yt-controls a:before {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        font: 16px/35px 'FontAwesome';
        text-align: center;
        text-indent: 0;
        color: #333;
        -webkit-transition: all .3s ease;
        -moz-transition: all .3s ease;
        transition: all .3s ease
    }

    .yt-video .yt-interface ul.yt-controls a:after {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        font: 16px/35px 'FontAwesome';
        text-align: center;
        text-indent: 0;
        color: #333;
        -webkit-transition: all .3s ease;
        -moz-transition: all .3s ease;
        transition: all .3s ease
    }

    .yt-video .yt-interface ul.yt-controls a:hover:before,
    .yt-video .yt-interface ul.yt-controls a:hover:after {
        color: #4285f4
    }

    .yt-video .yt-interface ul.yt-controls a.yt-play:before {
        content: "\f04b"
    }

    .yt-video .yt-interface ul.yt-controls a.yt-pause:before {
        content: "\f04c"
    }

    .yt-video .yt-interface ul.yt-controls a.yt-mute:before {
        content: "\f028"
    }

    .yt-video .yt-interface ul.yt-controls a.yt-unmute:before {
        content: "\f026"
    }

    .yt-video .yt-interface .yt-quality {
        position: absolute;
        top: 0;
        bottom: 0;
        right: 95px;
        left: auto;
        margin: 0;
        padding: 0;
        width: auto;
        height: auto;
        min-width: 35px;
        border-left: 1px solid #DDD;
        list-style: none;
        overflow: visible
    }

    .yt-video .yt-interface .yt-quality:before {
        content: '\f013';
        display: block;
        position: absolute;
        top: auto;
        bottom: 0;
        right: 0;
        left: auto;
        margin: 0;
        padding: 0;
        width: 35px;
        height: 35px;
        font: 16px/35px 'FontAwesome';
        color: #333;
        text-align: center;
        list-style: none;
        overflow: hidden;
        -webkit-transition: all .3s ease;
        -moz-transition: all .3s ease;
        transition: all .3s ease
    }

    .yt-video .yt-interface .yt-quality:hover:before {
        color: #4285f4
    }

    .yt-video .yt-interface .yt-quality ul {
        display: none;
        position: absolute;
        top: auto;
        bottom: 34px;
        right: auto;
        left: 0;
        width: 90px;
        height: auto;
        margin: 0;
        padding: 0;
        background: #FFF
    }

    .yt-video .yt-interface .yt-quality:hover ul {
        display: block;
        -webkit-animation: ytQualityReveal .5s;
        -moz-animation: ytQualityReveal .5s;
        animation: ytQualityReveal .5s
    }

    .yt-video .yt-interface .yt-quality ul li {
        display: block;
        position: relative;
        top: auto;
        bottom: auto;
        right: auto;
        left: auto
    }

    .yt-video .yt-interface .yt-quality ul li a {
        display: block;
        position: relative;
        top: auto;
        bottom: auto;
        right: auto;
        left: auto;
        margin: 0;
        padding: 5px 10px;
        border-bottom: 1px solid #DDD;
        font: 12px/16px 'Open Sans', Helvetica, Arial, sans-serif;
        color: #4285f4;
        text-decoration: none;
        text-align: left;
        -webkit-transition: all .3s ease;
        -moz-transition: all .3s ease;
        transition: all .3s ease
    }

    .yt-video .yt-interface .yt-quality ul li a:before {
        content: '\f060';
        display: block;
        position: absolute;
        top: 50%;
        bottom: auto;
        left: auto;
        right: 0;
        height: auto;
        width: 20px;
        margin: -10px 0;
        padding: 0;
        font: 10px/20px 'FontAwesome';
        color: #FFF;
        text-align: center;
        -webkit-transition: all .3s ease;
        -moz-transition: all .3s ease;
        transition: all .3s ease
    }

    .yt-video .yt-interface .yt-quality ul li:hover a:before {
        right: 5px
    }

    .yt-video .yt-interface .yt-quality ul li.active a:before {
        content: '\f00c'
    }

    .yt-video .yt-interface .yt-quality ul li:hover a,
    .yt-video .yt-interface .yt-quality ul li.active a {
        background: #4285f4;
        color: #FFF
    }

    .yt-video .yt-interface .yt-current-time {
        position: absolute;
        z-index: 1;
        top: 35px;
        left: 0;
        width: 50px;
        height: 25px;
        text-align: right;
        font-size: 10px;
        color: #DDD;
        line-height: 25px;
        overflow: hidden
    }

    .yt-video .yt-interface .yt-duration {
        position: absolute;
        z-index: 1;
        top: 35px;
        right: 0;
        width: 50px;
        height: 25px;
        text-align: left;
        font-size: 10px;
        color: #DDD;
        line-height: 25px;
        overflow: hidden
    }

    .yt-video .yt-volume-bar {
        position: absolute;
        top: 12px;
        right: 10px;
        height: 11px;
        width: 50px;
        background: #CCC;
        overflow: hidden;
        cursor: pointer
    }

    .yt-video .yt-volume-bar .yt-volume-bar-value {
        width: 0;
        height: 11px;
        background: #333;
        -webkit-transition: background .3s ease;
        -moz-transition: background .3s ease;
        transition: background .3s ease
    }

    .yt-video .yt-volume-bar:hover .yt-volume-bar-value {
        background: #4285f4
    }

    .yt-video .yt-progress {
        position: absolute;
        z-index: 2;
        top: 12px;
        right: 140px;
        left: 45px;
        height: 11px;
        width: auto;
        background: #CCC;
        overflow: hidden;
        cursor: pointer
    }

    .yt-video .yt-progress .yt-seek-bar {
        margin: 0;
        padding: 0;
        height: 11px
    }

    .yt-video .yt-progress .yt-play-bar {
        width: 0;
        height: 11px;
        background: #333;
        -webkit-transition: background .3s ease;
        -moz-transition: background .3s ease;
        transition: background .3s ease
    }

    .yt-video .yt-progress:hover .yt-play-bar {
        background: #4285f4
    }

    .yt-video .yt-title {
        position: relative;
        z-index: 0;
        margin: 0;
        padding: 0 80px;
        height: 25px;
        width: auto;
        background: #333;
        font: 12px/25px 'Open Sans', Helvetica, Arial, sans-serif;
        text-align: center;
        color: #FFF;
        overflow: hidden
    }

    @-webkit-keyframes ytQualityReveal {
        0% {
            opacity: 0;
            margin-bottom: -10px
        }

        100% {
            opacity: 1;
            margin-top: 0
        }
    }

    @-moz-keyframes ytQualityReveal {
        0% {
            opacity: 0;
            margin-bottom: -10px
        }

        100% {
            opacity: 1;
            margin-top: 0
        }
    }

    keyframes ytQualityReveal {
        0% {
            opacity: 0;
            margin-bottom: -10px
        }

        100% {
            opacity: 1;
            margin-top: 0
        }
    }
    </style>
    <div class="container">
        <div class="columns sixteen">

            <div id="yt-video-wrap" class="yt-video">
                <div class="yt-player">
                    <div id="yt-player"></div>
                </div>
                <div class="yt-gui">
                    <div class="yt-interface">
                        <div class="yt-controls-holder">
                            <ul class="yt-controls">
                                <li><a href="#" class="yt-play">play</a></li>
                                <li><a href="#" class="yt-pause">pause</a></li>
                                <li><a href="#" class="yt-mute">mute</a></li>
                                <li><a href="#" class="yt-unmute">unmute</a></li>
                            </ul>
                            <div class="yt-quality">
                                <ul>
                                    <li><a href="#" data-quality="small">240p</a></li>
                                    <li><a href="#" data-quality="medium">360p</a></li>
                                    <li><a href="#" data-quality="large">480p</a></li>
                                    <li><a href="#" data-quality="hd720">720p</a></li>
                                    <li><a href="#" data-quality="hd1080">1080p</a></li>
                                    <li><a href="#" data-quality="highres">Best</a></li>
                                </ul>
                            </div>
                            <div class="yt-volume-bar">
                                <div class="yt-volume-bar-value"></div>
                            </div>
                        </div>
                        <div class="yt-progress">
                            <div class="yt-seek-bar">
                                <div class="yt-play-bar"></div>
                            </div>
                        </div>
                        <div class="yt-current-time">0:00</div>
                        <div class="yt-duration">0:00</div>
                        <div class="yt-title">Title </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="clear"></div>
    </div>

    <script>
jQuery(document).ready(function(){jQuery.getScript('//www.youtube.com/iframe_api');});
var yt_01_player_object,
	yt_01_video_wrap = jQuery('#yt-video-wrap'),
	yt_01_player_id = 'yt-player',
	yt_01_timeInterval = 0;

function onYouTubeIframeAPIReady(){

	yt_01_player_object = new YT.Player(yt_01_player_id,{
		height		: '540',
		width		: '960',
		videoId		: '1uhyB3TEnwU',
        playerVars: { 'enablejsapi':1,'autoplay':1,'controls':0,'rel':0,'showinfo':0,'egm':0,'showsearch':0,'modestbranding':1,'iv_load_policy':3,'disablekb':0,'loop':0},
		// playerVars:{
		// 	'autohide':		1,
		// 	'autoplay':		0,
		// 	'controls': 		0,
		// 	'fs':			1,
		// 	'disablekb':		0,
		// 	'modestbranding':	1,
		// 	// 'cc_load_policy': 	1, // forces closed captions on
		// 	'iv_load_policy':		3, // annotations, 1=on, 3=off
		// 	// 'playlist': 		videoID, videoID, videoID, etc,
		// 	'rel':			0,
		// 	'showinfo':		0,
		// 	'theme':			'light',	// dark, light
		// 	'color':			'white'	// red, white
		// },
		events:{
			'onReady': yt_01_onPlayerReady,
			'onStateChange': yt_01_onPlayerStateChange,
			'onError': yt_01_onPlayerError
		}
	});

}
function yt_01_onPlayerReady(){
	yt_01_initializePlayerControls();
}
var seconds = 0;
var timer;
function yt_01_onPlayerStateChange(state){
	switch(state.data){
		case -1: //unstarted
			// do nothing
			break;
		case 0: // ended
			yt_01_video_wrap.find('.yt-pause').hide();
			yt_01_video_wrap.find('.yt-play').show();
			break;
		case 1: // playing
			yt_01_video_wrap.find('.yt-pause').show();
			yt_01_video_wrap.find('.yt-play').hide();

			yt_01_startYoutubeTime();

            if (state.data == YT.PlayerState.PLAYING) {
                    //player play
                    var video_watch_time=Math.floor(yt_01_player_object.getCurrentTime()/60)+':'+yt_01_FormatNumberLength(Math.round(yt_01_player_object.getCurrentTime()%60),2);
                    console.log( Math.floor(yt_01_player_object.getCurrentTime()/60)+':'+yt_01_FormatNumberLength(Math.round(yt_01_player_object.getCurrentTime()%60),2));
                    $('#watchtime').val(Math.floor(yt_01_player_object.getCurrentTime()/60)+':'+yt_01_FormatNumberLength(Math.round(yt_01_player_object.getCurrentTime()%60),2));
                    $.ajax({
                        url: base_url + enterprise_shortname + "/video-watch-time",
                        type: "POST",
                        data: { video_watch_time: video_watch_time, csrf_test_name: CSRF_TOKEN },
                        success: function (r) {
                           alert(r);
                        },
                    });
                    
                } else {
                //player pause
                clearInterval(timer);
            }
			break;
		case 2: // paused
			yt_01_video_wrap.find('.yt-pause').hide();
			yt_01_video_wrap.find('.yt-play').show();
			break;
		case 3: // buffering
			// do nothing
			break;
		case 5: // video cued
			// do nothing
			break;
		default:
			// do nothing
	}
}
function yt_01_onPlayerError(error){
	console.log(error);
}
function yt_01_startYoutubeTime(){
	if(yt_01_timeInterval > 0) clearInterval(yt_01_timeInterval);  // stop
	yt_01_timeInterval = setInterval( "yt_01_updateYoutubeTime()", 100 );  // run
}
function yt_01_updateYoutubeTime(){
	if( yt_01_player_object.getCurrentTime()>=60 ){
		yt_01_video_wrap.find('.yt-current-time').text( Math.floor(yt_01_player_object.getCurrentTime()/60)+':'+yt_01_FormatNumberLength(Math.round(yt_01_player_object.getCurrentTime()%60),2) );
	}else{
		yt_01_video_wrap.find('.yt-current-time').text( '0:'+yt_01_FormatNumberLength(Math.floor(yt_01_player_object.getCurrentTime()),2) );
	}
	yt_01_video_wrap.find('.yt-progress .yt-play-bar').width( Math.floor((yt_01_player_object.getCurrentTime()/yt_01_player_object.getDuration())*100)+'%' );
}
function yt_01_FormatNumberLength(num,length){var r=""+num;while(r.length<length){r="0"+r;}return r;}
function yt_01_initializePlayerControls(index){
	yt_01_video_wrap.find('.yt-pause').hide();
	yt_01_video_wrap.find('.yt-unmute').hide();
	yt_01_video_wrap.find('.yt-restore-screen').hide();

	yt_01_player_object.setVolume(80);
	yt_01_video_wrap.find('.yt-volume-bar .yt-volume-bar-value').width( '80%' );
	
	yt_01_video_wrap.on('click','.yt-play',function(e){
		e.preventDefault();
		jQuery(this).hide();
		yt_01_video_wrap.find('.yt-pause').show();
		yt_01_player_object.playVideo();
	});
	yt_01_video_wrap.on('click','.yt-pause',function(e){
		e.preventDefault();
		jQuery(this).hide();
		yt_01_video_wrap.find('.yt-play').show();
		yt_01_player_object.pauseVideo();
	});
	yt_01_video_wrap.on('click','.yt-mute',function(e){
		e.preventDefault();
		jQuery(this).hide();
		yt_01_video_wrap.find('.yt-unmute').show();
		yt_01_video_wrap.find('.yt-volume-bar .yt-volume-bar-value').hide();
		yt_01_player_object.mute();
	});
	yt_01_video_wrap.on('click','.yt-unmute',function(e){
		e.preventDefault();
		jQuery(this).hide();
		yt_01_video_wrap.find('.yt-mute').show();
		yt_01_video_wrap.find('.yt-volume-bar .yt-volume-bar-value').show();
		yt_01_player_object.unMute();
	});
	yt_01_video_wrap.find('.yt-volume-bar').on('click',function(e){
		e.preventDefault();
		var posX = jQuery(this).offset().left, posWidth = jQuery(this).width();
		posX = (e.pageX-posX)/posWidth;
		yt_01_video_wrap.find('.yt-volume-bar .yt-volume-bar-value').width( (posX*100)+'%' ).show();
		yt_01_player_object.setVolume(posX*100);
		
		yt_01_video_wrap.find('.yt-unmute').hide();
		yt_01_video_wrap.find('.yt-mute').show();
	});
	yt_01_video_wrap.find('.yt-seek-bar').on('click',function(e){
		e.preventDefault();
		var posX = jQuery(this).offset().left, posWidth = jQuery(this).width();
		posX = (e.pageX-posX)/posWidth;
		yt_01_video_wrap.find('.yt-progress .yt-play-bar').width( (posX*100)+'%' );
		posX = Math.round((posX)*yt_01_player_object.getDuration());
		yt_01_player_object.seekTo(posX, true);
	});
	yt_01_video_wrap.find('.yt-quality ul li a').on('click',function(e){
		e.preventDefault();
		var quality = jQuery(this).data('quality');
		jQuery(this).parents('li').siblings('li').removeClass('active');
		jQuery(this).parents('li').addClass('active');
		yt_01_player_object.stopVideo();
		yt_01_player_object.setPlaybackQuality(quality);
		yt_01_player_object.playVideo();
	});
}
jQuery(document).ready(function(){
	jQuery.getJSON('https://www.googleapis.com/youtube/v3/videos?id=1uhyB3TEnwU&key=AIzaSyCXI4mJa2v2iAcX5fB2VIa6WOHePAOEE2g&part=snippet,contentDetails,statistics,status',function(data) {
		yt_01_video_wrap.find('.yt-title').text( data.items[0].snippet.title +' - from: '+ data.items[0].snippet.channelTitle );

		var reptms = /^PT(?:(\d+)H)?(?:(\d+)M)?(?:(\d+)S)?$/;
		var hours = 0,
			minutes = 0,
			seconds = 0,
			totalseconds;
		if (reptms.test(data.items[0].contentDetails.duration)) {
			var matches = reptms.exec(data.items[0].contentDetails.duration);
			if (matches[1]) hours = Number(matches[1]);
			if (matches[2]) minutes = Number(matches[2]);
			if (matches[3]) seconds = Number(matches[3]);
			totalseconds = hours * 3600 + minutes * 60 + seconds;
		}

		yt_01_video_wrap.find('.yt-duration').text( Math.floor(totalseconds/60)+':'+((totalseconds%60)-1) );
	});
});
jQuery.fn.filterNode = function(name) {
	return this.find('*').filter(function() {
		return this.nodeName === name;
	});
};
    </script>
</div>

<script src="<?php //echo base_url('application/modules/dashboard/assets/js/course.js') ?>"></script>