<?php
/**
 * A driver-based URL Shortener package for FuelPHP
 *
 * @package		Urlshortener
 * @version		1.1
 * @author		Rob McCann (rob@robmccann.co.uk)
 * @license		MIT License
 * @copyright	2011 Rob McCann
 * @link		http://github.com/unforeseen/fuel-urlshortener
 */
 
Autoloader::add_core_namespace('Urlshortener');

Autoloader::add_classes(array(
	/**
	 * Urlshortener classes.
	 */
	'Urlshortener\\Urlshortener'							=> __DIR__.'/classes/urlshortener.php',
	'Urlshortener\\Urlshortener_Driver'					=> __DIR__.'/classes/urlshortener/driver.php',
	'Urlshortener\\Urlshortener_Driver_Bitly'				=> __DIR__.'/classes/urlshortener/driver/bitly.php',
	
	/* Exceptions */
	'Urlshortener\\NotFoundException'							=> __DIR__.'/classes/urlshortener.php',
));
