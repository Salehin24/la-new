<script>

</script>

<!--Start Course Preview Video-->
<?php $user_id = $this->session->userdata('user_id');?>
<div class="course-preview__video">
    <div class="ratio ratio-16x9">
        <?php
       $imageget= $this->db->select("*")->from("picture_tbl")->where('from_id',$get_lessoninfo->lesson_id)->get()->row();
        if($get_lessoninfo->lesson_type==1){
              if ($get_lessoninfo->lesson_provider == 1) {
            ?>
            <!-- video  -->
        <iframe src="<?php echo (!empty($get_youtubevimeovideoapi['embed_video']) ? $get_youtubevimeovideoapi['embed_video'] : ''); ?>"
            title="YouTube video" allowfullscreen></iframe>
        <?php } elseif ($get_lessoninfo->lesson_provider == 2) { 
            $cookie_vid=str_getcsv($get_youtubevimeovideoapi['video'], "/", "'");
            // #t=s
          
            ?>
        <input type="hidden" id="eachvideoDuration" value="<?php echo $get_youtubevimeovideoapi['duration'];?>">
        <input type="hidden" id="cookie_vid" value="<?php echo $cookie_vid[3];?>">
        <iframe id="player1" src="<?php echo $get_youtubevimeovideoapi['embed_video']; ?>?api=1&loop=false&quality=240p&player_id=player1&t='+timeElapsed_<?php echo $cookie_vid[3];?>"
            width="100%" height="354"  frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            <!-- keyboard=false& -->
        <?php }}elseif($get_lessoninfo->lesson_type==2){?>
            <!-- doc file  -->
            <?php $doc_file= $this->db->select("*")->from("picture_tbl")->where('from_id',$get_lessoninfo->lesson_id)->get()->row();?>
            <?php //echo base_url($img->picture);?>
            <iframe src="https://docs.google.com/gview?url=<?php echo base_url($doc_file->picture);?>&embedded=true"></iframe>
            <!-- <iframe src="https://docs.google.com/gview?url=https://soft6.bdtask.com/file-sample_100kB.doc&embedded=true"></iframe> -->
                <!-- <button class="btn btn-primary completebutton" type="button" id="button-addon2" onclick="Completelesson('<?php echo $get_lessoninfo->lesson_id;?>')" style="position: relative;width:100px;margin-left:85%">Complete</button> -->
            <div style='position: relative;width:100px;margin-left:85%' class="completebutton_replace"></div>
            
            <?php 
            $complete_ls_id=$this->db->select("*")->from("watch_time_tbl")->where("course_id",$get_lessoninfo->course_id)->where("lesson_id",$get_lessoninfo->lesson_id)->get()->row();
            if(@$complete_ls_id->is_complete){?>
            <button class="btn btn-primary" type="button" id="button-addon2"  style="position: relative;width:100px;margin-left:85%">Completed</button>  
            <?php }else{?>
             <button class="btn btn-primary completebutton" type="button" id="button-addon2" onclick="Completelesson('<?php echo $get_lessoninfo->lesson_id;?>')" style="position: relative;width:100px;margin-left:85%">Complete</button>
            <?php }?>


            <?php }elseif($get_lessoninfo->lesson_type==3){?>
            <!-- image  -->
           <!-- <img src="<?php echo base_url($imageget->picture);?>"> -->
          <?php 
           $ssss= $this->db->select("*")->from("picture_tbl")->where('from_id',$get_lessoninfo->lesson_id)->get()->result();
           $numItems = count( $ssss);
        //   foreach($ssss as $multipleImage){
        //   echo $multipleImage->picture;
          ?>

          <?php //}?>
          <!-- data-bs-ride="carousel" -->  
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
                <div class="carousel-inner">
                    <?php  
                    $ml=1;
                    foreach($ssss as $multipleImage){
                  
                    ?>
                    <div class="carousel-item <?php if($ml==1){echo "active";}?>">
                    <img src="<?php echo base_url($multipleImage->picture);?>" class="d-block w-100" alt="..." width="100%" height="400">
                    </div>
                    <?php $ml++;}?>
                </div>
                <?php if( $numItems > 1){?>
                <div class="f3-buttons text-end nxtpreviousbtn mt-2" style="position: absolute;">
                    <button type="button" class="btn btn-previous " data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">Previous</button>
                    <button type="button" class="btn  btn-next" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">Next</button>
                </div>
                <?php }?>
                <div style='position: relative;width:100px;margin-left:85%' class="completebutton_replace mt-2 "></div>
                <?php 
                $complete_ls_id=$this->db->select("*")->from("watch_time_tbl")->where("course_id",$get_lessoninfo->course_id)->where("lesson_id",$get_lessoninfo->lesson_id)->get()->row();
                if(@$complete_ls_id->is_complete){?>
                <button class="btn btn btn-dark-cerulean" type="button" id="button-addon2"  style="position: relative;width:100px;margin-left:85%">Completed</button>  
                <?php }else{?>
                <button class="btn btn btn-dark-cerulean completebutton" type="button" id="button-addon2" onclick="Completelesson('<?php echo $get_lessoninfo->lesson_id;?>')" style="position: relative;width:100px;margin-left:85%">Complete</button>
                <?php }?>
            </div>

            

           <!-- <button class="btn btn-primary completebutton" type="button" id="button-addon2" onclick="Completelesson('<?php echo $get_lessoninfo->lesson_id;?>')" style="position: relative;width:100px;margin-left:85%">Complete</button> -->
          
           <?php }elseif($get_lessoninfo->lesson_type==4){?>
            <!-- pptx  -->
            <!-- <iframe src="https://docs.google.com/gview?url=https://soft6.bdtask.com/samplepptx.pptx&embedded=true"></iframe> -->
            <iframe src="https://docs.google.com/gview?url=<?php echo base_url($imageget->picture);?>&embedded=true"></iframe>
            <!-- <button class="btn btn-primary completebutton" type="button" id="button-addon2" onclick="Completelesson('<?php echo $get_lessoninfo->lesson_id;?>')" style="position: relative;width:100px;margin-left:85%">Complete</button> -->
            <div style='position: relative;width:100px;margin-left:85%' class="completebutton_replace"></div>
            <?php 
            $complete_ls_id=$this->db->select("*")->from("watch_time_tbl")->where("course_id",$get_lessoninfo->course_id)->where("lesson_id",$get_lessoninfo->lesson_id)->get()->row();
            if(@$complete_ls_id->is_complete){?>
            <button class="btn btn-primary" type="button" id="button-addon2"  style="position: relative;width:100px;margin-left:85%">Completed</button>  
            <?php }else{?>
             <button class="btn btn-primary completebutton" type="button" id="button-addon2" onclick="Completelesson('<?php echo $get_lessoninfo->lesson_id;?>')" style="position: relative;width:100px;margin-left:85%">Complete</button>
            <?php }?>
        <?php }elseif($get_lessoninfo->lesson_type==5){?>
            <!-- pdf  -->
           <embed src="<?php echo base_url($imageget->picture);?>" type="application/pdf" width="100%" height="100%" />
           <!-- <div><embed src="<?php echo base_url($imageget->picture);?>#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" width="100%" height="600px" /></div> -->
         
            <div style='position: relative;width:100px;margin-left:85%;' class="completebutton_replace" ></div> 
            <?php 
            $complete_ls_id=$this->db->select("*")->from("watch_time_tbl")->where("course_id",$get_lessoninfo->course_id)->where("lesson_id",$get_lessoninfo->lesson_id)->get()->row();
            if(@$complete_ls_id->is_complete){?>
            <button class="btn btn-primary" type="button" id="button-addon2"  style="position: relative;width:100px;margin-left:85%">Completed</button>  
            <?php }else{?>
             <button class="btn btn-primary completebutton" type="button" id="button-addon2" onclick="Completelesson('<?php echo $get_lessoninfo->lesson_id;?>')" style="position: relative;width:100px;margin-left:85%">Complete</button>
            <?php }?>
          <?php }?>

        <div class="quiz-overlay bg-white d-flex align-items-center justify-content-center flex-column text-center p-3">
            <div class="fs-3">Quiz title : Wordpress test quiz</div>
            <div class="fs-6 text-muted">Number of questions : 1</div>
            <a href="javascript:void(0)" onclick="showquizform('<?php echo $get_lessoninfo->course_id; ?>')"
                class="btn btn-dark-cerulean btn-lg mt-3">Get Started</a>
        </div>
    </div>
