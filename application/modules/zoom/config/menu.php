<?php

// module name
$HmvcMenu["zoom"] = array(
    //set icon
    "icon" => "<i class='fas fa-search-plus mr-2'>&nbsp;&nbsp;</i> ",
    //1st level menu name
    "configuration" => array(
        "controller" => "zoomcontroler",
        "method" => "index",
        "permission" => "create"
    ),
//    "setting" => array(
//        "controller" => "home",
//        "method" => "form",
//        "permission" => "create"
//    ),
        // 2nd level menu 
        // "group_name" => array( 
        //     'menu1'    => array( 
        //         "controller" => "home",
        //         "method"     => "index",
        //         "permission" => "create"
        //     ), 
        //     'menu2'  => array( 
        //         "controller" => "home",
        //         "method"     => "index2",
        //         "permission" => "read"
        //     ), 
        // ), 
);


