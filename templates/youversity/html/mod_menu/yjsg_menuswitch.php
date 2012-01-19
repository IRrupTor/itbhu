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
// No direct access.
defined('_JEXEC') or die;
$who = strtolower($_SERVER['HTTP_USER_AGENT']);
$app = JFactory::getApplication();
$yjsg_params 		= $app->getTemplate(true)->params;
// MENU
$mymenu = array(
        1, 2, 3, 4, 5
);
$default_menu = $yjsg_params->get('default_menu_style');
$valid_menu ='';
//*
if ( isset($_GET['change_menu']) && !empty($_GET['change_menu']) ) {
        // check if style is valid
        if( in_array( $_GET['change_menu'], $mymenu ) ){

                $_SESSION['frontend_menu'] = $_GET['change_menu'];
                $_SESSION['frontend_changed_menu'] = true;
                $valid_menu = $_GET['change_menu'];

        }else {
                // else set to default style
                $valid_menu = $default_style;
        }

} else {
        // second case, checkes for admin changes or front-end changes

        if ( isset($_SESSION['frontend_changed_menu']) && in_array( $_SESSION['frontend_menu'], $mymenu ) ){

                $valid_menu = $_SESSION['frontend_menu'];

        }else if( isset( $_SESSION['admin_change'] ) ){

                $default_menu = $yjsg_params->get("default_menu_style");

        }else {
                $valid_menu = $default_menu;
        }
}
$default_menu_style = in_array( $valid_menu, $mymenu ) ? $valid_menu : $default_menu;
$ie6style = preg_match( "/msie 6.0/",$who);
$yj_mega_menus = $default_menu_style == '1' || $default_menu_style == '2';
if ($yj_mega_menus){
	$subul_class = '';
	$allow_level = 1;

}else{
	$subul_class = ' dropline';
	$allow_level = 2;
}
if($ie6style && $yj_mega_menus){
	$subul_class = ' isie';
}
?>