<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function checkallUser($data = array()) {
        $this->db->select("a.*, b.image, a.last_login, a.last_logout, a.ip_address, d.picture as picture");
        $this->db->from('loginfo_tbl a');
        $this->db->join('user b', 'b.log_id = a.log_id', 'left');
        $this->db->join('picture_tbl d', 'd.from_id = a.log_id', 'left');
        $this->db->where('a.username', $data['email']);
        // $this->db->where('a.password', md5($data['password']));
        // $this->db->where('a.status', 1);
        if($data['type']){
            $this->db->where('a.user_types', $data['type']);
        }
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query;
    }
    public function checkUser($data = array()) {
        $this->db->select("a.*, b.image, a.last_login, a.last_logout, a.ip_address, d.picture as picture");
        $this->db->from('loginfo_tbl a');
        $this->db->join('user b', 'b.log_id = a.log_id', 'left');
        $this->db->join('picture_tbl d', 'd.from_id = a.log_id', 'left');
        $this->db->where('a.username', $data['email']);
        $this->db->where('a.password', md5($data['password']));
        $this->db->where('a.status', 1);
        if($data['type']){
            $this->db->where('a.user_types', $data['type']);
        }
        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query;
    }


    public function checkUserpaylogin($logid) {
        $this->db->select("a.*, b.image, a.last_login, a.last_logout, a.ip_address, d.picture as picture");
        $this->db->from('loginfo_tbl a');
        $this->db->join('user b', 'b.log_id = a.log_id', 'left');
        $this->db->join('picture_tbl d', 'd.from_id = a.log_id', 'left');
        $this->db->where('a.log_id', $logid);        
        $query = $this->db->get();
        $user=$query->row();
        
        $sData = array(
            'isLogIn' => true,
            'isAdmin' => (($user->is_admin == 1) ? true : false),
            'is_admin' => $user->is_admin,
            'user_type' => $user->user_types,
            'log_id' => $user->log_id,
            'user_id' => $user->log_id,
            'created_by' => $user->created_by,
            'client_id' => (!empty($user->client_id) ? "$user->client_id" : ""),
            'fullname' => $user->name,
            'email' => $user->email,
            'image' => (!empty($user->image) ? $user->image : $user->picture),
            'last_login' => $user->last_login,
            'last_logout' => $user->last_logout,
            'ip_address' => $user->ip_address,            
            'session_id' => session_id(),
        );
        
        //store date to session 
        $this->session->set_userdata($sData);
    }
    public function userPermission1($id = null) {
        $acc_tbl = $this->db->select('*')->from('sec_user_access_tbl')->where('fk_user_id', $id)->get()->result();
        if ($acc_tbl != NULL) {
            $role_id = [];
            foreach ($acc_tbl as $key => $value) {
                $role_id[] = $value->fk_role_id;
            }

            return $result = $this->db->select("
			module.directory, 
			module_permission.fk_module_id, 
			IF(SUM(module_permission.create)>=1,1,0) AS 'create', 
			IF(SUM(module_permission.read)>=1,1,0) AS 'read', 
			IF(SUM(module_permission.update)>=1,1,0) AS 'update', 
			IF(SUM(module_permission.delete)>=1,1,0) AS 'delete'
			")
                    ->from('module_permission')
                    ->join('module', 'module.id = module_permission.fk_module_id', 'full')
                    ->where_in('module_permission.fk_role_id', $role_id)
                    ->where('module.status', 1)
                    ->group_by('module_permission.fk_module_id')
                    ->group_start()
                    ->where('create', 1)
                    ->or_where('read', 1)
                    ->or_where('update', 1)
                    ->or_where('delete', 1)
                    ->group_end()
                    ->get()
                    ->result();
        } else {
            return 0;
        }
    }

    public function userPermission2($id = null) {
        $acc_tbl = $this->db->select('*')->from('sec_user_access_tbl')->where('fk_user_id', $id)->get()->result();
        if ($acc_tbl != NULL) {
            $role_id = [];
            foreach ($acc_tbl as $key => $value) {
                $role_id[] = $value->fk_role_id;
            }

            return $result = $this->db->select("
				sec_role_permission.role_id, 
				sec_role_permission.menu_id, 
				IF(SUM(sec_role_permission.can_create)>=1,1,0) AS 'create', 
				IF(SUM(sec_role_permission.can_access)>=1,1,0) AS 'read', 
				IF(SUM(sec_role_permission.can_edit)>=1,1,0) AS 'update', 
				IF(SUM(sec_role_permission.can_delete)>=1,1,0) AS 'delete',
				sec_menu_item.menu_title,
				sec_menu_item.page_url,
				sec_menu_item.module
				")
                    ->from('sec_role_permission')
                    ->join('sec_menu_item', 'sec_menu_item.menu_id = sec_role_permission.menu_id', 'full')
                    ->where_in('sec_role_permission.role_id', $role_id)
                    ->group_by('sec_role_permission.menu_id')
                    ->group_start()
                    ->where('can_create', 1)
                    ->or_where('can_access', 1)
                    ->or_where('can_edit', 1)
                    ->or_where('can_delete', 1)
                    ->group_end()
                    ->get()
                    ->result();
        } else {
            return 0;
        }
    }

    public function userPermission($id = null) {
        return $this->db->select("
			module.directory, 
			module_permission.fk_module_id, 
			module_permission.create, 
			module_permission.read, 
			module_permission.update, 
			module_permission.delete
			")
                        ->from('module_permission')
                        ->join('module', 'module.id = module_permission.fk_module_id', 'full')
                        ->where('module_permission.fk_user_id', $id)
                        ->where('module.status', 1)
                        ->group_start()
                        ->where('create', 1)
                        ->or_where('read', 1)
                        ->or_where('update', 1)
                        ->or_where('delete', 1)
                        ->group_end()
                        ->get()
                        ->result();
    }

    public function last_login($log_id = null) {
        return $this->db->set('last_login', date('Y-m-d H:i:s'))
                        ->set('ip_address', $_SERVER['REMOTE_ADDR'])
                        ->where('log_id', $log_id)
                        ->update('loginfo_tbl');
    }

    public function last_logout($log_id = null) {
        return $this->db->set('last_logout', date('Y-m-d H:i:s'))
                        ->where('log_id', $log_id)
                        ->update('loginfo_tbl');
    }

    //    ============== its for checkEmail =============
    public function checkEmail($email) {
        return $query = $this->db->select('*')->from('loginfo_tbl')->where('email', $email)->get()->row();
    }

//    ========== its for sendLink ===============
    public function sendLink($log_id, $email, $data, $random_key) {
        $data['baseurl'] = base_url();
        $config = Array(
            'protocol' => $data['get_mail_config']->protocol, //'smtp',
            'smtp_host' => $data['get_mail_config']->smtp_host, //'ssl://smtp.gmail.com',
            'smtp_port' => $data['get_mail_config']->smtp_port, //465,
            'smtp_user' => $data['get_mail_config']->smtp_user, //'', // change it to yours
            'smtp_pass' => $data['get_mail_config']->smtp_pass, // '', // change it to yours
            'mailtype' => $data['get_mail_config']->mailtype, //'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE,
            'smtp_crypto'=>'tls',
        );
        
        $data['author_info'] = $this->author_info($log_id);
        $data['random_key'] = $random_key;
        // $data['enterprise_shortname'] = $data['enterprise_shortname'];
        $mesg = $this->load->view('frontend/themes/default/sendPasswordLink', $data, TRUE);

        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');

        $this->load->library('email', $config);
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($data['get_mail_config']->smtp_user, "Lead Academy");
        $this->email->to($email);
        $this->email->subject("Forgot Password");

        $this->email->message($mesg);
        $send_data = $this->email->send();
    }

    //    =========== its for author_info ==============
    public function author_info($log_id) {
        $query = $this->db->select('*')
                        ->from('loginfo_tbl a')
                        ->where('a.log_id', $log_id)
                        ->get()->row();
        return $query;
    }

//    ============ its for user password check ============
    public function user_password_check($user_id, $current_password) {
        $this->db->select('*')->from('loginfo_tbl');
        $this->db->where('log_id', $user_id);
        $this->db->where('password', md5($current_password));
        $query = $this->db->get()->row();
        return $query;
    }

}
