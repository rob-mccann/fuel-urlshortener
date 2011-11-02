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
 
return array(

	/**
	 * Default setup group
	 */
	'default_account' => 'bitly',

	/**
	 * Setup groups
	 */
	'accounts' => array(
		'bitly' => array(
			'api_key' 	=> '',
			'login'		=> ''
		),
	),

);
