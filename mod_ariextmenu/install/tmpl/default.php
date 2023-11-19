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
 * PHP 8 and Joomla 4.x migration
 *
 * @author Jefferson49
 * @link https://github.com/Jefferson49/PHP8_mod_ariextmenu
 * @copyright Copyright (c) 2022 Jefferson49
 * @license GNU/GPL v3.0
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