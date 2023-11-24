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
 * @link https://github.com/Jefferson49/PHP8_mod_ariextmenu
 * @copyright Copyright (c) 2022-2023 Jefferson49
 * @license GNU/GPL v3.0
 *  
 */
 
use Joomla\CMS\Language\Text;
use Joomla\CMS\Form\FormField;

defined('_JEXEC') or die ('Restricted access');

jimport('joomla.html.html');
jimport('joomla.form.formfield');

class JFormFieldHeader extends FormField
{
	protected $type = 'Header';

	function getInput()
	{
		return $this->fetchElement($this->element['name'], $this->value, $this->element, $this->name);
	}
	
	function fetchElement($name, $value, &$node, $control_name)
	{
		$color = (string)$node['color'] ? (string)$node['color'] : '#FFF';
		$bgColor =  (string)$node['bgcolor'] ? (string)$node['bgcolor'] : '#7CC4FF'; 
		
		$options = array(Text::_($value));
		foreach ($node->children() as $option)
		{
			$options[] = $option->data();
		}
		
		return sprintf('<div style="float: left; width: 100%%; font-weight: bold; font-size: 120%%; color: ' . $color . '; background-color: ' . $bgColor . '; padding: 2px 0; text-align: center;">%s</div>', call_user_func_array('sprintf', $options));
	}
}
?>