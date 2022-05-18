<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Videoupload
{
  
    // To load this model
    // $this->fileupload->do_upload($upload_path = 'assets/images/profile/', $field_name = 'userfile');

    function do_upload($upload_path = null, $field_name = null) {

        $CI =get_instance();

        if (empty($_FILES[$field_name]['name'])) {
            return null;
        } else {
            //-----------------------------
            $ci =& get_instance();
            $ci->load->helper('url');  

            //folder upload
            $file_path = $upload_path.date('Y-m-d') . "/";
            if (!is_dir($file_path)) {
                @mkdir($file_path, 0755,true);
            }
            //ends of folder upload 

            //set config 
            $config = [
                'upload_path'   => $file_path,
                'allowed_types' => 'gif|jpg|png|jpeg|pdf|webp|pptx|doc|docx|mp4',
                'max_filename'  => 10,
                'overwrite'     => false,
                'maintain_ratio' => true,
                'encrypt_name'  => true,
                'remove_spaces' => true,
                'file_ext_tolower' => true 
            ]; 
            $ci->load->library('upload', $config);

            if (!$ci->upload->do_upload($field_name)) {
                $CI->session->set_flashdata('exception', $CI->upload->display_errors());
                return false;
            } else {
                $file = $ci->upload->data();
                return $file_path.$file['file_name'];
            }
        }
    }   

    public function do_resize($file_path = null, $width = null, $height = null) {
        $ci =& get_instance();
        $ci->load->library('image_lib');
        $config = [
            'image_library'  => 'gd2',
            'source_image'   => $file_path,
            'create_thumb'   => false,
            'maintain_ratio' => false,
            'width'          => $width,
            'height'         => $height,
        ]; 
        $ci->image_lib->initialize($config);
        $ci->image_lib->resize();
    }




    function do_resumeupload($upload_path = null, $field_name = null, $fileformat = null) {
        // dd($_FILES[$field_name]['tmp_name']);
        if (empty($_FILES[$field_name]['name'])) {
            return null;
        } else {
            $ci = & get_instance();
            $ci->load->helper('url');
            $filename = date('dHis').'-f-'.str_replace(" ","-", $_FILES[$field_name]['name']);
            //folder upload
            $file_path = $upload_path . date('Y-m-d') . "/";
            if (!is_dir($file_path))
                mkdir($file_path, 0755, true);
            //ends of folder upload 
            //set config 
            // 'gif|jpg|png|jpeg|ico|pdf|svg|docx'
          
            $config = [
                'upload_path' => $file_path,
                'allowed_types' =>"*",
                // 'max_filename' => 5,
                'overwrite' => false,
                'maintain_ratio' => true,
                'encrypt_name' => false,
                'remove_spaces' => true,
                // 'file_ext_tolower' => true,
                // 'file_name' => date('dHis').'-f-'.str_replace(" ","-", $_FILES[$field_name]['name']),
                'file_name' => $filename,
                // 'max_size' => '1000'
            ];
            // d($config);
            $ci->load->library('upload', $config);

            if (!$ci->upload->do_upload($field_name)) {
                $error = $ci->upload->display_errors();
                $ci->session->set_flashdata('file_uploaderror', $error);
                return false;
            } else {
                $file = $ci->upload->data();
                // return $file_path . $file['file_name'];
                return $file_path .$filename;
            }
        }
    }

}

