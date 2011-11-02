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

abstract class Urlshortener_Driver
{
	/**
	 * Driver config
	 */
	protected $config = array();

	/**
	 * Driver constructor
	 *
	 * @param	array	$config		driver config
	 */
	public function __construct(array $config)
	{
		$this->config = $config;
	}

	/**
	 * Get a driver config setting.
	 *
	 * @param	string		$key		the config key
	 * @return	mixed					the config setting value
	 */
	public function get_config($key, $default = null)
	{
		return \Arr::get($this->config, $key, $default);
	}

	/**
	 * Set a driver config setting.
	 *
	 * @param	string		$key		the config key
	 * @param	mixed		$value		the new config value
	 * @return	object					$this
	 */
	public function set_config($key, $value)
	{
		\Arr::set($this->config, $key, $value);

		return $this;
	}

	/**
	 * Initiates the shorten process.
	 *
	 * @return	bool	success boolean
	 */
	public function shorten($url = null)
	{
		// Send
		return $this->_shorten($url);
	}
	
	/**
	 * Initiates the expand process.
	 *
	 * @return	bool	success boolean
	 */
	public function expand($url = null)
	{
		// Send
		return $this->_expand($url);
	}

	/**
	 * Shortens the url
	 *
	 * @return	bool	success boolean
	 */
	abstract protected function _shorten($url);

	/**
	 * gets the longurl for a shorturl
	 *
	 * @return	bool	success boolean
	 */
	abstract protected function _expand($url);
}
