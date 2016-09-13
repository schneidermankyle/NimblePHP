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
 * Config Class
 *
 * @package Nimble PHP
 * @subpackage System\Core 
 * @author Kyle Schneiderman
 */

class NMBL_Config
{
	// This class is responsible for storing and loading all of our configuration and autoload items
	function __construct() {
	}
	
	/**
	 * Class registry
	 *
	 * Member variable for storing configuration keys and values
	 *
	 * @var	string[]	Configuration key => value
	 */

	public $Config = [];

	/**
	 * Class registry
	 *
	 * Member variable for storing autoload classes
	 *
	 * @var	string[]	Autoload class name => location
	 */

	public $Autoload = [];

	/**
	 * Class registry
	 *
	 * Load a configuration file and store it's contents into memory
	 * specifically this function will store anything that belongs to
	 * the config or autoload arrays
	 *
	 * @param	string	the name of the class requested
	 * @param	string	the directory to find class
	 * @return	bool
	 */

	public function &Load($name, $directory = SYSTEM.DIRECTORY_SEPARATOR."core") {
		// First we want to make sure that our class name is set
		if (isset($name) && is_string($name)) {
			// Name is set and we can look in our default directory
			// Also check to see if this file has been loaded already
			if (file_exists($directory.DIRECTORY_SEPARATOR.$name.".php") && !in_array($directory.DIRECTORY_SEPARATOR.$name.".php", get_included_files())) {
				include $directory.DIRECTORY_SEPARATOR.$name.".php";
				
				// Let's check to see if the file actually has any configuration keys
				if (isset($config) && is_array($config)) {
					$this->Config = array_merge($config, $this->Config);
				}

				// Let's see if there are any autoload keys
				if (isset($autoload) && is_array($autoload)) {
					$this->Autoload = array_merge($autoload, $this->Autoload);
				}

				// Everything looks good, let's go ahead and let the caller know
				return true;
			}
		} 
		
		// We had an error, but we really don't want this to be loud, just return false
		return false;
	}


}