</div>
<div class="course-preview__separation--text fs-5 fw-medium my-3">
    <?php echo (!empty($get_lessoninfo->lesson_name) ? $get_lessoninfo->lesson_name : ''); ?>
</div>

<input type="hidden" id="summation_time" value="0">
<input type="hidden" id="today" value="<?php echo date('Y-m-d'); ?>">
<input type="hidden" id="timevalue">
<input type="hidden" id="timevalues" value="0">
<input type="hidden" id="endtimevalues" value="0">
<input type="hidden" id="le_course_enterprise" value="<?php echo $get_lessoninfo->enterprise_id;?>">
<input type="hidden" id="le_course_id" value="<?php echo $get_lessoninfo->course_id;?>">
<input type="hidden" id="lesson_id" value="<?php echo $get_lessoninfo->lesson_id;?>">
<!--End Start Course Preview Video-->
<script src="https://cdn.rawgit.com/jrue/Vimeo-jQuery-API/master/dist/jquery.vimeo.api.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.session@1.0.0/jquery.session.min.js"></script>


<script>
// var xhr;
$("#player1").on("playProgress", function(event, data){

var dt = new Date();
var starttime = $("#timevalue").val();

var stoptime = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
var today = $("#today").val();

$("#timevalue").attr("value", stoptime);


$("#endtimevalues").attr("value", data.seconds);

    var enterprise_id= $("#le_course_enterprise").val();
    var course_id=$("#le_course_id").val();
    var lesson_id=$("#lesson_id").val();
    var student_id=$("#student_id").val();
    var eachvideoDuration=$("#eachvideoDuration").val();
    var video_progress=data.percent
    var endtime= data.seconds;

        var hms = eachvideoDuration;   // your input string
        var a = hms.split(':'); // split it at the colons
        // minutes are worth 60 seconds. Hours are worth 60 minutes.
        var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]); 
        var vp= (endtime*100/seconds);
        //   if(finish == 2){
        //     xhr.abort();
        // }

        if(seconds<=60){
            var complete_sec = parseInt(seconds) - 10 ;
        }else if(parseInt(seconds) > 60 && parseInt(seconds) <= 300 ){
            var complete_sec = parseInt(seconds) - 30 ;

        }else if(parseInt(seconds) > 300 && parseInt(seconds) <= 600 ){
            var complete_sec = parseInt(seconds) - 50 ;

        }else if(parseInt(seconds) > 600 ){
            var complete_sec = parseInt(seconds) - 90 ;

        }

        if(complete_sec <= endtime){
            var finish='2';
            $("#empty_complete_"+lesson_id).hide();
            $("#old_complete_icon_"+lesson_id).hide();
            $("#completelessonshow_"+lesson_id).html('<i class="fas fa-check mt-1 me-1 lesson-watch-design activeremoveclass lstactive_'+lesson_id+' active"></i>');
            console.log('finished');
        }

