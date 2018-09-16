<?php

if (!defined('ABSPATH')) exit;

if ( ! defined('DEBUG') || DEBUG === false ) {
	error_reporting(0);
	ini_set("display_errors", 0);
} else {
	error_reporting(E_ALL);
	ini_set("display_errors", 1);
}
// ini_set('session.gc_maxlifetime', 30*60);

require_once ABSPATH . '/functions/global-functions.php';
new Manager();
?>
