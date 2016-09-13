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

Namespace System\Core;

defined('SYSTEM') OR exit('Error direct access not allowed');

/**
 * Exceptions Class
 *
 * @package Nimble PHP
 * @subpackage System\Core 
 * @author Kyle Schneiderman
 */

class NMBL_Exceptions
{
	
	
	function __construct()
	{
		# code...
	}

	private $status = array(
				// HTTP Response Codes
				// Information responses
				100 => 'Continue',
				101 => 'Switching Protocol',
				// Successful responses
				200 => 'Ok',
				201 => 'Created',
				202 => 'Accepted',
				203 => 'Non-Authoritative Information',
				204 => 'No Content',
				205 => 'Reset Content',
				206 => 'Partial Content',
				// Redirection messages
				300 => 'Multiple Choice',
				301 => 'Moved Permanently',
				302 => 'Found',
				303 => 'See Other',
				304 => 'Not Modified',
				305 => 'Use Proxy',
				307 => 'Temporary Redirect',
				308 => 'Permanent Redirect',
				// Client error messages
				400 => 'Bad Request',
				401 => 'Unauthorized',
				402 => 'Payment Required',
				403 => 'Forbidden',
				404 => 'Not Found',
				405 => 'Method Not Allowed',
				406 => 'Not Acceptable',
				407 => 'Proxy Authentication Required',
				408 => 'Request Timeout',
				409 => 'conflict',
				410 => 'Gone',
				411 => 'Length Required',
				412 => 'Precondition Failed',
				413 => 'Payload Too Large',
				414 => 'URI Too Large',
				415 => 'Unsupported Media Type',
				416 => 'Requested Range Not Satisfiable',
				417 => 'Expectation Failed',
				421 => 'Misdirected Request',
				426 => 'Upgrade Required',
				428 => 'Precondition Required',
				429 => 'Too Many Requests',
				431 => 'Request Header Fields Too Large',
				451 => 'Unavailable For Legal Reasons',
				// Server error messages
				500 => 'Internal Server Error',
				501 => 'Not Implemented',
				502 => 'Bad Gateway',
				503 => 'Service Unavailable',
				504 => 'Gateway Timeout',
				505 => 'HTTP Version Not Supported',
				506 => 'Variant Also Negotiates',
				507 => 'Variant Also Negotiates',
				511 => 'Network Authentication Required',
				// Custom NIMBLE Application Errors
				600 => 'Error With No Description Provided',
				601 => 'Method Input Expected'
			);

	/**
	 * Class registry
	 *
	 * Looks for HTTP response message via error code
	 *
	 * @param	int		(Optional) Error code you wish to display
	 * @return	string
	 */
	private function getMessage($code) {
		// Ensure that a code is infact set, otherwise this is for nothing
		if (isset($code) && $this->status[$code]) {
			// Then go ahead and return that message
			return $this->status[$code];
		} else {
			// Let the caller know that no message was found.
			return null;
		}
	}

	/**
	 * Class registry
	 *
	 * Displays an error at beginning of page, can optionally
	 * stop script from executing on rest of page. If perameters
	 * are empty, will display a simple message letting the user
	 * know there was an unkown error
	 *
	 * @param	int		(Optional) Error code you wish to display
	 * @param	string 	(Optional) The message you would like displayed		
	 * @param	bool	(Optional) If set, stops page from executing
	 * @return	void
	 */
	public function DisplayMessage() {

	}

	/**
	 * Class registry
	 *
	 * Displays an error at beginning of page, can optionally
	 * stop script from executing on rest of page. If perameters
	 * are empty, will display a simple message letting the user
	 * know there was an unkown error
	 *
	 * @param	int		(Optional) Error code you wish to display
	 * @param	string 	(Optional) The message you would like displayed		
	 * @param	bool	(Optional) If set, stops page from executing
	 * @return	void
	 */
	public function DisplayError($code = 600, $message = "", $exit = false) {
		// The first thing we need to figure out is if this is a specific error
		if (isset($code) && $code) {
			// this means we need to figure out our message.
			$message = ($message) ? $message : $this->getMessage($code);
			// If code isn't in registery and no message was provided, then output default
			if (!$message)
				$message = $this->getMessage(600);
		} else {
			// If there is no code, this means a null or empty value was passed in
			$code = 601;
			$message = $this->getMessage($code);
		}

		if (true == false) {
			// Let's check to see if template is available.
			// Templater should be a static class in the system
		} else {
			// We need to make a quick and dirty string
			$output = "<h2>Error ".$code."</h2><p>The following runtime error was encountered: ".$message."</p>";
		}

		// Then we need to go ahead and display the error.
		echo ($output);
		if ($exit) {
			exit($code);
		}
		
	}

	/**
	 * A quick function for setting our header and output messages
	 *
	 * @param	(int) HTTP status code
	 * @param	(string) Text to be displayed with the error
	 * @return	void
	 */
	public function &SetStatus($code = 200, $text = '') {
		if (empty($code)) {
			// We need to exit and display or log an error, return to this.
		}

		if (empty($text)) {
			if (isset($this->status[$code])) {
				$text = $this->status(intval($code));
			} else {
				// Error, we need a proper status code
			}
		}

		header('Status: '.$code.' '.$text, true);

	}
}