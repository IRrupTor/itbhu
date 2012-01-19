<?php
/*======================================================================*\
|| #################################################################### ||
|| # Package - Joomla Template based on YJSimpleGrid Framework          ||
|| # Copyright (C) 2010  Youjoomla LLC. All Rights Reserved.            ||
|| # license - PHP files are licensed under  GNU/GPL V2                 ||
|| # license - CSS  - JS - IMAGE files  are Copyrighted material        ||
|| # bound by Proprietary License of Youjoomla LLC                      ||
|| # for more information visit http://www.youjoomla.com/license.html   ||
|| # Redistribution and  modification of this software                  ||
|| # is bounded by its licenses                                         ||
|| # websites - http://www.youjoomla.com | http://www.yjsimplegrid.com  ||
|| #################################################################### ||
\*======================================================================*/
// No direct access.
defined('_JEXEC') or die;
require( TEMPLATEPATH.DS."html/mod_menu/yjsg_menuswitch.php");

if ($params->get('class_sfx') =='nav' || $params->get('class_sfx') =='navd' || $params->get('class_sfx') =='split') {
		require( TEMPLATEPATH.DS."html/mod_menu/yjsg_topmenu.php"); /* top menu only*/ 
}else{
		require( TEMPLATEPATH.DS."html/mod_menu/yjsg_sidemenus.php");/* side  menus only*/
}
?>