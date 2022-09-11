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

defined('ARI_FRAMEWORK_LOADED') or die('Direct Access to this location is not allowed.');

class AriTemplate
{
	static function display($template, $params = array())
	{	
		include $template;
	}
}
?>