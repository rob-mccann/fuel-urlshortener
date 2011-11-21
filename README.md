# Fuel Url Shortener Package.

A driver-based url shortener package for FuelPHP

# Summary

* Driver-based shortening and expanding of urls (poss. more features to follow)
* Includes bit.ly driver. If you create more, pull request and I'll include them :)

# Usage

Make sure you copy the config file from fuel/packages/fuel-urlshortener/config/urlshortener.php into fuel/app/config/urlshortener.php before you implement this

	//create the shortener
	$shortener = \Urlshortener\Urlshortener::forge(array('driver'=>'bitly'));
	
	//shorten a url
	$short_url = $shortener->shorten('http://robmccann.co.uk');
	
	//expand a shortened url to get its long url
	$expanded_url = $shortener->expand('http://robm.cc/lyiAk0');

# Exceptions

	+ NotFoundException, thrown when expanding a short url and the short url doesn't exist
	+ Fuel_Exception, thrown there is a problem with the config or api, see getMessage() for more info

