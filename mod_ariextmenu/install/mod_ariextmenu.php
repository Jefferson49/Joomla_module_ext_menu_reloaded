<?php
/*
 * ARI Ext menu Joomla! module
 *
 * @package		ARI Ext Menu Joomla! module.
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
 * @copyright Copyright (c) 2022-2023 Jefferson49
 * @license GNU/GPL v3.0
 *  
 */
 
use Joomla\CMS\Helper\ModuleHelper;

defined('_JEXEC') or die('Restricted access');

require_once dirname(__FILE__) . '/mod_ariextmenu/kernel/class.AriKernel.php';

AriKernel::import('Utils.Utils');
AriKernel::import('Menu.Menu');
AriKernel::import('Web.HtmlHelper');
AriKernel::import('ExtMenu.ExtMenu');
AriKernel::import('Template.Template');

$menu = new AriMenu($params->get('menutype', 'mainmenu'));
$menuLevel = $menuStartLevel = intval($params->get('startLevel', 0), 10);
$menuEndLevel = intval($params->get('endLevel', 0), 10);

$uniqueId = (bool)$params->get('uniqId', false);
$activeMenuItem = $menu->getActive();

// Template parameters
$menuDirection = $params->get('direction');
$menuId = !$uniqueId ? 'ariext' . $module->id : uniqid('aext', false);
$hlCurrentItem = (bool)$params->get('highlightCurrent', true) && !is_null($activeMenuItem);
$hlOnlyActiveItems = (bool)$params->get('onlyActiveItems', false);
$parentActiveTopId = $activeTopId = $activeMenuItem ? $activeMenuItem->id : 0;

if ($parentActiveTopId > 0 && ((J1_5 && $menuStartLevel > 0) || (!J1_5 && $menuStartLevel > 1)))
{
	$parentParam = ARI_MENU_PARENT_PARAM;
	$levelParam = ARI_MENU_LEVEL_PARAM;
	$parentActive = $menu->getItem($activeMenuItem->$parentParam);
	if ($parentActive)
	{
		while ($parentActive->$levelParam > 0 && $parentActive->$levelParam >= $menuStartLevel)
		{
			$parentActive = $menu->getItem($parentActive->$parentParam);
		}
	
		$parentActiveTopId = $parentActive->id;
	}
}

AriExtMenuHelper::initMenu($menuId, $params);

require ModuleHelper::getLayoutPath('mod_ariextmenu');