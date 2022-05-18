<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('remove_space')) {

    function remove_space($var = '') {
        $string = str_replace(' ', '-', $var);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }

}
if (!function_exists('default_image')) {

    function default_image() {
        $default = ('assets/img/icons/default.png');
        return $default;
    }

}
if (!function_exists('default_university')) {

    function default_university() {
        $default = ('assets/img/default-university.png');
        return $default;
    }

}
if (!function_exists('default_slider')) {

    function default_slider() {
        $default = ('assets/default-slider.png');
        return $default;
    }

}
if (!function_exists('default_600_400')) {

    function default_600_400() {
        $default = ('assets/img/default-600-400.png');
        return $default;
    }

}

if (!function_exists('dd')) {

    function dd($data = '') {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        exit();
    }

}
if (!function_exists('d')) {

    function d($data = '') {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    if (!function_exists('get_appsettings')) {

        function get_appsettings() {
            $ci = & get_instance();
            $ci->db->select('*');
            $ci->db->from('setting');
            $ci->db->where('enterprise_id', get_enterpriseid());
            $query = $ci->db->get();
            return $query->row();
        }

    }
    if (!function_exists('getappsettings')) {

        function getappsettings($enterprise_id) {
            $ci = & get_instance();
            $ci->db->select('*');
            $ci->db->from('setting');
            $ci->db->where('enterprise_id', $enterprise_id);
            $query = $ci->db->get();
            return $query->row();
        }

    }
    if (!function_exists('get_activethemes')) {

        function get_activethemes() {
            $ci = & get_instance();
            $ci->db->select('*');
            $ci->db->from('themes_tbl');
            $ci->db->where('status', 1);
            $query = $ci->db->get();
            return $query->row();
        }

    }
    if (!function_exists('get_currencyiconposition')) {

        function get_currencyiconposition($currency, $position, $amount) {
            $format = (($position == 1) ? "$currency $amount" : "$amount $currency");
            return $format;
        }

    }

    function is_secure($url) {
        if ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) {
            $val = 'https://' . $url;
        } else {
            $val = 'http://' . $url;
        }
        return $val;
    }

    if (!function_exists('get_usertype')) {

        function get_usertype() {
            $ci = & get_instance();
            $user_type = $ci->session->userdata('user_type');
            return $user_type;
        }

    }
    if (!function_exists('get_userid')) {

        function get_userid() {
            $ci = & get_instance();
            $user_id = $ci->session->userdata('user_id');
            return $user_id;
        }

    }

    if (!function_exists('get_createdby')) {

        function get_createdby() {
            $ci = & get_instance();
            $createdby = $ci->session->userdata('created_by');
            return $createdby;
        }

    }

    // if (!function_exists('get_username')) {
    //     function get_username() {
    //         $ci = & get_instance();
    //         $ci->db->select('a.*, ');
    //         $ci->db->from('loginfo_tbl a');
    //         $ci->db->join('picture_tbl b', 'b.from_id = a.log_id', 'left');
    //         $ci->db->where('log_id', $id);
    //         $query = $ci->db->get();
    //         return $query->row();
    //     }
    // }

    if (!function_exists('get_enterpriseid')) {

        function get_enterpriseid() {
            $ci = & get_instance();
            $enterprise_id = '';
            if (get_usertype() == 1 || get_usertype() == 2) {
                $enterprise_id = get_userid();
            } elseif (get_usertype() == 3 || get_usertype() == 5) {
                $enterprise_id = get_createdby();
            }
            return $enterprise_id;
        }

    }

    if (!function_exists('get_enterpriseinfo')) {

        function get_enterpriseinfo($log_id = null) {
            $ci = & get_instance();
            $ci->db->select('a.*');
            $ci->db->from('loginfo_tbl a');
            $ci->db->where('a.log_id', $log_id);
            $query = $ci->db->get();
            $test= $query->row();
           
            return $test;
        }

    }
    if (!function_exists('get_studentlist')) {

        function get_studentlist() {
            $ci = & get_instance();
            $ci->db->select('a.*');
            $ci->db->from('loginfo_tbl a');
            $ci->db->where('a.user_types', 4);
            $ci->db->where('a.enterprise_id', get_enterpriseid());
            $query = $ci->db->get();
            return $query->result();
        }
    }
    if (!function_exists('get_studentinfo')) {

        function get_studentinfo($student_id) {
            $ci = & get_instance();
            $ci->db->select('a.*');
            $ci->db->from('students_tbl a');
            $ci->db->where('a.student_id', $student_id);
            $query = $ci->db->get();
            return $query->row();
        }
    }
    if (!function_exists('get_instructorinfo')) {

        function get_instructorinfo($faculty_id) {
            $ci = & get_instance();
            $ci->db->select('a.*');
            $ci->db->from('faculty_tbl a');
            $ci->db->where('a.faculty_id', $faculty_id);
            $query = $ci->db->get();
            return $query->row();
        }
    }

    if (!function_exists('get_certificatelist')) {

        function get_certificatelist($type = null) {
            $ci = & get_instance();
            $ci->db->select('a.*');
            $ci->db->from('template_tbl a');
            $ci->db->where('a.template_type', $type);
            $ci->db->where('a.enterprise_id', get_enterpriseid());
            $query = $ci->db->get();
            return $query->result();
        }

    }
    if (!function_exists('enterpriseinfo')) {

        function enterpriseinfo() {
            $ci = & get_instance();
            $ci->db->select('a.*, b.date_of_birth, b.student_capacity, b.faculty_capacity');
            $ci->db->from('loginfo_tbl a');
            $ci->db->join('enterprise_tbl b', 'b.enterprise_id = a.log_id', 'left');
            $ci->db->where('a.log_id', get_enterpriseid());
            $query = $ci->db->get();
            return $query->row();
        }

    }
    if (!function_exists('get_enterpriselist')) {

        function get_enterpriselist() {
            $ci = & get_instance();
            $ci->db->select('a.*');
            $ci->db->from('loginfo_tbl a');
            $ci->db->where('a.user_types', 2);
            $query = $ci->db->get();
            return $query->result();
        }

    }

    if (!function_exists('enterpriseid_byshortname')) {

        function enterpriseid_byshortname($shortname) {
            $ci = & get_instance();
            $ci->db->select('*');
            $ci->db->from('loginfo_tbl a');
            $ci->db->where('a.shortname', $shortname);
            if ($shortname == 'admin') {
                $ci->db->where('a.user_types', 1);
            } else {
                $ci->db->where('a.user_types', 2);
            }
            $query = $ci->db->get();
            return @$query->row()->log_id;
        }

    }

    if (!function_exists('get_userinfo')) {

        function get_userinfo($id = null) {
            $ci = & get_instance();
            $ci->db->select('a.*, b.picture');
            $ci->db->from('loginfo_tbl a');
            $ci->db->join('picture_tbl b', 'b.from_id = a.log_id', 'left');
            $ci->db->where('log_id', $id);
            $query = $ci->db->get();
            return $query->row();
        }

    }
    if (!function_exists('get_picturebyid')) {

        function get_picturebyid($id = null) {
            $ci = & get_instance();
            $ci->db->select('a.picture, a.picture_type');
            $ci->db->from('picture_tbl a');
            $ci->db->where('from_id', $id);
            $query = $ci->db->get();
            return $query->row();
        }

    }

    if (!function_exists('get_courseinfo')) {

        function get_courseinfo($courseid = null) {
            $ci = & get_instance();
            $ci->db->select('a.*');
            $ci->db->from('course_tbl a');
            $ci->db->where('course_id', $courseid);
            $query = $ci->db->get();
            return $query->row();
        }

    }

    // get table name by type and id
    function get_type_name_by_id($table, $type_id = '', $field = 'name') {
        $CI = &get_instance();
        $get = $CI->db->select($field)->from($table)->where('log_id', $type_id)->limit(1)->get()->row_array();
        return $get[$field];
    }

    if (!function_exists('get_rolepermission')) {

        function get_rolepermission() {
            $ci = & get_instance();
            $ci->db->select('*');
            $ci->db->from('sec_role_tbl');
            $ci->db->where('enterprise_id', get_enterpriseid());
            $ci->db->order_by('role_id', 'desc');
            $query = $ci->db->get();
            return $query->result();
        }

    }
    if (!function_exists('get_assignedrole')) {

        function get_assignedrole($user_id) {
            $ci = & get_instance();
            $ci->db->select('*');
            $ci->db->from('sec_user_access_tbl');
            $ci->db->where('fk_user_id', $user_id);
            $query = $ci->db->get();
            return $query->result();
        }

    }
    if (!function_exists('activitiylog_save')) {

        function activitiylog_save($title = null, $action = null, $createdby = null, $created_at = null) {
            $ci = & get_instance();
            // dd(get_enterpriseid());
            $logdata = array(
                'title' => $title . ' ' . get_userinfo(get_userid())->name,
                'action' => $action,
                'enterprise_id' => get_enterpriseid(),
                'activities' => 'success',
                'created_by' => $createdby,
                'created_date' => $created_at,
            );
            // dd($logdata);
            $ci->db->insert('activitylog_tbl', $logdata);
            return true;
        }

    }

    if (!function_exists('get_examwisequestion')) {

        function get_examwisequestion($exam_id = null, $enterprise_id = null) {
            
            $ci = & get_instance();
            $ci->db->select('*');
            $ci->db->from('question_tbl');
            $ci->db->where('exam_id', $exam_id);
            $ci->db->where('enterprise_id', $enterprise_id);
            $query = $ci->db->get();
            return $query->result();
        }

    }
    if (!function_exists('get_questionwiseoption')) {

        function get_questionwiseoption($question_id = null) {
            $ci = & get_instance();
            $ci->db->select('*');
            $ci->db->from('question_option_tbl');
            $ci->db->where('question_id', $question_id);
            $query = $ci->db->get();
            return $query->result();
        }

    }
    if (!function_exists('get_answername')) {

        function get_answername($question_id) {
            $ci = & get_instance();
            $ci->db->select('option_id, option_name');
            $ci->db->from('question_option_tbl');
            $ci->db->where('question_id', $question_id);
            $ci->db->where('is_answer', 1);
            $query = $ci->db->get();
            return $query->result();
        }

    }

    if (!function_exists('get_sections')) {

        function get_sections($course_id = null, $enterprise_id = null) {
            $ci = & get_instance();
            $ci->db->select('section_id, section_name');
            $ci->db->from('section_tbl');
            $ci->db->where('enterprise_id', $enterprise_id);
            $ci->db->where('course_id', $course_id);
            $query = $ci->db->get();
            return $query->result();
        }

    }

    if (!function_exists('get_lessons')) {

        function get_lessons($course_id = null, $enterprise_id = null) {
            $ci = & get_instance();
            $ci->db->select('lesson_id, lesson_name');
            $ci->db->from('lesson_tbl');
            $ci->db->where('enterprise_id', $enterprise_id);
            $ci->db->where('course_id', $course_id);
            $query = $ci->db->get();
            return $query->result();
        }

    }

    if (!function_exists('get_lessoninfo')) {

        function get_lessoninfo($lesson_id = null) {
            $ci = & get_instance();
            $ci->db->select('*');
            $ci->db->from('lesson_tbl');
            $ci->db->where('lesson_id', $lesson_id);
            $query = $ci->db->get();
            return $query->row();
        }

    }


    if (!function_exists('get_exams')) {

        function get_exams() {
            $ci = & get_instance();
            $ci->db->select('exam_id, name');
            $ci->db->from('exam_tbl');
            $ci->db->where('enterprise_id', get_enterpriseid());
            $query = $ci->db->get();
            return $query->result();
        }

    }
    if (!function_exists('facultycount_byenterprise')) {

        function facultycount_byenterprise() {
            $ci = & get_instance();
            $ci->db->where('enterprise_id', get_enterpriseid());
            $ci->db->where('user_types', 5);
            $query = $ci->db->get('loginfo_tbl');
            return $query->num_rows();
        }

    }

    if (!function_exists('timediff')) {

        function timediff($stoptime = null, $starttime = null) {
            // $date1 = strtotime("00:58:55");
            // $date2 = strtotime("01:00:00");
            // d($date1);
            // d($date2);
            $date1 = strtotime($starttime);
            $date2 = strtotime($stoptime);
            // Formulate the Difference between two dates 
            $diff = abs($date2 - $date1);
            $years = floor($diff / (365 * 60 * 60 * 24));
            $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
            $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
            $minutes = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
            $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minutes * 60));
            // printf("%d years, %d months, %d days, %d hours, " . "%d minutes, %d seconds", $years, $months, $days, $hours, $minutes, $seconds);
            return $diff;
            // echo '<br>';
            // echo $hours.' '.$minutes.' '. $seconds;
        }

    }

    if (!function_exists('timecounter')) {

        function timecounter($start_time, $end_time) {
//            $time = new DateTime('00:58:55');
//            $timediff = $time->diff(new DateTime("01:00:00"));
            $time = new DateTime($end_time);
           $timediff = $time->diff(new DateTime($start_time));
            // return $timediff->format('%h Hour %i Minute %s Second');
            return $timediff->format('%H:%I:%S');
        }

    }
    if (!function_exists('convertToHoursMins')) {

        function convertToHoursMins($time, $format = '%02d:%02d') {
            if ($time < 1) {
                return;
            }
            $hours = floor($time / 60);
            $minutes = ($time % 60);

            return sprintf($format, $hours, $minutes);
        }

    }

    function get_roman_number($num = null) {
        $n = intval($num);
        $result = '';
        $lookup = array(
            'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
            'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
            'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
        );

        foreach ($lookup as $roman => $value) {
            $matches = intval($n / $value);
            $result .= str_repeat($roman, $matches);
            $n = $n % $value;
        }
        return $result;
    }

    if (!function_exists('get_coursecountbyinstructor')) {

        function get_coursecountbyinstructor($faculty_id = null, $enterprise_id = null) {
            $ci = & get_instance();
            if ($enterprise_id) {
                $ci->db->where('enterprise_id', $enterprise_id);
            }
            $ci->db->where('faculty_id', $faculty_id);
            $query = $ci->db->get('course_tbl');
            return $query->num_rows();
        }

    }
    
    if (!function_exists('get_coursecountbyinstructor')) {

        function get_coursecountbyinstructor($faculty_id = null, $enterprise_id = null) {
            $ci = & get_instance();
            if ($enterprise_id) {
                $ci->db->where('enterprise_id', $enterprise_id);
            }
            $ci->db->where('faculty_id', $faculty_id);
            $query = $ci->db->get('course_tbl');
            return $query->num_rows();
        }

    }



    if (!function_exists('get_youtubevimeovideoapi')) {

        function get_youtubevimeovideoapi($youtubeapi = null, $vimeovideoapi = null, $url = null) {
            $ci = & get_instance();
            $youtube_api_key = $youtubeapi;
            $vimeo_api_key = $vimeovideoapi;
//            d($youtube_api_key);
//            d($vimeo_api_key);
//            dd($url);
            // $url = 'https://vimeo.com/117275538'; //$data['video_url'];
            $url = $url; //'https://www.youtube.com/watch?v=GoSwEBp7e9s'; //$data['video_url'];
            $lesson_provider = 2; //$data['lesson_provider'];

            $host = explode('.', str_replace('www.', '', strtolower(parse_url($url, PHP_URL_HOST))));
            $host = isset($host[0]) ? $host[0] : $host;
           
            if ($host == 'vimeo') {
                $video_id = substr(parse_url($url, PHP_URL_PATH), 1);
             
                $options = array('http' => array(
                        'method' => 'GET',
                        'header' => 'Authorization: Bearer ' . $vimeo_api_key
                )); 
                // d($vimeo_api_key);
                // d($video_id);
                // dd($url);
                $context = stream_context_create($options);

                $hash = json_decode(file_get_contents("https://api.vimeo.com/videos/" . $video_id, false, $context));
                // dd($context);
                $vimeodata = array(
                    'provider' => 'Vimeo',
                    'video_id' => $video_id,
                    'title' => $hash->name,
                    'description' => str_replace(array("<br>", "<br/>", "<br />"), NULL, $hash->description),
                    'description_nl2br' => str_replace(array("\n", "\r", "\r\n", "\n\r"), NULL, $hash->description),
                    'thumbnail' => $hash->pictures->sizes[0]->link,
                    'video' => $hash->link,
                    'embed_video' => "https://player.vimeo.com/video/" . $video_id,
                    'duration' => gmdate("H:i:s", $hash->duration)
                );
                return $vimeodata;
                // d($data['vimeodata']);
            } elseif ('youtube' || 'youtu') {
                 preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
                 $video_id = $match[1];
            
                $hash = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails&id=" . $video_id . "&key=" . $youtube_api_key . ""));
                //    dd($hash);
                $duration = new DateInterval($hash->items[0]->contentDetails->duration);
                $youtubedata = array(
                    'provider' => 'YouTube',
                    'video_id' => $video_id,
                    'title' => $hash->items[0]->snippet->title,
                    'description' => str_replace(array("", "<br/>", "<br />"), NULL, $hash->items[0]->snippet->description),
                    'description_nl2br' => str_replace(array("\n", "\r", "\r\n", "\n\r"), NULL, nl2br($hash->items[0]->snippet->description)),
                    'thumbnail' => 'https://i.ytimg.com/vi/' . $hash->items[0]->id . '/default.jpg',
                    'video' => "http://www.youtube.com/watch?v=" . $hash->items[0]->id,
                    'embed_video' => "http://www.youtube.com/embed/" . $hash->items[0]->id,
                    'duration' => $duration->format('%H:%I:%S'),
                );
                return $youtubedata;
            }
        }

    }


    if (!function_exists('avg_rating')) {
    function  avg_rating($course_id,$enterprise_id){
        $ci = & get_instance();
        $total_ratings=$ci->db->select("*")->from("rating_tbl")->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->get()->result();
        
        $ratings=[];
            foreach($total_ratings as $total_rating){
        // $rating +=$total_rating->rating;
            $ratings[] =$total_rating->rating;
            }
            $total_ratings = count($ratings);
            $sum_ratings   = array_sum($ratings);
            $average_ratings = $sum_ratings>0 ? $sum_ratings/$total_ratings : '';
            if( is_numeric($average_ratings ) ) {
            $average_ratings = round(($average_ratings*2), 0)/2;
        }
        switch($average_ratings) {
            case '1':
                $ratings = '<i class="fas fa-star"></i>';
                break;
            case '1.5':
                $ratings = '<i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>';
                break;
            case '2':
                $ratings = '<i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>';
                break;
            case '2.5':
                $ratings = '<i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>';
                break;
            case '3':
                $ratings = '<i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>';
                break;
            case '3.5':
                $ratings = '<i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>';
                break;
            case '4':
                $ratings = '<i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fas fa-star"></i>';
                break;
            case '4.5':
                $ratings = '<i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>';
                break;
            case '5':
                $ratings = '<i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>';
                break;
            default:
                $ratings = ' ';
        }
        return $ratings;
        }   
        }   
        
        //    average ratings number 3.5 or 2.00
        if (!function_exists('average_ratings_number')) {
        function average_ratings_number($course_id,$enterprise_id){
            $ci = & get_instance();
           $total_ratings=$ci->db->select("*")->from("rating_tbl")->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->get()->result();
            $ratings=[];
                    foreach($total_ratings as $total_rating){
                    $ratings[] =$total_rating->rating;
                    }
                    $total_ratings = count($ratings);
                    $sum_ratings   = array_sum($ratings);
                    $average_ratings = $sum_ratings>0 ? $sum_ratings/$total_ratings : '0';
                    if( is_numeric($average_ratings ) ) {
                    // echo  $average_ratings = round(($average_ratings*2), 0)/2;
                       echo  $average_ratings = number_format($average_ratings,1);
                    }
            }
    }


        if (!function_exists('IndivisualRating')) {
        //    5 start 10 
        function IndivisualRating($course_id,$enterprise_id,$star){
            $ci = & get_instance();
            if($star==5){
               $fivecount=$ci->db->where('rating',5)->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl');
               return $fivecount*5;
            }elseif($star==4){
               $fourcount=$ci->db->where('rating',4)->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl');
               return $fourcount*4;
            }elseif($star==3){
               $threecount = $ci->db->where('rating',3)->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl');
               return $threecount*3;
            }elseif($star==2){
                $towcount= $ci->db->where('rating',2)->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl');
                return $towcount*2;
            }else{
                $onecount= $ci->db->where('rating',1)->where('course_id',$course_id)->where('enterprise_id',$enterprise_id)->count_all_results('rating_tbl');
                return $onecount*1;
            } 
        }
        }

        // ============= its for created date time ago formate =====================
        if (!function_exists('datetimeagoformate')) {
            function datetimeagoformate($created_date){
            date_default_timezone_set("Asia/Dhaka");
            $last_activatiy=strtotime($created_date) ;
                $current_time=strtotime(date('Y-m-d H:i:s'));
                $time_diff=$current_time-$last_activatiy;
                $sec     =  $time_diff;
                $min     = round($time_diff / 60 );
                $hrs     = round($time_diff  / 3600);
                $days    = round($time_diff / 86400 );
                $weeks   = round( $time_diff / 604800);
                $mnths   = round( $time_diff / 2600640 );
                $yrs     = round( $time_diff / 31207680 );
                    
                

                if($sec <= 60) {
                echo "$sec seconds ago";
                }else if($min <= 60) {
                    if($min==1) {
                    echo "one minute ago";
                    }
                    else{
                    echo "$min minutes ago";
                    }
                }else if($hrs <= 24) {
                    if($hrs == 1) {
                    echo "an hour ago";
                    }
                    else {
                    echo "$hrs hours ago";
                    }
                }else if($days <= 7) {
                    if($days == 1) {
                    echo "Yesterday";
                    }
                    else {
                    echo "$days days ago";
                    }
                }else if($weeks <= 4.3) {
                    if($weeks == 1) {
                    echo "a week ago";
                    }else {
                    echo "$weeks weeks ago";
                    }
                }else if($mnths <= 12) {
                    if($mnths == 1) {
                    echo "a month ago";
                    }else {
                    echo "$mnths months ago";
                    }
                }else {
                    if($yrs == 1) {
                    echo "one year ago";
                    }else {
                    echo "$yrs years ago";
                    }
                }
            }
        }






          
        // all completed chapter found here 
        if (!function_exists('completedChapter')) {
         function completedChapter($course_id,$enterprise_id,$user_id){
            $ci = & get_instance();
            // complete chapter 
            $total_chapter_complete_count=$ci->db->select('a.section_id')->from('section_tbl a')
            ->where('enterprise_id',$enterprise_id)
           ->where('course_id',$course_id)
            ->get()
            ->result();
           $i=0;
            foreach($total_chapter_complete_count as $val){
              $section_id=$val->section_id;
              $total_chapter_complete_count[$i]->is_complete=lessonInfo($section_id,$enterprise_id,$user_id);
            $i++;
           }
           $s=0;
           $section=0;
           foreach($total_chapter_complete_count as $complete_section){
                  if($complete_section->is_complete == 'yes'){
                       $section += '1';
                    }
               $s++;
           }
            return  (!empty($section)?$section:0);
    
         }
        }
        if (!function_exists('lessonInfo')) {
         function lessonInfo($section_id,$enterprise_id,$user_id){
            $ci = & get_instance();
            $query =$ci->db->select('*')
                ->from('lesson_tbl a')
                ->where('a.section_id',$section_id)
                ->where('enterprise_id',$enterprise_id)
                ->get()
                ->result();
               
            $complete="";
            $i=0;
            foreach($query as $q){
                $complete_section=conpleteLesson($q->lesson_id,$enterprise_id,$user_id);
                if($complete_section !=1){
                    $complete='no';
                    break;
                }else{
                    $complete ="yes";
                }
                $i++;
            }
            
            return trim($complete);
    
        }
        }
        if (!function_exists('conpleteLesson')) {
         function conpleteLesson($lesson_id,$enterprise_id,$user_id){
            $ci = & get_instance();
            $query =$ci->db->select('*')
            ->from('watch_time_tbl a')
            ->where('a.lesson_id',$lesson_id)
            ->where('a.student_id',$user_id)
            ->get()
            ->row();
            
            return (!empty($query->is_complete)?$query->is_complete:0);
        }
        }
    // end chapter completed
    

    function youtube_id( $url = '') {
        if ( $url === '' )    {
            return FALSE;
        }
        if (!_isValidURL( $url )){
            return FALSE;
        }
        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);

        if(!$matches){
            return FALSE;
        }

        return $matches[0];
    }
    
    if ( ! function_exists('_isValidURL'))    {
      function _isValidURL($url = '')
      {
        return preg_match('/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:.[A-Z0-9][A-Z0-9_-]*)+):?(d+)?/i', $url);
      }
    }

    
