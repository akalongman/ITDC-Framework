<?php
/**
 * @package 			ITDCMS
 * @copyright 		Copyright (C) 2001 - 2013 ITDC, JSC. All rights reserved.
 * @license 			Commercial license
 */
session_start();

date_default_timezone_set('Asia/Tbilisi');

$system_path = '../system';

//backend path
define('BACKPATH','../backend/');

//frontend path
define('FRONTPATH','../frontend/');

//config path
define('CONFPATH','../config/');

define('ADMIN_URI','admin');

if (preg_match('#/'.ADMIN_URI.'#',$_SERVER['REQUEST_URI'])) {
	$application_folder = substr(BACKPATH,0,-1);
} else {
	$application_folder = substr(FRONTPATH,0,-1);
}


// Set the current directory correctly for CLI requests
if (defined('STDIN'))
{
	chdir(dirname(__FILE__));
}

if (realpath($system_path) !== FALSE)
{
	$system_path = realpath($system_path).'/';
}

// ensure there's a trailing slash
$system_path = rtrim($system_path, '/').'/';

// Is the system path correct?
if ( ! is_dir($system_path))
{
	exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
}

// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
// The PHP file extension
// this global constant is deprecated.
define('EXT', '.php');

// Path to the system folder
define('BASEPATH', str_replace("\\", "/", $system_path));

// Path to the front controller (this file)
define('FCPATH', str_replace(SELF, '', __FILE__));

// Name of the "system folder"
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));

// The path to the "application" folder
if (is_dir($application_folder))
{
	define('APPPATH', FCPATH.$application_folder.'/');
}
else
{
	if ( ! is_dir(BASEPATH.$application_folder.'/'))
	{
		exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: ".SELF);
	}

	define('APPPATH', FCPATH.$application_folder.'/');
}

require_once BACKPATH.'core/common/common.php';

require_once BASEPATH.'core/CodeIgniter.php';

