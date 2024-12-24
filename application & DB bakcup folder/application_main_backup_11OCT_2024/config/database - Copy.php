<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

// $db['default'] = array(
// 	'dsn'	=> '',
// 	'hostname' => 'localhost',
// 	'username' => 'root',
// 	'password' => '',
// 	'database' => 'ticket_support_app_live',
// 	'dbdriver' => 'mysqli',
// 	'dbprefix' => '',
// 	'pconnect' => FALSE,
// 	'db_debug' => (ENVIRONMENT !== 'production'),
// 	'cache_on' => FALSE,
// 	'cachedir' => '',
// 	'char_set' => 'utf8',
// 	'dbcollat' => 'utf8_general_ci',
// 	'swap_pre' => '',
// 	'encrypt' => FALSE,
// 	'compress' => FALSE,
// 	'stricton' => FALSE,
// 	'failover' => array(),
// 	'save_queries' => TRUE
// );


## Added By Harshdeep
## on 30 AUGUST 2024
## used  FOR MS SQL Server Conncetion 

$db['default'] = array(
	'dsn'      => '',
	
	'hostname' => '10.1.46.63',
	'username' => 'pdccbrd',
	'password' => 'pd((brd$#@!1',
	'database' => 'ticket_support_system_vol',
	'port'     => '1433',
	'dbdriver' => 'sqlsrv',	
	'dbprefix' => 'ticket_support_system_vol.',
	'pconnect' => true,
	//'DBDebug'  => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set'  => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swappre'  => '',
	'encrypt'  => false,
	'compress' => false,
	'strictOn' => false,
	'failover' => [],
	'save_queries' => FALSE
); 



// $db['default'] = array(
// 	'dsn'	=> '',
// 	'hostname' => '103.118.16.16',
// 	'username' => 'pdcc',
// 	'password' => 'Pdcc@123',
// 	'database' => 'ticket_support_app',
// 	'dbdriver' => 'mssql',
// 	'dbprefix' => '',
// 	'pconnect' => FALSE,
// 	'db_debug' => (ENVIRONMENT !== 'production'),
// 	'cache_on' => FALSE,
// 	'cachedir' => '',
// 	'char_set' => 'utf8',
// 	'dbcollat' => 'utf8_general_ci',
// 	'swap_pre' => '',
// 	'encrypt' => FALSE,
// 	'compress' => FALSE,
// 	'stricton' => FALSE,
// 	'failover' => array(),
// 	'save_queries' => TRUE
// );
