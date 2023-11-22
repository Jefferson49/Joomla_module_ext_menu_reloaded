<?php
/*
 * ARI Ext menu
 *
 * @package		ARI Ext Menu
 * @version		1.0.0
 * @author		ARI Soft
 * @copyright	Copyright (c) 2009 www.ari-soft.com. All rights reserved
 * @license		GNU/GPL (http://www.gnu.org/copyleft/gpl.html)
 *
 * PHP 8 and Joomla 4.x migration
 *
 * @author Jefferson49
 * @link https://github.com/Jefferson49/PHP8_mod_ariextmenu
 * @copyright Copyright (c) 2022 Jefferson49
 * @license GNU/GPL v3.0
 */

use Joomla\CMS\Form\Field\ListField;
use Joomla\CMS\Factory;

defined('_JEXEC') or die ('Restricted access');

require_once dirname(__FILE__) . '/../kernel/class.AriKernel.php';

AriKernel::import('Web.JSON.JSONHelper');

class JElementColor extends ListField
{
	var	$_name = 'Color';

	function fetchElement($name, $value, &$node, $control_name)
	{
		$this->_includeAssets();

		$rgbColor = $this->_parseColor($value);
		$uri = $this->_getRootAssetsUri();
		$document =& Factory::getDocument();
		$document->addScriptDeclaration(
			sprintf('window.addEvent("domready", function(){ var opt = %2$s; opt.onComplete = function(color) { $("%1$s").value = color.hex; }; new MooRainbow("%1$s", opt); });',
				$control_name . $name,
				AriJSONHelper::encode(
					array(
						'wheel' => true, 
						'imgPath' => $uri . 'images/', 
						'id' => uniqid('cp_'),
						'startColor' => $rgbColor
					))));
				
		return '<input type="text" name="' . $control_name . '[' . $name .']" id="' . $control_name . $name . '" value="' . $value . '" size="10" readonly="readonly" onclick="$(window).scrollTo($(window).getScrollLeft(), $(this).getTop());" /> [<a href="javascript:void(0);" onclick="$(\'' . $control_name . $name . '\').value = \'\'; return false;">Clear</a>]'; 
	}

	function _parseColor($color)
	{
		$rgb = array(0, 0, 0);

		if (empty($color))
			return $rgb;
			
		$color = preg_replace('/[^A-F0-9]/i', '', $color);
		$len = strlen($color);
		if ($len != 3 && $len != 6)
			return $rgb;
			
		if ($len == 3)
			$color = preg_replace('/./', '$0$0', $color);
		
		$rgb[0] = hexdec(substr($color, 0, 2));
		$rgb[1] = hexdec(substr($color, 2, 2));
		$rgb[2] = hexdec(substr($color, 4, 2));
		
		return $rgb;
	}
	
	function _includeAssets()
	{
		static $loaded;
		
		if ($loaded)
			return ;
			
		$uri = $this->_getRootAssetsUri();
			
		$document =& Factory::getDocument();
		$document->addScript($uri . 'mooRainbow.js');
		$document->addStyleSheet($uri . 'mooRainbow.css', array('type' => 'text/css'), array());
			
		$loaded = true;
	}
	
	function _getRootAssetsUri()
	{
		static $uri;
		
		if (!is_null($uri))
			return $uri;
		
		$filePath = str_replace(DS == '\\' ? '/' : '\\', DS, dirname(__FILE__));
		if (strlen(JPATH_ROOT) > 1)
			$filePath = str_replace(JPATH_ROOT, '', $filePath);
			
		$uri = JURI::root(true) . str_replace(DS, '/', $filePath) . '/color/';
		
		return $uri;
	}
}
?>