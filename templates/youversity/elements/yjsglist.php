<?php
/*======================================================================*\
|| #################################################################### ||
|| # Package - Joomla Template based on YJSimpleGrid Framework          ||
|| # Copyright (C) 2010  Youjoomla LLC. All Rights Reserved.            ||
|| # Authors - Dragan Todorovic and Constantin Boiangiu                 ||
|| # license - PHP files are licensed under  GNU/GPL V2                 ||
|| # license - CSS  - JS - IMAGE files  are Copyrighted material        ||
|| # bound by Proprietary License of Youjoomla LLC                      ||
|| # for more information visit http://www.youjoomla.com/license.html   ||
|| # Redistribution and  modification of this software                  ||
|| # is bounded by its licenses                                         ||
|| # websites - http://www.youjoomla.com | http://www.yjsimplegrid.com  ||
|| #################################################################### ||
\*======================================================================*/

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

/**
 * Renders a text element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JFormFieldYJSGList extends JFormFieldList
{
	public function getInput()
	{
		$class = ( $this->element['class'] ? 'class="'.$this->element['class'].'"' : 'class="inputbox"' );
		$val = $this->value;
		
		$options = array ();
		
		foreach ($this->element->children() as $option)
		{
			$value = $option['value'];
			$class = $option['disable'] ? ' class="disable_next '.$option['disable'].' ' : ' class="';
			$class .= $option['enable'] ? 'enable_next '.$option['enable'].'"' : '"';
			$selected = $val == $value ? ' selected="selected"':'';
			$text	= $option['text'];
			//$item_help  = JText::_($node->attributes('item_help'));
			$options[] = '<option value="'.$value.'"'.$class.$selected.'>'.JText::_(trim((string) $option)).'</option>';
		}
		
		$s = '<select name="'.$this->name.'" '.$class.' id="'.$this->element['name'].'">';
		$s.= implode("\n", $options);
		$s.= '</select>';
		
		return $s;	
	}
}