/**
 * Get Youtube thumbs
 *
 * @access	public
 * @param	string	Youtube url || Youtube id
 * @param 	number	1 to 4 to return a specific thumb
 * @return	array		url's to thumbs or specific thumb
 */
if ( ! function_exists('youtube_thumbs'))
{
	function youtube_thumbs($url_id = ''){
        $result = 'http://img.youtube.com/vi/'.$url_id.'/mqdefault.jpg';
		// $result = array(
		// 	'0' => 'http://img.youtube.com/vi/'.$url_id.'/sddefault.jpg',
		// 	'1' => 'http://img.youtube.com/vi/'.$url_id.'/mqdefault.jpg',
		// 	'2' => 'http://img.youtube.com/vi/'.$url_id.'/mqdefault.jpg',
		// 	'3' => 'http://img.youtube.com/vi/'.$url_id.'/maxresdefault.jpg'
		// );
        return $result;
	}
}



if (!function_exists('get_zoomconfig')) {

    function get_zoomconfig($enterprise_id = null) {
        $ci = & get_instance();
        $ci->db->select('a.*');
        $ci->db->from('zoomconfig_tbl a');
        $ci->db->where('enterprise_id', $enterprise_id);
        $query = $ci->db->get();
        return $query->row();
    }

}
if (!function_exists('get_projectlikecount')) {
    function get_projectlikecount($project_id = null, $enterprise_id = null) {
        $ci = & get_instance();
        $ci->db->where('likestatus', 1);
        $ci->db->where('project_id', $project_id);
        $ci->db->where('enterprise_id', $enterprise_id);
        $query = $ci->db->count_all_results('likes_tbl');
        return $query;
    }
}
if (!function_exists('get_projectcommentcount')) {
    function get_projectcommentcount($project_id = null, $enterprise_id = null) {
        $ci = & get_instance();
        $ci->db->where('project_id', $project_id);
        $ci->db->where('enterprise_id', $enterprise_id);
        $query = $ci->db->count_all_results('comments_tbl');
        return $query;
    }
}
if (!function_exists('get_projectviewcount')) {
    function get_projectviewcount($project_id = null, $enterprise_id = null) {
        $ci = & get_instance();
        $ci->db->select('viewcount');
        $ci->db->from('project_tbl');
        $ci->db->where('project_id', $project_id);
        $ci->db->where('enterprise_id', $enterprise_id);
        $query = $ci->db->count_all_results();
        return $query;
    }
}