var summation_time = $("#summation_time").val();

var t1 = new Date(today +" "+stoptime);
var t2 = new Date(today +" "+starttime);
var dif = ( t1.getTime() - t2.getTime() ) / 1000;
var total_caltime = parseFloat(summation_time) + parseFloat(dif);
$("#summation_time").val(total_caltime);
  sessionStorage.setItem("SessionName", total_caltime);
  // sessionStorage.setItem("SessionName", total_caltime);
  var starttimevalues= $("#timevalues").val();
  sessionStorage.setItem("endtime", endtime);
  sessionStorage.setItem("timevalues", starttimevalues);

   // $.ajax({
   //      url: base_url + enterprise_shortname + "/set-timewatchs",
   //      type: "POST",
   //      data: {
   //          csrf_test_name: CSRF_TOKEN,
   //          starttime: starttime,
   //          stoptime: stoptime,
   //          enterprise_id:enterprise_id,
   //          course_id:course_id,
   //          lesson_id:lesson_id,
   //          student_id:student_id,
   //          eachvideoDuration:eachvideoDuration,
   //          starttimevalues:starttimevalues,
   //          endtime:endtime,
   //          video_progress:video_progress,
   //          finish:finish,
   //          vp:vp
   //      },
   //      success: function(r) {
       
   //          if(r==1){
   //           $("#completelessonshow_"+lesson_id).html('<i class="fas fa-check mt-1 me-1 lesson-watch-design activeremoveclass lstactive_'+lesson_id+' active"></i>');
   //           $("#empty_complete_"+lesson_id).hide();
   //           $("#old_complete_icon_"+lesson_id).hide();
   //          }

   //      },
   //  });
});








