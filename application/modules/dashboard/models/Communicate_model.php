<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Communicate_model extends CI_Model {

    //    ========= its for certificate_edit ========
    // public function certificate_edit($id) {
    //     $this->db->select('*');
    //     $this->db->from('template_tbl a');
    //     $this->db->where('a.id', $id);
    //     $query = $this->db->get()->row();
    //     return $query;
    // }

    public function get_typewiseusers($type, $enterprise_id){
       $query =  $this->db->select('*')->from('loginfo_tbl a')
                ->where('user_types', $type)
                ->where('enterprise_id', $enterprise_id)
                ->where('status', 1)
                ->get()->result();
                return $query;
    }

       //    ========= its for get_templateinfo ========
       public function get_templateinfo($id) {
        $this->db->select('*');
        $this->db->from('template_tbl a');
        $this->db->where('a.id', $id);
        $query = $this->db->get()->row();
        return $query;
    }

    //    ========== its for sendLink ===============
    public function mailsend($data) {
        // d($data);
        // d($data['is_bcc']);
        $config = Array(
            'protocol' => $data['get_mail_config']->protocol, //'smtp',
            'smtp_host' => $data['get_mail_config']->smtp_host, //'ssl://smtp.gmail.com',
            'smtp_port' => $data['get_mail_config']->smtp_port, //465,
            'smtp_user' => $data['get_mail_config']->smtp_user, //'', // change it to yours
            'smtp_pass' => $data['get_mail_config']->smtp_pass, // '', // change it to yours
            'mailtype' => $data['get_mail_config']->mailtype, //'html',
            // 'charset' => 'iso-8859-1',
            'charset'   => 'utf-8',
            'wordwrap' => TRUE,
            'smtp_crypto'=>'tls',
        );
        // dd($config);
        $log_id = $data['log_id'];
        $data['get_userinfo'] = get_userinfo($log_id);
       

        if($data['type'] == 4 || $data['type'] == 5){
        $email = $data['get_userinfo']->email;        
        $name = (!empty($data['get_userinfo']->name) ? $data['get_userinfo']->name : '');
        $data['name'] = $data['get_userinfo']->name;
        }elseif($data['type'] == 6){
            $email = $data['others_email'];
            $data['name'] = 'There';
        }
        
        if($data['attachment']){
            $file_path = getcwd() . '/' . $data['attachment'];
        }else{
            $file_path = '';
        }
        // dd($file_path);
        // $template_id = 2;
        // $show_template = $this->get_templateinfo($template_id);
        
        // d($email);d("e");
        // d($name); d('n');
        // $template_body = html_entity_decode($show_template->template_body);
        // $data['template'] = $this->smsgateway->emailtemplate([
        //     'name' => $name,
        //     'certificate_name' => $show_template->title,
        //     'summary' => '', //$templates_info->template_body,
        //     'logo' => $show_template->logo,
        //     'date' => date('Y-m-d'), //date('d F Y', strtotime($data['get_assigncertificate']->created_date)),
        //     'templatebody' => $template_body,
        //     'message' => $data['message'],
        //     'baseurl' => base_url(),
        // ]);
        
        $mesg = $this->load->view('dashboard/communicates/sendmail', $data, TRUE);
       
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');
        $this->email->initialize($config);

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['get_mail_config']->smtp_user, "Welcome to Lead-Academy");


        // $this->email->to('shahabuddinp91@gmail.com');
        // // $this->email->cc('another@another-example.com');
        // $this->email->bcc('mds03136868@gmail.com');
        // $this->email->subject('Email Test');
        // $this->email->message('Testing the email class.');
        // $this->email->send();


        if($data['is_bcc'] == 0){
            $this->email->to($email);
        }
        if($data['is_bcc'] == 1){
            $this->email->bcc($email);
        }
        $this->email->subject((!empty($data['title']) ? $data['title'] : "Help Center"));
        $this->email->set_mailtype("html");
        $this->email->message($mesg);
        $this->email->attach($file_path);
        $send_data = $this->email->send();
        // dd($send_data);
    }


}