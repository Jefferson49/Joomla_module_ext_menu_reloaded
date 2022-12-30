<?php
/*
 * ARI Framework Lite
 *
 * @package		ARI Framework Lite
 * @version		1.0.0
 * @author		ARI Soft
 * @copyright	Copyright (c) 2009 www.ari-soft.com. All rights reserved
 * @license		GNU/GPL (http://www.gnu.org/copyleft/gpl.html)
 * 
 * PHP 8 migration
 *
 * @author		Markus Hemprich, 
 * @copyright	Copyright (C) 2022 Markus Hemprich
 *              <http://www.familienforschung-hemprich.de>
 * @license		GNU/GPLv3 (https://www.gnu.org/licenses/gpl-3.0.html)
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 
defined('ARI_FRAMEWORK_LOADED') or die('Direct Access to this location is not allowed.');

AriKernel::import('Web.JSON.JSON');

class AriJSONHelper
{
	static function encode($data)
	{
		$jsonHandler =& AriJSONHelper::_getJSONHandler();
		
		return $jsonHandler->encode($data);
	}
	
	static function decode($str)
	{
		if (empty($str)) return null;
		
		$jsonHandler =& AriJSONHelper::_getJSONHandler();
		
		return $jsonHandler->decode($str);
	}
	
	static function &_getJSONHandler()
	{
		static $jsonHandler = null;
		
		if (is_null($jsonHandler))
		{
			$jsonHandler = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
		}

		return $jsonHandler;
	}
}
?>