$(document).ready(function() {

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
        player.addEvent('playProgress', onPlayProgress);
        
        var cookie_vid=$("#cookie_vid").val();
        player.api('seekTo',(Cookies.get('timeElapsed_'+cookie_vid)));
        // player.addEvent('seek', seek);
        // player.addEvent('seeking', seek);
        player.addEvent('seeking', seek);
    });
    // Call the API when a button is pressed
    $('button').bind('click', function() {
        player.api($(this).text().toLowerCase());
    });



});


function seek(data){
// console.log(data);
var dt = new Date();
var starttime = $("#timevalue").val();

var stoptime = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
$("#timevalue").attr("value", stoptime);
// alert(starttime);
// alert(stoptime);

var enterprise_id= $("#le_course_enterprise").val();
var course_id=$("#le_course_id").val();
var lesson_id=$("#lesson_id").val();
var student_id=$("#student_id").val();
var eachvideoDuration=$("#eachvideoDuration").val();

// var starttimevalues= $("#timevalues").val();

// $("#timevalues").attr("value", starttimevalues);
var endtime= data.seconds;

if(starttime==''){
    return false;
}

var hms = eachvideoDuration;   // your input string
var a = hms.split(':'); // split it at the colons
// minutes are worth 60 seconds. Hours are worth 60 minutes.
var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]); 
// var endi=Math.round(endtime);
// if(endi==seconds){
//  var finish='2';
// }
// $(".lstactive_"+lesson_id).html('<i class="fas fa-check mt-1 me-1 lesson-watch-design activeremoveclass lstactive_LE264ERY7 active hello"></i>');

var video_progress=data.percent
var vp= (endtime*100/seconds);

// console.log(endtime);

if(seconds<=60){
         var complete_sec = parseInt(seconds) - 10 ;
    }else if(parseInt(seconds) > 60 && parseInt(seconds) <= 300 ){
         var complete_sec = parseInt(seconds) - 30 ;

    }else if(parseInt(seconds) > 300 && parseInt(seconds) <= 600 ){
         var complete_sec = parseInt(seconds) - 50 ;

    }else if(parseInt(seconds) > 600 ){
         var complete_sec = parseInt(seconds) - 90 ;

    }

    if(complete_sec <= endtime){
        var finish='2';
         $("#completelessonshow_"+lesson_id).html('<i class="fas fa-check mt-1 me-1 lesson-watch-design activeremoveclass lstactive_'+lesson_id+' active"></i>');
        console.log('finished');
    }

