<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forumcontroller extends MX_Controller {

    private $user_id = "";
    private $user_type = "";

    public function __construct() {
        parent::__construct();
        $this->load->library('generators');
        $this->user_id = $this->session->userdata('user_id');
        $this->load->model('Forum_model');
        $this->load->model('setting_model');
        

        $app_setting = get_appsettings();
        $this->createdtime = (!empty($app_setting->timezone) ? $app_setting->timezone : '');
        $timezone = (!empty($this->createdtime) ? "$this->createdtime" : "Asia/Dhaka");
        $date = new DateTime("Now", new DateTimeZone($timezone));
        $this->createdtime = $date->format('Y-m-d H:i:s');

        $pusher_config = $this->setting_model->pusher_config(get_enterpriseid());

        $pusher_data = array(
            'api_id' => (!empty($pusher_config->api_id) ? $pusher_config->api_id : ''),
            'api_key' => (!empty($pusher_config->api_key) ? $pusher_config->api_key : ''),
            'secret_key' => (!empty($pusher_config->secret_key) ? $pusher_config->secret_key : ''),
            'cluster' => (!empty($pusher_config->cluster) ? $pusher_config->cluster : ''),
        );
        $this->session->set_userdata($pusher_data);
        $options = array(
            'cluster' => (!empty($pusher_config->cluster) ? $pusher_config->cluster : ''),
            'useTLS' => true
        );
        if ($pusher_config) {
            $this->pusher = new Pusher\Pusher(
                    $pusher_config->api_key, $pusher_config->secret_key, $pusher_config->api_id, $options
            );
        }
        if (!$this->session->userdata('session_id'))
            redirect(enterpriseinfo()->shortname.'/login');
    }

    public function forum_category() {
        $data['title'] = display('forum_category');
        $config["base_url"] = base_url('forum-category');
        $config["total_rows"] = $this->db->count_all('forum_category_tbl');
        $config["per_page"] = 20;
        $config["uri_segment"] = 2;
        $config["last_link"] = "Last";
        $config["first_link"] = "First";
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close'] = '</span></li>';
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["forum_category_list"] = $this->Forum_model->forum_category_list($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['pagenum'] = $page;

        $data['module'] = "dashboard";
        $data['page'] = "forum/forum_category";
        echo modules::run('template/layout', $data);
    }

//============= its for forum_category_save ==============
    public function forum_category_save() {
        $forum_category_id = "EC" . date('d') . $this->generators->generator(5);
        $title = $this->input->post('title', true);
        $check_category = $this->db->select('*')->from('forum_category_tbl')->where('title', $title)->get()->row();
        if ($check_category) {
            echo "exists";
        } else {
            $forum_category_data = array(
                'forum_category_id' => $forum_category_id,
                'title' => $title,
                'status' => 1,
                'created_by' => $this->user_id,
                'created_date' => $this->createdtime,
            );
            $this->db->insert('forum_category_tbl', $forum_category_data);
            echo "save";
        }
    }

//    ================== its for forumcategory_edit =========
    public function forumcategory_edit() {
        $id = $this->input->post('id', true);
        $data['edit_data'] = $this->Forum_model->edit_data($id);

        $this->load->view('dashboard/forum/forum_category_edit', $data);
    }

//    ============= its for forumcategory_update =========
    public function forumcategory_update() {
        $forum_category_id = $this->input->post('forum_category_id', true);
        $title = $this->input->post('title', true);

        $forum_category_data = array(
            'title' => $title,
            'status' => 1,
            'updated_by' => $this->user_id,
            'updated_date' => $this->createdtime,
        );
        $this->db->where('forum_category_id', $forum_category_id)->update('forum_category_tbl', $forum_category_data);
        echo display('updated_successfully');
    }

//============== its for add_forum =============
    public function add_forum() {
        $data['title'] = display('add_forum');
        $data['get_forumcategory'] = $this->Forum_model->get_forumcategory();

        $data['module'] = "dashboard";
        $data['page'] = "forum/add_forum";
        echo modules::run('template/layout', $data);
    }

//    ============ its for forum_save ============
    public function forum_save() {
        
        $forum_id = "E" . date('d') . $this->generators->generator(6);
        $title = $this->input->post('title', true);
        $slug = str_replace(" ", "-", strtolower($title));
        $slug = rtrim($slug, "-");
        $category_id = $this->input->post('category_id', true);
        $description = $this->input->post('description', true);
        $is_front = $this->input->post('is_front', true);
        $is_slide = $this->input->post('is_slide', true);
//        ========= its for local address =============
        // $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . $this->getRealIpAddr());


        // if ($xml->geoplugin_status == 200) {
        //     $location = $xml->geoplugin_city . ", " . $xml->geoplugin_countryName;
        // } else {
        //     $location = '';
        // }

        //picture upload
        $image = $this->fileupload->do_upload(
                'assets/uploads/forum/', 'picture','gif|jpg|png|jpeg|pdf'
        );
        // if image is uploaded then resize the $image
        if ($image !== false && $image != null) {
            $this->fileupload->do_resize(
                    $image, 300, 300
            );
        }


        $forum_data = array(
            'forum_id' => $forum_id,
            'title' => $title,
            'category_id' => $category_id,
            'description' => $description,
            'is_front' => $is_front,
            'is_slide' => $is_slide,
            'status' => 1,
            'location' => '', //$location,
            'slug' => $slug,
            'enterprise_id' => get_enterpriseid(),
            'created_date' => $this->createdtime,
            'created_by' => $this->user_id,
        );
        $this->db->insert('forum_tbl', $forum_data);
        if ($image) {
            $picture_data = array(
                'from_id' => $forum_id,
                'picture' => $image,
                'picture_type' => 'forum',
                'status' => 1,
                'created_date' => $this->createdtime,
                'created_by' => $this->user_id,
            );
            $this->db->insert('picture_tbl', $picture_data);
        }

        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Forum added successfully!</div>");
        redirect(enterpriseinfo()->shortname.'/add-forum');
    }

//============= its for forum list ========================
    public function forum_list() {
        $data['title'] = display('forum_list');
        $data['get_evetnts'] = $this->Forum_model->get_forum();
        $data['get_forumcategory'] = $this->Forum_model->get_forumcategory();
        $config["base_url"] = base_url(enterpriseinfo()->shortname.'/forum-list/');
        $config["total_rows"] = $this->db->count_all('forum_tbl');
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config["last_link"] = "Last";
        $config["first_link"] = "First";
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close'] = '</span></li>';
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["forum_list"] = $this->Forum_model->forum_list($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['pagenum'] = $page;
        
        $data['module'] = "dashboard";
        $data['page'] = "forum/forum_list";
        echo modules::run('template/layout', $data);
    }

//    ============ its for forum_filter =============
    public function forum_filter() {
        $forum_id = $this->input->post('forum_id', true);
        $category_id = $this->input->post('category_id', true);
        $data["forum_list"] = $this->Forum_model->forum_filter($forum_id, $category_id);

        $this->load->view('forum/forum_filter', $data);
    }

    ////    =================== its for forum edit ============
    public function forum_edit($forum_id) {
        $data['title'] = display('forum_edit');
        $data['get_forumcategory'] = $this->Forum_model->get_forumcategory();
        $data['edit_forumdata'] = $this->Forum_model->edit_forumdata($forum_id);

        $data['module'] = "dashboard";
        $data['page'] = "forum/forum_edit";
        echo modules::run('template/layout', $data);
    }

//    ============= its for forum update ===========
    public function forum_update() {
        $forum_id = $this->input->post('forum_id', true);
        $title = $this->input->post('title', true);
        $slug = str_replace(" ", "-", strtolower($title));
        $slug = rtrim($slug, "-");
        $category_id = $this->input->post('category_id', true);
        $description = $this->input->post('description', true);
        $is_front = $this->input->post('is_front', true);
        $is_slide = $this->input->post('is_slide', true);

//        ========= its for local address =============
        // $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . $this->getRealIpAddr());
        // $location = $xml->geoplugin_city . ", " . $xml->geoplugin_countryName;

        //picture upload
        $image = $this->fileupload->update_doupload(
                $forum_id, 'assets/uploads/forum/', 'picture','gif|jpg|png|jpeg'
        );

        $forum_data = array(
            'title' => $title,
            'category_id' => $category_id,
            'description' => $description,
            'is_front' => $is_front,
            'is_slide' => $is_slide,
            'location' => '', //$location,
            'slug' => $slug,
            'enterprise_id' => get_enterpriseid(),
            'updated_date' => $this->createdtime,
            'updated_by' => $this->user_id,
        );
        $this->db->where('forum_id', $forum_id)->update('forum_tbl', $forum_data);
        $check_image = $this->db->select('*')->from('picture_tbl')->where('from_id', $forum_id)->get()->row();
        if ($image) {
            if ($check_image) {
                $picture_data = array(
                    'picture' => $image,
                    'picture_type' => 'forum',
                    'updated_date' => $this->createdtime,
                    'updated_by' => $this->user_id,
                );
                $this->db->where('from_id', $forum_id)->update('picture_tbl', $picture_data);
            } else {
                $picture_data = array(
                    'from_id' => $forum_id,
                    'picture' => $image,
                    'picture_type' => 'forum',
                    'status' => 1,
                    'created_date' => $this->createdtime,
                    'created_by' => $this->user_id,
                );
                $this->db->insert('picture_tbl', $picture_data);
            }
        }
        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Forum updated successfully!</div>");
        redirect(enterpriseinfo()->shortname.'/forum-list');
    }

    //    =========== its for  active forum===========
    public function forum_active() {

        $forum_id = $this->input->post('forum_id', true);
        $forum_data = array(
            'status' => 1,
        );
        $this->db->where('forum_id', $forum_id)->update('forum_tbl', $forum_data);
   // notification query 
        $blog_site= $this->db->select("a.*,b.user_id,b.blog_site,b.blog_email,b.blog_sms")
        ->from('loginfo_tbl a')
         ->join('notification_config_tbl b', 'b.user_id = a.log_id', 'left')
        ->where('a.enterprise_id',get_enterpriseid())
        ->where('a.status',1)
        ->get()->result();
        $app_setting = get_appsettings();
        $fromemail=$app_setting->email;
        $course_url=base_url(enterpriseinfo()->shortname."/forum-details/".$forum_id);

        $forumname=$this->db->select("*")->from("forum_tbl")->where('forum_id',$forum_id)->get()->row();

        $sms_gateway_info = $this->setting_model->sms_gateway(1);
 

        foreach( $blog_site as $blog_status){
           if($blog_status->blog_site==1){
            $data_nofi=array(
                'notification_id'=>$forum_id,
                'student_id'=>$blog_status->user_id,
                'notification_type'=>3,
                'created_date'=>date('Y-m-d H:i:s'),
                'isNotify'=>1,
                'enterprise_id'=>get_enterpriseid(),
            );
            $this->db->insert('notifications_tbl', $data_nofi);
           }
           if($blog_status->blog_email==1){
               
                    $to_email = $blog_status->email;
                    $to_mail_delivered = explode(',', $to_email);
                    $send_email =$this->db->select("*")->from('mail_config_tbl')->where('enterprise_id',get_enterpriseid())->get()->row();	
                    $description = word_limiter($forumname->description, 10);
                        $config = array(
                            'protocol'  => $send_email->protocol,
                            'smtp_host' => $send_email->smtp_host,
                            'smtp_port' => $send_email->smtp_port,
                            'smtp_user' => $send_email->smtp_user,
                            'smtp_pass' => $send_email->smtp_pass,
                            'mailtype'  => $send_email->mailtype,
                            'charset'   => 'utf-8',
                            'wordwrap' => TRUE,
                            'smtp_crypto'=>'tls',
                        );
                        $this->load->library('email');
                        $this->email->initialize($config);
                        $this->email->set_newline("\r\n");
                        $this->email->set_mailtype("html");
                        $htmlContent="<h1>Forum</h1> <b>$forumname->title</b></br><p>$description</p></br> Learn more click here: <a href='$course_url'>Link</a>";
                        $this->email->from("$fromemail",enterpriseinfo()->shortname);
                        $this->email->to($to_mail_delivered);
                        $this->email->subject(enterpriseinfo()->shortname);
                        $this->email->message($htmlContent);
                        $this->email->send();
                
                
           }
            if($blog_status->blog_sms==1){
                $to_mobile = $blog_status->mobile;
                    $this->smsgateway->send([
                        'apiProvider' => $sms_gateway_info->provider_name,
                        'username' => $sms_gateway_info->user,
                        'password' => $sms_gateway_info->password,
                        'from' => $sms_gateway_info->authentication,
                        'to' =>  $to_mobile ,
                        'message' => "Forum -> $forumname->title . $description Learn more click here:  <a href='$course_url'>Link</a>",
                    ]);
            }  
         }
    // notification query end
    }

//    =========== its for forum inactive ===========
    public function forum_inactive() {
        
        $forum_id = $this->input->post('forum_id', true);
        $forum_data = array(
            'status' => 0,
        );
        $this->db->where('forum_id', $forum_id)->update('forum_tbl', $forum_data);

          // notification query 
          $blog_site= $this->db->select("a.student_id,b.blog_site,b.blog_email,b.blog_sms")
          ->from('students_tbl a')
           ->join('notification_config_tbl b', 'b.user_id = a.student_id', 'left')
          ->where('a.enterprise_id',get_enterpriseid())
          ->get()->result();
          
          foreach( $blog_site as $blog_status){
             if($blog_status->blog_site==1){
            //    $data_nofi=array(
            //       'notification_id'=>$forum_id,
            //       'student_id'=>$blog_status->student_id,
            //       'notification_type'=>3,
            //       'created_date'=>date('Y-m-d H:i:s'),
            //       'isNotify'=>1,
            //       'enterprise_id'=>get_enterpriseid(),
            //   );
            //   $this->db->insert('notifications_tbl', $data_nofi);
              $this->db->where('notification_id', $forum_id)->delete('notifications_tbl');
             }
             if($blog_status->blog_email==1){
  
             }
             if($blog_status->blog_sms==1){
  
             }
          }


        echo "inactive";
        // $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Inactivated Successfully</div>");
        // redirect(enterpriseinfo()->shortname.'/forum-list');
    }


//============= its for comment list ========================
    public function comment_list() {
        $data['title'] = display('comment_list');
        $config["base_url"] = base_url(enterpriseinfo()->shortname.'/comment-list/');
        $config["total_rows"] = $this->db->count_all('comments_tbl');
        $config["per_page"] = 20;
        $config["uri_segment"] = 2;
        $config["last_link"] = "Last";
        $config["first_link"] = "First";
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close'] = '</span></li>';
        /* ends of bootstrap */
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["comment_list"] = $this->Forum_model->comment_list($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
        $data['pagenum'] = $page;

        $data['module'] = "dashboard";
        $data['page'] = "forum/comment_list";
        echo modules::run('template/layout', $data);
    }

//    =========== its for comment active ===========
    public function comment_active() {
        $comment_id = $this->input->post('comment_id', true);
        $comment_data = array(
            'status' => 1,
        );
        $this->db->where('comment_id', $comment_id)->update('comments_tbl', $comment_data);
        echo display('activated_successfully');
    }

//    =========== its for comment inactive ===========
    public function comment_inactive() {
        $comment_id = $this->input->post('comment_id', true);
        $comment_data = array(
            'status' => 0,
        );
        $this->db->where('comment_id', $comment_id)->update('comments_tbl', $comment_data);
        echo display('inactivated_successfully');
    }

//    ============== its for forum delete ==========
    public function forum_delete($forum_id) {
        if ($forum_id) {
            $image = $this->fileupload->delete_uploadedfile(
                    $forum_id
            );
        }

        $this->db->where('forum_id', $forum_id)->delete('forum_tbl');
        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Forum deleted successfully!</div>");
        redirect(enterpriseinfo()->shortname.'/forum-list');
    }

//    ========= its for forum_category_delete ==========
    public function forum_category_delete() {
        $category_id = $this->input->post('category_id', true);
        $checkcategory_forum = $this->db->select('*')->from('forum_tbl')->where('category_id', $category_id)->get()->row();
        if ($checkcategory_forum) {
            echo 0;
            exit();
        } else {
            $this->db->where('forum_category_id', $category_id)->delete('forum_category_tbl');
            echo 1;
        }
    }

//========= its for get real ip address =============
    public function getRealIpAddr() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {   //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {   //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

//    ============ its for comment_delete ============
    public function comment_delete($comment_id) {
        $this->db->where('comment_id', $comment_id)->delete('comments_tbl');
        $this->session->set_flashdata('success', "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Comment deleted successfully!</div>");
        redirect(enterpriseinfo()->shortname.'/comment-list');
    }

}
