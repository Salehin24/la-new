<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//=======sslcommerz module ============
require_once( BASEPATH . 'database/DB' . EXT );
$db = & DB();
$db->select('a.id, a.log_id, a.name, a.shortname');
$db->from('loginfo_tbl a');
$db->where('a.user_types', 1);
$db->or_where('a.user_types', 2);
$query = $db->get();
$result = $query->result();

// echo '<pre>'; print_r($result);
foreach ($result as $row) {
    // echo $row->shortname.".<br>"; 
    //$route[$row->shortname . '/category'] = 'dashboard/Category/index';
    // echo $row->shortname.'.'.$route['login'] = "dashboard/auth/index";
    // echo "<br>";
    //$row->shortname.'.'.$route['category'] = "dashboard/Category/index";
    // echo '<br>';
}

//=========== its for frontend start =============
foreach ($result as $row) {
$route[$row->shortname .'/sslcommerz-payment-success/(:any)'] = 'sslcommerz/sslcommerz/sslcommerz_payment_success/$1';
$route[$row->shortname .'/sslcommerz-payment-failed'] = 'sslcommerz/sslcommerz/sslcommerz_payment_failed';
$route[$row->shortname .'/sslcommerz-payment-cancel'] = 'sslcommerz/sslcommerz/sslcommerz_payment_cancel';
}