$.ajax({
    url: base_url + enterprise_shortname + "/set-timewatchs",
    type: "POST",
    data: {
        csrf_test_name: CSRF_TOKEN,
        // starttime: starttime,
        // stoptime: stoptime,
        enterprise_id:enterprise_id,
        course_id:course_id,
        lesson_id:lesson_id,
        student_id:student_id,
        eachvideoDuration:eachvideoDuration,
        // starttimevalues:starttimevalues,
        // endtime:endtime
         video_progress:video_progress,
         finish:finish,
         vp:vp,
    },
    success: function(r) {
        console.log('seek');
        console.log(r);
        // alert(r);
        if(r==1){
            // $("#completelessonshow_"+lesson_id).html('<i class="fas fa-check mt-1 me-1 lesson-watch-design activeremoveclass lstactive_'+lesson_id+' active"></i>');
            $("#empty_complete_"+lesson_id).hide();
            $("#old_complete_icon_"+lesson_id).hide();
        }
        // $("#timevalue").attr("value", '');
        // $("#timevalues").attr("value", '');
    },
});
}

function onPlay(data) {
$("#timevalue").attr("value", '');
var cookie_vid=$("#cookie_vid").val();
var dt = new Date();
var starttime = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
$("#timevalue").attr("value", starttime);
Cookies.set('timeElapsed_'+cookie_vid, data.seconds);
// Cookies.get('timeElapsed',data.seconds);
$("#timevalues").attr("value", data.seconds);


}

function onPlayProgress(data, id) {
// Cookies.get('timeElapsed',data.seconds);
var cookie_vid=$("#cookie_vid").val();
Cookies.set('timeElapsed_'+cookie_vid,data.seconds);
//  status.text(Cookies.get('timeElapsed') + ' seconds played');
var starttimevalues= $("#timevalues").val();
$("#timevalues").attr("value",starttimevalues);

var starttime = $("#timevalue").val();
$("#timevalue").attr("value", starttime);


}


function onPause(data) {
// var dt = new Date();
// var starttime = $("#timevalue").val();

// var stoptime = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
// $("#timevalue").attr("value", stoptime);



var summation_time= $("#summation_time").val();



var enterprise_id= $("#le_course_enterprise").val();
var course_id=$("#le_course_id").val();
var lesson_id=$("#lesson_id").val();
var student_id=$("#student_id").val();
var eachvideoDuration=$("#eachvideoDuration").val();

var starttimevalues= $("#timevalues").val();
$("#timevalues").attr("value", starttimevalues);
var endtime= data.seconds;

// if(starttime==''){
//     return false;
// }

var hms = eachvideoDuration;   // your input string
var a = hms.split(':'); // split it at the colons
// minutes are worth 60 seconds. Hours are worth 60 minutes.
var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]); 
var vp= (endtime*100/seconds);

//var complete_sec = parseInt(seconds) - 100 ;
   if(seconds<=60){
         var complete_sec = parseInt(seconds) - 10 ;
    }else if(parseInt(seconds) > 60 && parseInt(seconds) <= 300 ){
         var complete_sec = parseInt(seconds) - 30 ;

    }else if(parseInt(seconds) > 300 && parseInt(seconds) <= 600 ){
         var complete_sec = parseInt(seconds) - 50 ;

    }else if(parseInt(seconds) > 600 ){
         var complete_sec = parseInt(seconds) - 90 ;

    }

 if(complete_sec <= endtime){
    var finish='2';
   
     $("#completelessonshow_"+lesson_id).html('<i class="fas fa-check mt-1 me-1 lesson-watch-design activeremoveclass lstactive_'+lesson_id+' active"></i>');
}
var video_progress =data.percent;
$.ajax({
    url: base_url + enterprise_shortname + "/set-timewatchs",
    type: "POST",
    data: {
        csrf_test_name: CSRF_TOKEN,
        // starttime: starttime,
        // stoptime: stoptime,
        enterprise_id:enterprise_id,
        course_id:course_id,
        lesson_id:lesson_id,
        student_id:student_id,
        eachvideoDuration:eachvideoDuration,
        starttimevalues:starttimevalues,
        endtime:endtime,
        video_progress:video_progress,
        finish:finish,
        vp:vp,
        summation_time:summation_time,
    },
    success: function(r) {
        sessionStorage.removeItem('SessionName');
        sessionStorage.removeItem('endtime');
        sessionStorage.removeItem('timevalues');
        $("#timevalue").attr("value", '');
         $("#summation_time").val(0);
         $("#endtimevalues").attr("value", '');
        // $("#timevalues").attr("value", '');
        if(r==1){
            // $("#completelessonshow_"+lesson_id).html('<i class="fas fa-check mt-1 me-1 lesson-watch-design activeremoveclass lstactive_'+lesson_id+' active"></i>');
            $("#empty_complete_"+lesson_id).hide();
            $("#old_complete_icon_"+lesson_id).hide();
        }
    },
});
}

