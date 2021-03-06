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

$HmvcConfig['paystack']["_title"] = "Paystack";
$HmvcConfig['paystack']["_description"] = "Simple Paystack";

//Set true/false if module have database 
$HmvcConfig['paystack']['_database'] = false;

// register your module tables. only register tables are imported while installing the module
$HmvcConfig['paystack']["_tables"] = array(
    
);

$HmvcConfig['paystack']['_extra_query'] = true;
$HmvcConfig['paystack']['_version'] = 1;

//$config['csrf_exclude_uris'] = array('payment-success', 'paystack-cancel');
