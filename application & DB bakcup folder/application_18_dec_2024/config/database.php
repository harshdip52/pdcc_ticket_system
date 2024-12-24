<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

// $db['default'] = array(
// 	'dsn'	=> '',
// 	'hostname' => 'localhost',
// 	'username' => 'root',
// 	'password' => '',
// 	'database' => 'ticket_support_app',
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

// $db['default'] = array(
// 	'dsn'      => '',
// 	'hostname' => '103.118.16.16',
// 	'username' => 'pdcc',
// 	'password' => 'pdcc123',
// 	'database' => 'pdcc_live',
// 	'port'     => '1433',
// 	'dbdriver' => 'sqlsrv',
// 	'dbprefix' => 'pdcc_live.',
// 	'pconnect' => false,
// 	'db_debug'  => (ENVIRONMENT !== 'production'),
// 	'cache_on' => FALSE,
// 	'cachedir' => '',
// 	'char_set'  => 'utf8',
// 	'dbcollat' => 'utf8_general_ci',
// 	'swappre'  => '',
// 	'encrypt'  => false,
// 	'compress' => false,
// 	'strictOn' => false,
// 	'failover' => [],
// 	'save_queries' => TRUE
// );


$db['default'] = array(
	'dsn'      => '',
	// 'hostname' => '10.1.46.63',
	// 'username' => 'pdccbrd',
	// 'password' => 'pd((brd$#@!1',
	'hostname' => 'localhost',
	'username' => 'pdcc',
	'password' => 'pdcc123',
	'database' => 'ticket_support',
	'port'     => '1433',
	'dbdriver' => 'sqlsrv',
	// 'DBPrefix' => 'ticket_support_system_vol.',
    'pconnect' => true,
    'dbdebug'  => (ENVIRONMENT !== 'production'),
	//'dbdebug'  => FALSE,
	'charset'  => 'utf8',
	'DBCollat' => 'utf8_general_ci',//'Latin1_General_100_CI_AS_SC_UTF8',
	'dbprefix' => 'ticket_support.',
	//'pconnect' => true,
	//'db_debug'  => (ENVIRONMENT !== 'production'),
	//'char_set'  => 'utf8',
	//'dbcollat' => 'utf8_general_ci',	
	'swappre'  => '',
	'encrypt'  => false,
	'compress' => false,
	'strictOn' => false,
	'failover' => []

); 