var f =1;

// function onFinish(data, id) {
//     var cookie_vid=$("#cookie_vid").val();
//     Cookies.remove('timeElapsed_'+cookie_vid);
//     var dt = new Date();
//     var starttime = $("#timevalue").val();
//        if(starttime==''){
//          return false;
//         }
//     if (f == 1) {

//     $("#timevalue").attr("value", starttime);
//         var stoptime = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
//         var eachvideoDuration=$("#eachvideoDuration").val();
//         var starttimevalues= $("#timevalues").val();
//         $("#timevalues").attr("value", starttimevalues);
//        var endtime= data.seconds;
//        var cp =data.percent

//         var enterprise_id= $("#le_course_enterprise").val();
//         var course_id=$("#le_course_id").val();
//         var lesson_id=$("#lesson_id").val();
//         var student_id=$("#student_id").val();

//        // console.log('finish');
//         var finish="2";
//         $.ajax({
//             url: base_url + enterprise_shortname + "/set-timewatchs",
//             type: "POST",
//             data: {
//                 csrf_test_name: CSRF_TOKEN,
//                 starttime: starttime,
//                 stoptime: stoptime,
//                 enterprise_id:enterprise_id,
//                 course_id:course_id,
//                 lesson_id:lesson_id,
//                 student_id:student_id,
//                 finish:finish,
//                 eachvideoDuration:eachvideoDuration,
//                 starttimevalues:starttimevalues,
//                 endtime:endtime,
//                 cp:cp,
//             },
//             success: function(r) {
//                 // console.log(r);
//                 $("#timevalue").attr("value", '');
//                 $("#timevalues").attr("value", '');
//                 if(r==1){
//                     $("#completelessonshow_"+lesson_id).html('<i class="fas fa-check mt-1 me-1 lesson-watch-design activeremoveclass lstactive_'+lesson_id+' active"></i>');
//                     $("#empty_complete_"+lesson_id).hide();
//                     $("#old_complete_icon_"+lesson_id).hide();
//                 }
//             },
//         });
//     }
//  }




