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
 * Renders a radio element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */

class JFormFieldYjsgRadio extends JFormField
{
	public function getInput()
	{
		$options = array ();
		foreach ($this->element->children() as $option)
		{
			$val	= $value = $option['value'];
			$text	= $option;
			$options[] = JHTML::_('select.option', $val, JText::_($text));
		}

		return '<div class="yjsgradio">'.JHTML::_('select.radiolist', $options, $this->name, '', 'value', 'text', $this->value, $this->element['name'] ).'</div>';
	}
	/*
	public function getLabel() {
		return false;
	}
	//*/
}
