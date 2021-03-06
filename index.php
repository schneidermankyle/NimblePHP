<?php
/**
 * Nimble PHP
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2015 - 2016, Kyle Schneiderman
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	Nimble PHP
 * @author	Kyle Schneiderman
 * @copyright	Copyright (c) 2015 - 2016, Kyle Schneiderman (https://kyleschneiderman.com/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://kyleschneiderman.com/projects/nimblephp
 * @since	Version 0.0.1
 * @filesource
 */

/**
 * Nimble Version
 *
 * @var	string
 */
define('Version', '0.0.9');

/****************************************************************
 * Timezone
 ****************************************************************
 * Initialize timezone to server location
 */

date_default_timezone_set('America/Los_Angeles');

/****************************************************************
 * SYSTEM
 ****************************************************************
 * This is the location for which the MVC framework system is located.
 * If you would like to change the directory for which the system is installed
 * ensure this variable is updated with the directory name or path relative
 * to this file.
 */

$sys_path = 'system';

/****************************************************************
 * APPLICATION
 ****************************************************************
 * This is the location for which the MVC framework application is located.
 * If you would like to change the directory for which the system is installed
 * ensure this variable is updated with the directory name or path relative
 * to this file.
 */

$app_path = 'application';


/////////////////////////////////////////////////////////////////
// DO NOT EDIT BELOW THIS LINE
/////////////////////////////////////////////////////////////////

/****************************************************************
 * Ensure that our system and application paths are true
 ****************************************************************
 * Our application and system path must be resolved in order to 
 * ensure it is pointing to the correct directory on our drive. 
 */

// Make sure our system path is correct.
if (realpath($sys_path) !== false) {
	$sys_path = realpath($sys_path).DIRECTORY_SEPARATOR;
} 

// Make sure our system path is really there.
if (!is_dir($sys_path)) {
	header('HTTP/1.1 503 Service Unavailable.', true, 503);
	echo ('Error, it appears that your system directory was set incorrectly');
	exit(3);
}

// Ensure our application path is correct
if (realpath($app_path) !== false) {
	$app_path = realpath($app_path).DIRECTORY_SEPARATOR;
} 

// Make sure our application directory is real
if (!is_dir($app_path)) {
	header('HTTP/1.1 503 Service Unavailable.', true, 503);
	echo ('Error, it appears that your application directory was set incorrectly');
	exit(3);
}

// Ensure that our root directory is set
if (dirname(__FILE__) !== false) {
	$root = dirname(__FILE__).DIRECTORY_SEPARATOR;
}

// Ensure that our directory is real
if (!is_dir($root)) {
	header('HTTP/1.1 503 Service Unavailable.', true, 503);
	echo ('Error, there was an error accessing your root directory, please ensure that your read/write permissions are set correctly');
	exit(3);
}

/****************************************************************
 * Set our constants
 ****************************************************************
 * Variable $sys_path must be resolved in order to ensure it is 
 * pointing to the correct directory on our drive. 
 */

// Our system path
define('SYSTEM', $sys_path);

// Our application path
define('APPLICATION', $app_path);

// Our root directory
define('ROOT', $root);

/****************************************************************
 * Start our main application
 ***************************************************************/
require SYSTEM."/core/system.php";