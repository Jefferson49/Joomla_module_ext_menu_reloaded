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

// no direct access
defined('_JEXEC') or die('Restricted access'); 
defined('ARI_FRAMEWORK_LOADED') or die('Direct Access to this location is not allowed.');

class AriHtmlHelper 
{
	static function getAttrStr($attrs, $leadSpace = true)
	{
		$str = '';
		
		if (empty($attrs) || !is_array($attrs)) return $str;
		
		$str = array();
		foreach ($attrs as $key => $value)
		{
			if (is_null($value)) continue;
			
			if (is_array($value))
			{
				$subAttrs = array();
				foreach ($value as $subKey => $subValue)
				{
					if (is_null($subValue)) continue;
					
					$subAttrs[] = sprintf('%s:%s',
						$subKey,
						str_replace('"', '\\"', $subValue));
				}
				
				if (count($subAttrs) > 0)
				{
					$str[] = sprintf('%s="%s"',
						$key,
						join(';', $subAttrs));
				}
			}
			else
			{
				$str[] = sprintf('%s="%s"',
					$key,
					str_replace('"', '\\"', $value));
			}
		}
		
		$str = join(' ', $str);
		if (!empty($str) && $leadSpace) $str = ' ' . $str;

		return $str;
	}
	
	static function extractAttrs($htmlEl)
	{
		$attrs = array();
		if (empty($htmlEl))
			return $attrs;
		
		$matches = array();
		$attrRegExp = '/([a-z\_0-9]+)=("[^"]*"|&quot;.*?&quot;|[^\s]*)/i';
		preg_match_all($attrRegExp, $htmlEl, $matches, PREG_SET_ORDER);
		if (is_array($matches))
		{
			foreach ($matches as $match)
			{
				if (isset($match[1]) && isset($match[2])) 
					$attrs[$match[1]] = trim(html_entity_decode($match[2]), '"');
			}
		}

		return $attrs;
	}

	static function extractInlineStyles($style)
	{
		$styles = array();
		$inlineStyles = explode(';', $style);
		if (empty($inlineStyles))
			return $styles;
		
		foreach ($inlineStyles as $inlineStyle)
		{
			@list($key, $value) = @explode(':', $inlineStyle);
			if (!empty($key)) $key = trim($key);
			if (empty($key))
				continue ;
			
			$styles[$key] = @trim($value);
		}
		
		return $styles;
	}

	static function linkifyContent($content, $target = '_blank')
	{
		$content = preg_replace_callback(
			'~(?:([^\s@]+@[^\s]+)|(?:(https?|ftp)://)?([^\s\./]+(?:\.[^\s\./]+)+(?:/[^\s]*)?))(?<![\.,])~i',
			array('AriHtmlHelper', 'linkifyContentCallback'),
			$content);
				
		return str_replace('__LINK_TARGET__', $target, $content);
	}
	
	static function linkifyContentCallback($matches)
	{
		$scheme = !empty($matches[2]) ? $matches[2] : "http"; 
		$url = isset($matches[3]) ? ("${scheme}://" . $matches[3]) : ("mailto:" . $matches[1]);
		$clearUrl = isset($matches[3]) ? $matches[3] : $matches[1];
		$url_escaped = htmlentities($url);
		
		return "<a href=\"$url_escaped\" target=\"__LINK_TARGET__\">$clearUrl</a>";
	}
}
?>