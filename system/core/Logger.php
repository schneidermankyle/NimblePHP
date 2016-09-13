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

namespace System\Core;

defined("SYSTEM") or exit("Error direct access not allowed");

/**
 * Logging Class
 *
 * @package		Nimble PHP
 * @subpackage	Core
 * @author		Kyle Schneiderman
 */

class Logger {
	private $path;
	private $log;

	function __construct(){
		// if config is available, set path and open file
	}

	/**
	 * Class registry
	 *
	 * Will create log at the specified path, if not path is 
	 * provided, will default to the system configuration 
	 * setting.
	 *
	 * @param	string	(Optional) The path at which log should be created
	 * @return	bool
	 */
	private function createLog($_path) {
		$path = (isset($path) && is_string($path)) ? $path : $this->log;
	}

	/**
	 * Class registry
	 *
	 * Ensures that the currently loaded log file, or the log file provided
	 * can indeed be written to, then returns results
	 *
	 * @param	string	(Optional) The path at which log should be checked
	 * @return	bool
	 */
	private function verifyLog($_path) {
		// return results
	}

	/**
	 * Class registry
	 *
	 * Creates a new logfile at the given path, if file already
	 * exists, checks if we should overwrite, if so, do so, if 
	 * returns false
	 *
	 * @param	string	The path at which log is to be created
	 * @param	boot	If file exists, overwrite?
	 * @return	bool
	 */
	public function NewLog($_path, $_overWrite = false) {

	}

	/**
	 * Class registry
	 *
	 * Opens a new log into memory. First we must verify that 
	 * the log exists and is accessable, then it will store 
	 * the open log steram as a member variable
	 *
	 * @param	string	The path at which log is to be opened
	 * @return	bool
	 */
	public function OpenLog($_path) {

	}

	/**
	 * Class registry
	 *
	 * Logs the current message to the open log file. This will
	 * accept either a string or array of strings to be written
	 * to the currently opened log file. We optionally can 
	 * include a stacktrace if we should choose to do so
	 *
	 * @param	string or string[]	The message to be logged
	 * @param 	bool (optional) Should we include a stacktrace
	 * @return	bool
	 */
	public function Log($_message, $_stackTrace = false) {

	}

	/**
	 * Class registry
	 *
	 * Dumps the currently opened log into an output stream.
	 * Currently output can be set to one of two options:
	 * 1) output stream directly on page 
	 * 2) return output as a string 
	 *
	 * @param	string 	The format of the output 
	 * @return	string
	 */
	public function DisplayLog($_output) {

	}

}