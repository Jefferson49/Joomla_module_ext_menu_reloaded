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
?>

<div id="<?php echo $menuId; ?>_container" class="ux-menu-container ux-menu-clearfix">
<?php
AriTemplate::display(
	dirname(__FILE__) . DIRECTORY_SEPARATOR . 'menu.php', 
	array(
		'menuId' => $menuId,
		'menu' => $menu,
		'menuStartLevel' => $menuStartLevel,
		'menuEndLevel' => $menuEndLevel,
		'menuLevel' => $menuLevel,
		'menuDirection' => $menuDirection,
		'hlCurrentItem' => $hlCurrentItem,
		'hlOnlyActiveItems' => $hlOnlyActiveItems,
		'activeTopId' => $activeTopId,
		'parent' => 0,
		'parentActiveTopId' => $parentActiveTopId
	)
);
?>
</div>