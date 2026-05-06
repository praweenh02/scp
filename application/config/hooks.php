<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/userguide3/general/hooks.html
|
*/
$hook['post_controller'][] = function () {
	// Skip for localhost (WAMP)
	if ($_SERVER['HTTP_HOST'] === 'localhost') {
		return;
	}

	if (is_cli()) return;

	$CI = &get_instance();

	if (substr(base_url(), 0, 5) === 'https' && !is_https()) {
		redirect(base_url(uri_string()));
	}

	$CI->output
		->set_header("Access-Control-Allow-Origin: *")
		->set_header("Access-Control-Allow-Methods: GET, POST, OPTIONS")
		->set_header("Access-Control-Allow-Headers: Content-Type, Authorization");

	if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
		header('HTTP/1.1 200 OK');
		exit;
	}
};