if (!function_exists('get_paywithlogo')) {
    function get_paywithlogo($enterprise_id = null) {
        
        $ci = & get_instance();
        $ci->db->select('*');
        $ci->db->from('paywith_tbl');
        $ci->db->where('enterprise_id', $enterprise_id);
        $query = $ci->db->get();
        return $query->result();
    }

}
if (!function_exists('videoType')) {
    function videoType($url = null) {
        if (strpos($url, 'youtube') > 0) {
            return 'youtube';
        } elseif (strpos($url, 'vimeo') > 0) {
            return 'vimeo';
        } else {
            return 'unknown';
        }
    }
}

if ( ! function_exists('vimeo_id')){
  function vimeo_id( $url = '')  {
    if ( $url === '' )    {
      return FALSE;
    }
    if ($url)    {
      sscanf(parse_url($url, PHP_URL_PATH), '/%d', $vimeo_id);
    }
    else {
      $vimeo_id = $url;
    }
    return ($vimeo_id) ? $vimeo_id : FALSE;
  }
}


if (!function_exists('get_languages')) {
    function get_languages() {
        $ci = & get_instance();
        if ($ci->db->table_exists('language')) {
            $fields = $ci->db->field_data('language');
    
            $i = 1;
            foreach ($fields as $field) {
                if ($i++ > 2)
                    $result[$field->name] = ucfirst($field->name);
            }
    
            if (!empty($result))
                return $result;
        } else {
            return false;
        }
    }

}




}    