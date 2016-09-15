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

defined('SYSTEM') OR exit('Error, direct access not allowed');

/*
 * ------------------------------------------------------
 *  Load application map
 * ------------------------------------------------------
 */
require_once(SYSTEM.'core'.DIRECTORY_SEPARATOR.'map.php');

/*
 * ------------------------------------------------------
 *  Load common functions
 * ------------------------------------------------------
 */
require_once(CORE.'core.php');

/*
 * ------------------------------------------------------
 *  Instantiate our system
 * ------------------------------------------------------
 */
$System = new \System\Core;


// System is where we initialize any classes and functions that are needed to run the system.
// Bring in user defined settings
require APPLICATION."/config/config.php";

echo ("we are ready ");