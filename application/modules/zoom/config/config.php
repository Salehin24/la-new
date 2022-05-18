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

$HmvcConfig['zoom']["_title"] = "Zoom Meeting";
$HmvcConfig['zoom']["_description"] = "Simple zoom live meeting";

//Set true/false if module have database 
$HmvcConfig['zoom']['_database'] = true;

// register your module tables. only register tables are imported while installing the module
$HmvcConfig['zoom']["_tables"] = array(
    'zoomconfig_tbl', 'meeting_tbl'
);

$HmvcConfig['zoom']['_extra_query'] = true;
$HmvcConfig['zoom']['_version'] = 1;


//$config['csrf_exclude_uris'] = array('zoom/zoomcontroler/viewHost', 'zoom/zoomcontroler/joinModal', 'zoom-config-save', 'meeting-edit',
//    'meeting-delete', 'live-course-save');
