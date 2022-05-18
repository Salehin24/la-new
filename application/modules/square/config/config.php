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

$HmvcConfig['square']["_title"] = "Square";
$HmvcConfig['square']["_description"] = "Simple Square";

//Set true/false if module have database 
$HmvcConfig['square']['_database'] = FALSE;

// register your module tables. only register tables are imported while installing the module
$HmvcConfig['square']["_tables"] = array(
    
);

$HmvcConfig['square']['_extra_query'] = true;
$HmvcConfig['square']['_version'] = 1;

//$config['csrf_exclude_uris'] = array('square-payment-success');
