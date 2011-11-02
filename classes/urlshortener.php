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
 
namespace Urlshortener;

class NotFoundException extends \Fuel_Exception {}

class Urlshortener
{
	
	/**
	 * Urlshortener driver forge.
	 *
	 * @param	array			$config		config array
	 */
	public static function forge(array $config = array())
	{				
		empty($config['driver']) and $config['driver'] = \Config::get('urlshortener.default_account', 'bitly');
		
		$setup = \Config::get('urlshortener.accounts.'.$config['driver'], array());
		
		$config = \Arr::merge($setup, $config);
		
		$driver = '\\Urlshortener_Driver_'.ucfirst(strtolower($config['driver']));
		
		if( ! class_exists($driver, true))
		{
			throw new \FuelException('Could not find Urlshortener driver: '.$config['driver']. ' ('.$driver.')');
		}
		
		$driver = new $driver($config);
				
		return $driver;
	}
	
	/**
	 * Init, config loading.
	 */
	public static function _init()
	{
		\Config::load('urlshortener', true);
	}
}
