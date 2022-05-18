<?php
/*
|___________________________________________________________________
|	-> Configuration variable name must be $HmvcConfig
|	-> Module Name must be unique 
|	-> Module Name must be same as the module directory
|	-> Set a title and description 
|	-> Set true/false if module have database 
|	-> Must be register your database tables
|___________________________________________________________________
|
*/
 
$HmvcConfig['sslcommerz']["_title"]     = "SSLCommerz";
$HmvcConfig['sslcommerz']["_description"] = "Simple sslcommerz";

//Set true/false if module have database 
$HmvcConfig['sslcommerz']['_database'] = FALSE;

// register your module tables. only register tables are imported while installing the module
$HmvcConfig['sslcommerz']["_tables"] = array( 
	
);

$HmvcConfig['sslcommerz']['_extra_query'] = true;
$HmvcConfig['sslcommerz']['_version'] = 1;


//$config['csrf_exclude_uris'] = array('sslcommerz-payment-success', 'sslcommerz-payment-failed', 'sslcommerz-payment-cancel');
