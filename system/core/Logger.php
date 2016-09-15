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

class NMBL_Logger {
	private $log;

	function __construct($_path){
		// if config is available, set path and open file
		if (isset($_path) && is_string($_path)) {
			// Let's make sure that we format the path
			$_path = $this->formatPath($_path);
			// Then we need to check if it exists

			if (!$this->verifyLog($_path)) {
				$this->createLog($_path);
			} else {
				$this->openLog($_path);
			}
		}
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
	private function &createLog($_path) {
		// Let's make sure we have a path set
		$_path = (isset($_path) && is_string($_path)) ? $this->formatPath($_path) : $this->log;

		// Now we need to make sure that 
		if ( $this->verifyDirectory($_path, true) ) {
			// Let's set the mode, if the file exists, great, if not create it
			$_mode = (!is_writeable($_path)) ? 'w' : 'a+';

			// Attempt to create file, if it cannot open, tell the caller so.
			$_log = fopen($_path, $_mode);
			if (!$_log)
				return false;

			// Write that we created this and close file
			fwrite($_log, 'This log was created on '.date("l jS \of F Y h:i:s A").PHP_EOL);
			fclose($_log);

			// Let's keep track of this log in memory
			$this->log = $_path;

			return true;
		} 
		return false;
	}

	/**
	 * Class registry
	 *
	 * Simply takes an input string and manages opening, writing and closing
	 * stream
	 *
	 * @param	string	The string of which is to be logged
	 * @return	bool
	 */
	private function &writeToLog($_string) {
		// as always, make sure this is proper data
		if (isset($_string) && is_string($_string)) {

			// Lets try to open and ensure the log is good, write then close
			$_log = fopen($this->log, 'a+');
			if (!$_log) 
				return false;

			fwrite($_log, $_string);
			fclose($_log);

			return true;
		} return false;
	}

	/**
	 * Class registry
	 *
	 * Checks if the string is already a valid path, if not, it will build
	 * a path in relation to root application.
	 *
	 * @param	string	(Optional) The path at which log should be created
	 * @return	string
	 */
	private function &formatPath($_path) {
		// First let's make sure what is passed in is valid
		if (isset($_path) && is_string($_path)) {
			// Now we need to check if it is already valid
			if (strpos($_path, ROOT) === false) 
				return ROOT.substr($_path, 1);

			// Since this isn't a good path, let's format it with regards to root
			return $_path;
		}
	}

	/**
	 * Class registry
	 *
	 * Checks to see if the log directory does exist, if and and create is
	 * set true, then go ahead and make it.
	 *
	 * @param	string	(Optional) The path at which log should be created
	 * @return	bool
	 */
	private function &verifyDirectory($_path, $_create = false) {;
		// Ensure that we are working with valid data
		if (isset($_path) && is_string($_path)) {
			$_length = (strrpos($_path, '/')) ? strrpos($_path, '/') : strrpos($_path, '\\');

			// now lets grab the directory out of this path
			$_path = substr($_path, 0, $_length);

			// Let's now check to see if this is a valid directory
			if(!is_dir($_path)) {

				// So it isn't do you want us create you one?
				if ($_create === false)
					return false;

				// Let's try to create the new 
				if (!mkdir($_path)) 
					return false;

				// Looks good otherwise
				return true;
			} 

			// This this directory already exists, let's let the caller know
			return true;
		}
	}

	/**
	 * Class registry
	 *
	 * Takes an array and builds a formatted string for log output
	 *
	 * @param	string	(Optional) The path at which log should be checked
	 * @return	bool
	 */
	private function parseArray($_array) {
		$_string;
		// make sure that our data is set and valid
		if (isset($_array) && is_array($_array)) {
			// Loop through our array
			foreach ($_array as $_key => $_value) {
				$_key = (is_string($_key)) ? $_key.': ' : '';

				if (is_array($_value)) {
					$_string .= $_key.$this->parseArray($_value);
				} else if (is_string($_value)){
					$_string .= $_key.$_value.PHP_EOL;
				}
			}

			return $_string;
		}
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
	private function &verifyLog($_path) {
		// Let's make sure we have the path we are looking for
		$_path = (isset($_path) && is_string($_path)) ? $this->formatPath($_path) : $this->path;

		// Just check real quick that this log does exist as it should
		if (is_file($_path) && file_exists($_path))
			return true;

		return false;
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
		// As always, check to ensure 
		if (isset($_path) && is_string($_path)) {
			// Format the path
			$_path = $this->formatPath($_path);
			// Does this path exist
			if ($this->verifyLog($_path) && isset($_overWrite) && $_overWrite != true) {
				// One exists, we have to see if we should overwrite.
				return false;
			}

			return $this->createLog($_path);
		} return false;
	}

	/**
	 * Class registry
	 *
	 * Opens a new log into memory. First we must verify that 
	 * the log exists and is accessable, then it will store 
	 * the open log path as a member variable
	 *
	 * @param	string	The path at which log is to be opened
	 * @return	bool
	 */
	public function OpenLog($_path) {
		// Quickly ensure that the path is set and proper
		if (isset($_path) && is_string($_path)) {
			// then let's make sure it is formatted
			$_path = $this->formatPath($_path);
			// Then let's make sure that it is a proper 
			if ($this->verifyLog($_path)) {
				// Then go ahead and set it to memory
				$this->log = $_path;
				// let the caller know
				return true;
			} return false;
		} return false;
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
		// Ensure that we are writing valid data
		if (isset($_message)) {
			// We need to verify if message is an array or string
			$_message = (is_array($_message)) ? date("dMy H:i:s").PHP_EOL."--- Output of array ---".PHP_EOL.$this->parseArray($_message)."--- END OF OUTPUT ---".PHP_EOL : date("dMy H:i:s: ").$_message.PHP_EOL;
			$_trace = (isset($_stackTrace) && $_stackTrace) ? PHP_EOL."--- STACK TRACE ---".PHP_EOL.$this->parseArray(debug_backtrace())."--- END OF TRACE ---".PHP_EOL.PHP_EOL : '';
			if ($this->writeToLog($_message.$_trace))
				return true;

			// If we are here, something hasn't worked.
			return false;

		} return false;
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