function onFinish(data, id) {
var cookie_vid=$("#cookie_vid").val();
Cookies.remove('timeElapsed_'+cookie_vid);
// var dt = new Date();
// var starttime = $("#timevalue").val();
//    if(starttime==''){
//      return false;
//     }
 if (f == 1) {

// $("#timevalue").attr("value", starttime);
//     var stoptime = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
    var eachvideoDuration=$("#eachvideoDuration").val();
//     var starttimevalues= $("#timevalues").val();
//     $("#timevalues").attr("value", starttimevalues);



    var endtime= data.seconds;
//    var cp =data.percent
    var enterprise_id= $("#le_course_enterprise").val();
    var course_id=$("#le_course_id").val();
    var lesson_id=$("#lesson_id").val();
    var student_id=$("#student_id").val();

    var hms = eachvideoDuration;   // your input string
    var a = hms.split(':'); // split it at the colons
    // minutes are worth 60 seconds. Hours are worth 60 minutes.
    var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]); 
  if(seconds<=60){
         var complete_sec = parseInt(seconds) - 10 ;
    }else if(parseInt(seconds) > 60 && parseInt(seconds) <= 300 ){
         var complete_sec = parseInt(seconds) - 30 ;

    }else if(parseInt(seconds) > 300 && parseInt(seconds) <= 600 ){
         var complete_sec = parseInt(seconds) - 50 ;

    }else if(parseInt(seconds) > 600 ){
         var complete_sec = parseInt(seconds) - 90 ;

    }

    if(complete_sec <= endtime){
        var finish='2';
         $("#completelessonshow_"+lesson_id).html('<i class="fas fa-check mt-1 me-1 lesson-watch-design activeremoveclass lstactive_'+lesson_id+' active"></i>');
        console.log('finished');
    }

   // console.log('finish');

    $.ajax({
        url: base_url + enterprise_shortname + "/set-timewatchs",
        type: "POST",
        data: {
            csrf_test_name: CSRF_TOKEN,
            // starttime: starttime,
            // stoptime: stoptime,
            enterprise_id:enterprise_id,
            course_id:course_id,
            lesson_id:lesson_id,
            student_id:student_id,
            finish:finish,
            // eachvideoDuration:eachvideoDuration,
            // starttimevalues:starttimevalues,
            // endtime:endtime,
            // cp:cp,
        },
        success: function(r) {
       sessionStorage.removeItem('SessionName');
        sessionStorage.removeItem('endtime');
        sessionStorage.removeItem('timevalues');
            $("#timevalue").attr("value", '');
            $("#timevalues").attr("value", '');
            if(r==1){
                // $("#completelessonshow_"+lesson_id).html('<i class="fas fa-check mt-1 me-1 lesson-watch-design activeremoveclass lstactive_'+lesson_id+' active"></i>');
                $("#empty_complete_"+lesson_id).hide();
                $("#old_complete_icon_"+lesson_id).hide();
            }
        },
    });
}
}








f++;


});

// window.onbeforeunload = function(event){
 // var entime= $("#endtimevalues").val();
 //    if( entime !=0){
 //        function_name(entime);
 //    }
   // summation_time= $("#summation_time").val();
  // sessionStorage.setItem("SessionName", summation_time);
// }


// alert(sessionStorage.getItem("SessionName"));
$(document).ready(function(){
var summation_time= sessionStorage.getItem("SessionName");//$("#summation_time").val();
var enterprise_id= $("#le_course_enterprise").val();
var course_id=$("#le_course_id").val();
var lesson_id=$("#lesson_id").val();
var student_id=$("#student_id").val();
var eachvideoDuration=$("#eachvideoDuration").val();


var starttimevalues=sessionStorage.getItem("timevalues");// $("#timevalues").val();
// $("#timevalues").attr("value", starttimevalues);

var endtime= sessionStorage.getItem("endtime");//$("#endtimevalues").val();
var hms = eachvideoDuration;   // your input string
var a = hms.split(':'); // split it at the colons
// minutes are worth 60 seconds. Hours are worth 60 minutes.
var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]); 

   if(seconds<=60){
         var complete_sec = parseInt(seconds) - 10 ;
    }else if(parseInt(seconds) > 60 && parseInt(seconds) <= 300 ){
         var complete_sec = parseInt(seconds) - 30 ;

    }else if(parseInt(seconds) > 300 && parseInt(seconds) <= 600 ){
         var complete_sec = parseInt(seconds) - 50 ;

    }else if(parseInt(seconds) > 600 ){
         var complete_sec = parseInt(seconds) - 90 ;

    }


 if(complete_sec <= endtime){
    var finish='2';
   
     $("#completelessonshow_"+lesson_id).html('<i class="fas fa-check mt-1 me-1 lesson-watch-design activeremoveclass lstactive_'+lesson_id+' active"></i>');
}
$.ajax({
    url: base_url + enterprise_shortname + "/set-timewatchs",
    type: "POST",
    data: {
        csrf_test_name: CSRF_TOKEN,
        enterprise_id:enterprise_id,
        course_id:course_id,
        lesson_id:lesson_id,
        student_id:student_id,
        eachvideoDuration:eachvideoDuration,
        starttimevalues:starttimevalues,
        endtime:endtime,            
        finish:finish,
        summation_time:summation_time,
    },
    success: function(r) {
       $("#timevalue").attr("value", '');
       $("#endtimevalues").attr("value", '');
       localStorage.clear();

        sessionStorage.removeItem('SessionName');
        sessionStorage.removeItem('endtime');
        sessionStorage.removeItem('timevalues');
       // sessionStorage.removeItem('SessionName');
    },
});
});
// function function_name(endtimevalues) {

