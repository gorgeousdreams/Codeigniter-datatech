<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
define('EXIT_SUCCESS', 0); // no errors
define('EXIT_ERROR', 1); // generic error
define('EXIT_CONFIG', 3); // configuration error
define('EXIT_UNKNOWN_FILE', 4); // file not found
define('EXIT_UNKNOWN_CLASS', 5); // unknown class
define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
define('EXIT_USER_INPUT', 7); // invalid user input
define('EXIT_DATABASE', 8); // database error
define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/* type of the post */

define('LINK', '1');
define('AUDIO', '2');
define('QUESTION', '3');
define('BLOG', '4');


/* voting status */

define("VOTED", "1");
define("DEVOTED", "2");

/* Linked In Login */

define('LINKEDIN_CLIENT_ID', '75fvmusxhunw8x');
define('LINKEDIN_CLIENT_SECRET', 'HAstIWvg7f8qsGvJ');

/* Facebook Login 
	juhis+1@codebox.net.in
*/
define('FACEBOOK_APP_ID', '1624187461193671');
define('FACEBOOK_APP_SECRET', '627da40f59f8573808aaf801cac68fa6');

/* 
	Account type
*/
define('FACEBOOK_ACCOUNT', 'facebook');
define('LINKEDIN_ACCOUNT', 'linkedin');
define('GOOGLE_ACCOUNT', 'google');

/* Twitter App 
	juhis+1@codebox.net.in
*/
define('TW_APP_ID', 'SJLAyqZhwrTvwyvvfxlTBr9Mp');
define('TW_APP_SECRET', '0898WKLjSYBZb7PKMdzAgS73e5COBQwmY8s81cUpo4RubHxHOV');
define('TW_ACC_TOKEN', '3166927260-WUHaHZ8C6cPOGhV6nhmgCyr5SeAeuk7BH8ffHXf');
define('TW_ACC_TOKEN_SECRET', '0898WKLjSYBZb7PKMdzAgS73e5COBQwmY8s81cUpo4RubHxHOV');

/* image thumbnail width & height*/
define('WIDTH_FOR_POST_LISTING', 200);
define('HEIGHT_FOR_POST_LISTING', 150);
define('WIDTH_FOR_POST_DETAILS', 200);
define('HEIGHT_FOR_POST_DETAILS', 200);

/* google API keys */

define("GOOGLE_CLIENT_ID","912359234760-fe5fevjhg58f0dbehr4o102s3gvu0a9n.apps.googleusercontent.com");
define("GOOGLE_CLIENT_SECRET","19FYqP6gG0sIRIXBOQbPG354");
define("GOOGLE_DEVELOPER_KEY","AIzaSyARRtXioRQZhnZ-312DuD4XN_vxU4-d1xY");