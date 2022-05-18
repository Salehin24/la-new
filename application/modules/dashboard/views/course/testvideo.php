<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>JS Bin</title>
</head>
<body>
  <div id="player"></div>
  <input type='text' value="" id="videoTime">
</body>
</html>

<script type="text/javascript">
  var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// 3. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
var player;

function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
        enablejsapi: 1,
        height: '390',
        width: '640',
        videoId: 'i1UHZ6gqOxs',
        playerVars: { 'enablejsapi':1,'autoplay':1,'controls':0,'rel':0,'showinfo':0,'egm':0,'showsearch':0,'modestbranding':1,'iv_load_policy':3,'disablekb':0,'loop':0},
        //  playerVars:{
        //     'autoplay':1,
        //     'controls': 1,
        //      'fs':0,
        //      'disablekb': 0,
        //      'modestbranding': 1,
        //      'cc_load_policy': 1, // forces closed captions on
        //      'iv_load_policy': 3, // annotations, 1=on, 3=off
        //      // 	// 'playlist': 		videoID, videoID, videoID, etc,
        //      'rel': 0,
        //      'showinfo': 0,
        //      // 	'theme':			'light',	// dark, light
        //      // 	'color':			'white'	// red, white
        //      'autohide':1,
		//  },
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    });
}

// 4. The API will call this function when the video player is ready.
var seconds = 0;
var timer;
function onPlayerReady(event) {
 event.target.playVideo();
}
// YT.PlayerState.BUFFERING
// YT.PlayerState.CUED
function onPlayerStateChange(event) {
    if (event.data == YT.PlayerState.PLAYING) {
    // if (event.data == YT.PlayerState.ENDED) {
        //player play
        timer = setInterval(
          function() {
            seconds++;
            console.log("you watch: "+ seconds +" seconds of the video");
            $('#videoTime').val(seconds);
          }, 1000
        );
        
    } else {
      //player pause
      clearInterval(timer);
    }
    
    // if (event.data == YT.PlayerState.ENDED) {               
    //         console.log("Video Ended");
    //     }

    //     if (event.data == YT.PlayerState.PLAYING) {             
    //         console.log("Video Playing");
    //         $(".ytp-contextmenu").addClass('hello');
    //     }

    //     if (event.data == YT.PlayerState.PAUSED) {              
    //         console.log("Video Paused");
    //         $(".ytp-contextmenu").addClass('hello');
    //     }

    //     if (event.data == YT.PlayerState.BUFFERING) {               
    //         console.log("Video Buffering");
    //         $(".ytp-contextmenu").addClass('hello');
            
    //     }

    //     if (event.data == YT.PlayerState.CUED) {                
    //         console.log("Video Cued");
           
    //     }

}

function stopVideo() {
    player.stopVideo();
}



</script>
