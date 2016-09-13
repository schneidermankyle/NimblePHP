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
namespace System;

defined('SYSTEM') OR exit('Error direct access not allowed');

/**
 * Core Class
 *
 * @package Nimble PHP
 * @subpackage System
 * @author Kyle Schneiderman
 */

class Core {


	function __construct() {
		// We will always need this config class
		$this->LoadClass("Config", "Core");
		// and will always want to load this particular system settings.
		$this->Config->Load("settings");
		// Lastly we will always want to call autoload to ensure that the 
		// proper classes are loaded from the start
		$this->Autoload();
	}

	/**
	 * Class registry
	 *
	 * This function attempts to find the requested class first in memory
	 * then it will look to load the class from file in the default system
	 * libraries directory. If it cannot find it there, it will look into 
	 * the application library.
	 *
	 * @param	string	the name of the class requested
	 * @param	string	the directory to find class
	 * @param	string	the namespace of the class being called
	 * @param	string	optional parameter to pass to class
	 * @return	object
	 */
	public function &LoadClass($name, $directory = 'libraries', $namespace = "\System\Core\\", $parameters = null) {
		static $_classes = [];

		// We will use this to reference the classname and status
		$loaded = false;

		// If this class is in memory, move along
		if (isset($_classes[$name])) {
			return $_classes[$name];
		}

		// We need to check to make sure that something else did not already try to inject
		// a class into our system
		if (class_exists("NMBL_".$name, false) === false) {
			// Otherwise, we need to look into default directories.
			foreach(array(SYSTEM, APPLICATION) as $location) {
				// We will always look at the system first, if we find the library
				// there, we want to just include that one.
				if ($loaded === true) {
					break;
				}

				// Since there is no class available and we haven't loaded a class yet
				// Let's check to see if the file exists.
				if (file_exists($location.$directory.DIRECTORY_SEPARATOR.$name.'.php')) {
					require_once($location.$directory.DIRECTORY_SEPARATOR.$name.'.php');
					$loaded = true;
				}
			}
		} else {
			// The class has already been loaded, let's go ahead and let the developer know
			echo "Class ".$name." already exists, please ensure you are only loading this class once";
			exit();
		}

		if ($loaded === false) {
			// We made it through our directory search and still found nothing, let's end this now
			echo "Error, class ".$name." could not be found, please ensure the class exists in the specified directory";
			exit();
		}

		// Since we are prefixing every class with our NMBL id, let's ensure 
		// that we are calling the correct class.
		$class = $namespace."NMBL_".$name;

		// We need to go ahead and put the class into memory.
		$_classes[$name] = isset($parameters) ? new $class($parameters) : new $class();
 
		$this->{$name} = $_classes[$name];
	}

	/**
	 * Class registry
	 *
	 * This function acts as an interface to the exceptions library in 
	 * order to handle exceptions in namespaces where exceptions object
	 * may not be available
	 *
	 * @param	string	the name of the class requested
	 * @param	int		the error code to be displayed
	 * @param	string	the heading text
	 * @return	object
	 */

	public function &LoadFile() {

		// This is to just load a file into memory. 
		
		echo ('<br/>This was from Core<br/>');
	}

	/**
	 * Class registry
	 *
	 * Autoload will loop through Config object and load classes automatically
	 *
	 * @return	void
	 */
	public function &Autoload() {
		// First we need to check to see that our autoload file is there
		if (isset($this->Config) && is_object($this->Config)) {
			// First we need to grab our key type to ensure we are pulling from 
			// the correct directory
			foreach ($this->Config->Autoload as $_type => $_array) {
				// Now let's loop through the child array
				if (is_array($_array)) {

					foreach ($_array as $_class) {
						// If this is an array, it means we have a non std location
						$_location = (is_array($_class)) ? $_class[1] : $_type;
						$_name = (is_array($_class)) ? $_class[0] : $_class;

						$this->LoadClass($_name, $_location); // This ignores namepsace, a problem we must fix!
					}	
				} else {
					// We had some invalid type being passed in log it
					break;
				}
			}
		}
	}




}