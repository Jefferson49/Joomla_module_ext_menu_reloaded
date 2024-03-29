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
 * 
 * PHP 8 and Joomla 4.x/5.x migration
 * 
 * @author Jefferson49
 * @link https://github.com/Jefferson49/Joomla_module_ext_menu_reloaded
 * @copyright Copyright (c) 2022-2024 Jefferson49
 * @license GNU/GPL v3.0
 *  
 */

use Joomla\CMS\Object\CMSObject;
use Joomla\CMS\Uri\Uri;

// no direct access
defined('_JEXEC') or die('Restricted access');
defined('ARI_FRAMEWORK_LOADED') or die('Direct Access to this location is not allowed.');

class AriSortUtils extends CMSObject
{
	var $_key;
	var $_dir;
	
	function __construct($key, $dir = 'asc')
	{
		$this->_key = $key;
		$this->_dir = strtolower($dir);
	}
	
	function sort($a, $b)
	{
		$res = strcmp($a[$this->_key], $b[$this->_key]);
		
		return $this->_dir == 'asc' 
			? $res
			: -$res;
	}
}

class AriUtils extends CMSObject
{
	static function sortAssocArray($data, $key, $dir = 'asc')
	{
		$sort = new AriSortUtils($key, $dir);
		usort($data, array(&$sort, 'sort'));
		
		return $data;
	}
	
	static function parseValueBySample($str, $sample)
	{
		return AriUtils::parseValue($str, gettype($sample));
	}
	
	static function parseValue($str, $type)
	{
		$retVal = $str;
		switch ($type)
		{
			case 'boolean':
				if (is_null($str))
				{
					$retVal = false;
				}
				else
				{
					$str = strtolower(trim($str));
					if ($str == 'true' || $str == 'false')
					{
	                	$retVal = ($str == 'true');
					}
					else
					{
						$retVal = !empty($str);
					}
				}
                break;

            case 'NULL':
                $retVal = null;
                break;

            case 'integer':
                $retVal = intval($str, 10);
                break;

            case 'double':
            case 'float':
                $retVal = floatval($str);
                break;
		}
		
		return $retVal;
	}
	
	static function getValue($val, $emptyValue)
	{
		return !empty($val) ? $val : $emptyValue;
	}
	
	static function getParam($arr, $name, $defValue = null)
	{
		$retValue = $defValue;
		
		if (is_array($arr) && isset($arr[$name]))
		{
			$retValue = $arr[$name];
		}
		else if (is_object($arr) && isset($arr->{$name}))
		{
			$retValue = $arr->{$name};
		}

		return $retValue;
	}
	
	static function getFilteredParam($arr, $name, $defValue = null, $filterMask = 0)
	{
		$param = AriUtils::getParam($arr, $name, $defValue);
		
		return $param;
	}

	static function generateUniqueId()
	{
        mt_srand ((float) microtime() * 1000000);
        $key = mt_rand();

        return md5($key);
	}

	static function resolvePath($path)
	{
		if (!defined("JPATH_ROOT") || strlen(JPATH_ROOT) == 1 || strpos($path, JPATH_ROOT) !== 0)
			$path = JPATH_ROOT . '/' . $path;
		
		return $path;
	}

	static function absPath2Url($path)
	{
		$absPath = str_replace('\\', '/', JPATH_ROOT);
		$path = str_replace('\\', '/', $path);

		if ($absPath != '/')
		{
			if (strstr($path, $absPath) !== 0)
			{
				$correctedParts = array();
				$absPathParts = explode('/', $absPath);
				$pathParts = explode('/', $path);
				for ($i = 0; $i < count($absPathParts) && $i < count($pathParts); $i++)
				{
					if ($absPathParts[$i] != $pathParts[$i])
						break;
						
					$correctedParts[]= $absPathParts[$i]; 
				}
				$absPath = implode('/', $correctedParts);
			}

			$path = str_replace($absPath, Uri::root(true), $path);
		}
		else
		{
			$path = Uri::root(true) . $path;
		}
		
		return $path;
	}
	
	static function absPath2Relative($path)
	{
		$absPath = str_replace('\\', '/', JPATH_ROOT);
		$path = str_replace('\\', '/', $path);
		if ($absPath != '/')
		{
			$path = str_replace($absPath, '', $path);
		}
		
		if (strpos($path, '/') === 0) $path = substr($path, 1);
		
		return $path;
	}
	
	static function isRemoteResource($link)
	{
		if (empty($link))
			return false;
			
		return preg_match('/(https?|ftp):\/\/.+/', $link);
	}
}
?>