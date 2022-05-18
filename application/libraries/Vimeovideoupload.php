<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vimeovideoupload{
    private $vimeoClient;
    private $videoURL="";

	 function video_upload($file_name=null){

	$CLIENT_ID = '0f720dfa8d2c4386a254313712b7fb9da5a8281b';
			$CLIENT_SECRET = 'jp2uzQbxNrlXONacXTz63/vrolXjCBWkIB0zaHokCC8mlCEVsTOwuFtrwpAKUWjX1ROzJzV+pynWZannfbDZ9qkpalbjh5kQURPDfFHEgiBbg69/S/35fkzt4rUvTMpz';
			$ACCESS_TOKEN = '9934bd59f90bb90c5b4b3526cdfa78c9';
		    $ATTACHMENT_TYPE = array(
		      'MP4',
		         'MOV',
		      'MKV'
	);
	$CI =get_instance();	
    $CI->vimeoClient = new \Vimeo\Vimeo($CLIENT_ID,$CLIENT_SECRET,$ACCESS_TOKEN);
 	 if (! empty($file_name)) {
     $valid="";
     $file_extension = pathinfo($_FILES["video_file"]["name"], PATHINFO_EXTENSION);
       if ((in_array(strtoupper($file_extension),$ATTACHMENT_TYPE))) {
          $valid = true;
      }

        if($valid==TRUE){
        $CI->videoURL= $file_name;
        $file_name = $CI->videoURL;
        try {
            $uri = $CI->vimeoClient->upload($file_name, array(
                'name' => 'Video' . time()
            ));

            $video_data = $CI->vimeoClient->request($uri);

            if ($video_data['status'] == 200) {
                $output = array(
                    "type" => "success",
                    "link" => $video_data['body']['link'],
                    "html" => $video_data['body']['embed']['html'],
                    "duration" => $video_data['body']['duration'],
                );
                // $tsss= explode(',',$tss);
                //   $str= str_replace('"',"",$output1['link']);
                //   $output2=urldecode($str);
                //   $tss= explode('/',$output2);
        
                //   $video_id = substr(parse_url($tss[3], PHP_URL_PATH), 1);
    

            }
        } catch (VimeoUploadException $e) {
            $error = 'Error uploading ' . $file_name . "\n";
            $error .= 'Server reported: ' . $e->getMessage() . "\n";
            $output = array(
                "type" => "error",
                "error_message" => $error
            );
        } catch (VimeoRequestException $e) {
            $error = 'There was an error making the request.' . "\n";
            $error .= 'Server reported: ' . $e->getMessage() . "\n";
            $output = array(
                "type" => "error",
                "error_message" => $error
            );
        }
        $response = json_encode($output);
    } else {
            $output = array(
                "type" => "error",
                "error_message" => "Invalid file type"
            );
            $response = json_encode($output);
    }
        print $response;
        exit();
    }
		
			
	


  }

  


}