// var summation_time= $("#summation_time").val();
// var enterprise_id= $("#le_course_enterprise").val();
// var course_id=$("#le_course_id").val();
// var lesson_id=$("#lesson_id").val();
// var student_id=$("#student_id").val();
// var eachvideoDuration=$("#eachvideoDuration").val();

// var starttimevalues= $("#timevalues").val();
// $("#timevalues").attr("value", starttimevalues);
// var endtime= endtimevalues;

// var hms = eachvideoDuration;   // your input string
// var a = hms.split(':'); // split it at the colons
// // minutes are worth 60 seconds. Hours are worth 60 minutes.
// var seconds = (+a[0]) * 60 * 60 + (+a[1]) * 60 + (+a[2]); 

//    if(seconds<=60){
//          var complete_sec = parseInt(seconds) - 10 ;
//     }else if(parseInt(seconds) > 60 && parseInt(seconds) <= 300 ){
//          var complete_sec = parseInt(seconds) - 30 ;

//     }else if(parseInt(seconds) > 300 && parseInt(seconds) <= 600 ){
//          var complete_sec = parseInt(seconds) - 50 ;

//     }else if(parseInt(seconds) > 600 ){
//          var complete_sec = parseInt(seconds) - 90 ;

//     }

//  if(complete_sec <= endtime){
//     var finish='2';
   
//      $("#completelessonshow_"+lesson_id).html('<i class="fas fa-check mt-1 me-1 lesson-watch-design activeremoveclass lstactive_'+lesson_id+' active"></i>');
// }
// $.ajax({
//     url: base_url + enterprise_shortname + "/set-timewatchs",
//     type: "POST",
//     data: {
//         csrf_test_name: CSRF_TOKEN,
//         enterprise_id:enterprise_id,
//         course_id:course_id,
//         lesson_id:lesson_id,
//         student_id:student_id,
//         eachvideoDuration:eachvideoDuration,
//         starttimevalues:starttimevalues,
//         endtime:endtime,            
//         finish:finish,
//         summation_time:summation_time,
//     },
//     success: function(r) {
//        $("#timevalue").attr("value", '');
//        $("#endtimevalues").attr("value", '');
//     },
// });
// }




function Completelesson(lesson_id){
var enterprise_id= $("#le_course_enterprise").val();
var course_id=$("#le_course_id").val();
var student_id=$("#student_id").val();
$.ajax({
    url: base_url + enterprise_shortname + "/lesson-textfilecompleted",
    type: "POST",
    data: {
        csrf_test_name: CSRF_TOKEN,
        enterprise_id:enterprise_id,
        course_id:course_id,
        lesson_id:lesson_id,
        student_id:student_id,
    },
    success: function(r) {
        // toastrSuccessMsg(r);
        toastr.success('Successfully Lesson Complete');
        $('.completebutton').hide();
        $(".completebutton_replace").html("<button class='btn btn-primary' type='button' id='button-addon2'>Completed</button>");

        // lesson part
        $("#completelessonshow_"+lesson_id).html('<i class="fas fa-check mt-1 me-1 lesson-watch-design activeremoveclass lstactive_'+lesson_id+' active"></i>');
        $("#empty_complete_"+lesson_id).hide();
        $("#old_complete_icon_"+lesson_id).hide();
    },
});

}
</script>