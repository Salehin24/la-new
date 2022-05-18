<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;
$active_record = TRUE;

$db['default'] = array(
    'dsn' => '',
    'hostname' => '127.0.0.1:3306',
    'username' => 'root',
    'password' => '',
    'database' => 'la',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'autoinit' => TRUE,
    // 'stricton' => FALSE,
    'failover' => array(),
    'port'      =>25060,
    'save_queries' => TRUE
);
