<?php
/**
 * @version		$Id: default_url.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	mod_menu
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// Note. It is important to remove spaces between elements.
// No direct access.
defined('_JEXEC') or die;
$class 			= $item->params->get('menu-anchor_css', '') ? 'class="'.$item->params->get('menu-anchor_css', '').'" ' : '';
$title 			= $item->params->get('menu-anchor_title', '') ? ' title="'.$item->params->get('menu-anchor_title', '').'"' : '';


if ($params->get('class_sfx') =='nav' || $params->get('class_sfx') =='navd' || $params->get('class_sfx') =='split') {
	$mod_subclass 	= $item->params->get('menu-anchor_css', '');	
	 if($yj_item_type > 0  && $item->level > $allow_level && !empty($mod_subclass)){
		 $class = 'class="yj_menu_module_holder '.$mod_subclass.'"';
	 }elseif($yj_item_type > 0 && $item->level > $allow_level && empty($mod_subclass)){
		 $class = 'class="yj_menu_module_holder"';
	 }
switch ($item->browserNav) :
	default:
	case 0:
?><?php if($yj_item_type > 0 && $item->level > $allow_level ){?><div <?php echo $class; ?>><?php echo $item_link; ?></div><?php }else{ ?><span class="<?php echo $span_class ?>"><a <?php echo $class; ?>href="<?php echo $item->flink; ?>"<?php echo $title; ?>><?php echo $item_link; ?></a></span><?php } ?><?php
		break;
	case 1:
		// _blank
?><a class="<?php echo $class; ?>" href="<?php echo $item->flink; ?>" target="_blank" <?php echo $title; ?>><?php echo $item_link; ?></a><?php
		break;
	case 2:
		// window.open
		$attribs = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,'.$params->get('window_open');
?><a <?php echo $class; ?>href="<?php echo $item->flink; ?>" onclick="window.open(this.href,'targetWindow','<?php echo $attribs;?>');return false;" <?php echo $title; ?>><?php echo $item_link; ?></a><?php
		break;
endswitch;
// SIDES!
}else{
	$linktype = $item->title;
	$class = $item->params->get('menu-anchor_css', '') ? 'class="mainlevel '.$item->params->get('menu-anchor_css', '').'" ' : 'class="mainlevel" ';
if ($item->menu_image) {
		if($item->params->get('menu_text', 1 )) {
			$linktype = '<img src="'.JURI::base().$item->menu_image.'" alt="'.$item->title.'" class="imgl" />'.$item->title.'';
		}else{
			$linktype = '<img src="'.JURI::base().$item->menu_image.'" alt="'.$item->title.'" class="imgl" />';
		}
}
	switch ($item->browserNav) :
	default:
	case 0:
?><a <?php echo $class; ?>href="<?php echo $item->flink; ?>" <?php echo $title; ?>><?php echo $linktype; ?></a><?php
		break;
	case 1:
		// _blank
?><a <?php echo $class; ?>href="<?php echo $item->flink; ?>" target="_blank" <?php echo $title; ?>><?php echo $linktype; ?></a><?php
		break;
	case 2:
		// window.open
		$attribs = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,'.$params->get('window_open');
?><a <?php echo $class; ?>href="<?php echo $item->flink; ?>" onclick="window.open(this.href,'targetWindow','<?php echo $attribs;?>');return false;" <?php echo $title; ?>><?php echo $linktype; ?></a><?php
		break;
endswitch;
} ?>