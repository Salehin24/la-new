<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Facebook API Configuration
| -------------------------------------------------------------------
|
| To get an facebook app details you have to create a Facebook app
| at Facebook developers panel (https://developers.facebook.com)
|
|  facebook_app_id               string   Your Facebook App ID.
|  facebook_app_secret           string   Your Facebook App Secret.
|  facebook_login_redirect_url   string   URL to redirect back to after login. (do not include base URL)
|  facebook_logout_redirect_url  string   URL to redirect back to after logout. (do not include base URL)
|  facebook_login_type           string   Set login type. (web, js, canvas)
|  facebook_permissions          array    Your required permissions.
|  facebook_graph_version        string   Specify Facebook Graph version. Eg v3.2
|  facebook_auth_on_load         boolean  Set to TRUE to check for valid access token on every page load.
*/
$ci =& get_instance();
$enterprise_id = $ci->session->userdata('enterprise_id');
$enterpriseid = (!empty($enterprise_id) ? $enterprise_id : '1');
$ci->enterprise_info = get_enterpriseinfo($enterpriseid);
$ci->enterprise_shortname = (!empty($this->enterprise_info->shortname) ? $this->enterprise_info->shortname : 'admin');

$fb = $ci->db->select('*')->from('socialauth_config_tbl')->where('enterprise_id', $enterpriseid)->where('type', 2)->get()->row();

$config['facebook_app_id']                = (!empty($fb->appid_clientid) ? $fb->appid_clientid : '111');
$config['facebook_app_secret']            = (!empty($fb->secret_key) ? $fb->secret_key : '111');
$config['facebook_login_redirect_url']    = 'frontend/frontend/signinbyfacebook/';
$config['facebook_logout_redirect_url']   = 'user_authentication/logout';
$config['facebook_login_type']            = 'web';
$config['facebook_permissions']           = array('email');
$config['facebook_graph_version']         = 'v3.2';
$config['facebook_auth_on_load']          = TRUE;
