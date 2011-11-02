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

class Urlshortener_Driver_Bitly extends Urlshortener_Driver
{
	/**
	 * @return	bool	short url string
	 */
	protected function _shorten($url)
	{
		$curl = \Request::forge('http://api.bitly.com/v3/shorten', array(
			'driver' => 'curl',
			'method' => 'get',
			'params' => array(
				'format' => 'json',
				'apikey' => \Config::get('urlshortener.accounts.bitly.api_key'),
				'login' => \Config::get('urlshortener.accounts.bitly.login'),
				'longurl' => $url
			)
		));

		$response = $curl->execute()->response();		
		if (intval($response->status / 100) != 2) 
		{
			throw new \Fuel_Exception('There was a problem shortening the url ('.$response->status.')');
		}
		$data = json_decode($response->body);
		switch($data->status_code)
		{
			case 200:
			case 201:
				return $data->data->url;
				break;
			case 500:
			case 401:
				throw new \Fuel_Exception('Please set your bit.ly API key and login name in the config ('.$data->status_code.')');
				break;
			default:
				throw new \Fuel_Exception('There was a problem shortening the url ('.$data->status_code.')');
		}
		
		return false;		
	}
	
	/**
	 * @return	bool	long url String
	 */
	protected function _expand($url)
	{
		$curl = \Request::forge('http://api.bitly.com/v3/expand', array(
			'driver' => 'curl',
			'method' => 'get',
			'params' => array(
				'format' => 'json',
				'apikey' => \Config::get('urlshortener.accounts.bitly.api_key'),
				'login' => \Config::get('urlshortener.accounts.bitly.login'),
				'shorturl' => $url
			)
		));

		$response = $curl->execute()->response();		
		
		if (intval($response->status / 100) != 2) 
		{
			throw new \Fuel_Exception('There was a problem expanding the url ('.$response->status.')');
		}
		
		$data = json_decode($response->body);
		
		switch($data->status_code)
		{
			case 200:
			case 201:
				$expanded = current($data->data->expand);
				if( isset($expanded->error) )
				{
					if( $expanded->error == 'NOT_FOUND' )
						throw new NotFoundException('The short url could not be expanded because it doesn\'t exist');
						
					throw new \Fuel_Exception('There was a problem expanding the url ('.$expanded->error.')');
				}
				else
				{
					return $expanded->long_url;
				}
				break;
			case 500:
			case 401:
				throw new \Fuel_Exception('Please set your bit.ly API key and login name in the config ('.$data->status_code.')');
				break;
			default:
				throw new \Fuel_Exception('There was a problem expanding the url ('.$data->status_code.')');
		}
		
		return false;	
	}
}
