<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Videoapi_model extends CI_Model {

    // get video id from youtube embed url
    function youtube_videoid($embed_url = '') {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $embed_url, $match);
        $video_id = $match[1];
        return $video_id;
    }

    // get video id from vimeo embed url
    function get_vimeo_video_id($embed_url = '') {
        if (preg_match("/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/", $embed_url, $output_array)) {
            $video_id = $output_array[5];
            return $video_id;
        }
    }

//    ============== its for video detials ==============
    public function video_details($data) {
        $youtube_api_key = $data['setting']->youtube_api_key;
        $vimeo_api_key = $data['setting']->vimeo_api_key;
        $url = $data['video_url'];
        $lesson_provider = $data['lesson_provider'];

        $host = explode('.', str_replace('www.', '', strtolower(parse_url($url, PHP_URL_HOST))));
        $host = isset($host[0]) ? $host[0] : $host;
        
        if ($host == 'vimeo') {
            $video_id = substr(parse_url($url, PHP_URL_PATH), 1);
            $options = array('http' => array(
                    'method' => 'GET',
                    'header' => 'Authorization: Bearer ' . $vimeo_api_key
            ));
            $context = stream_context_create($options);

            $hash = json_decode(file_get_contents("https://api.vimeo.com/videos/{$video_id}", false, $context));
            
            return array(
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
        } elseif ('youtube' || 'youtu') {
            $video_id = $this->youtube_videoid($url);
            $hash = json_decode(file_get_contents("https://www.googleapis.com/youtube/v3/videos?part=snippet,contentDetails&id=" . $video_id . "&key=" . $youtube_api_key . ""));
           
            $duration = new DateInterval($hash->items[0]->contentDetails->duration);
            return array(
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
        }
    }

}
