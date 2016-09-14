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

defined("SYSTEM") or exit("Error direct access not allowed");

//**************************************************************************
// SYSTEM FILE
//**************************************************************************
//
// This file is meant to hold configuration and autoload settings for the 
// main system. Typically this file will be left alone by the developer 
// unless tweeks to the system are required. For most configuration settings,
// please use the config and autoload files within the application/config
// namespace
//
//**************************************************************************

/*
| -------------------------------------------------------------------
|  Configurations
| -------------------------------------------------------------------
|  Set the directory where system logs should be kept
| 
| Prototype:
|
|	$config["logs"] = "/system/logs/errors.log";
|
*/
$config["logs"] = "/system/logs/errors.log";

/*
| -------------------------------------------------------------------
|  Auto-load Packages
| -------------------------------------------------------------------
| Prototype:
|
|	$autoload["core"] = array("ClassName", "ClassName2");
|
| You can also include a associative array if you require to autoload
| a package that is not in a default location:
|
|	$autoload["core"] = array("Exceptions" => "System\Core"); 
|
| Optionally, if more data is needed for your class, you can pass an
| array with the extra values as given below:
|
|	$autoload["core"] = array("Exceptions" => array("System\Core", "System\Core\\", $System, "some parameter"));
|
*/
$autoload["core"] = array("Exceptions", ["Logger", "Core", "System\Core\\", $config["logs"]] );