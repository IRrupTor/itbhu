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
?>
	<ul class="menu<?php echo $params->get('class_sfx');?>"<?php
		$tag = '';
		if ($params->get('tag_id')!=NULL) {
			$tag = $params->get('tag_id').'';
			echo ' id="'.$tag.'"';
		}
	?>>
	<?php
	 //rasio start
 //create the parent arrays
 $parent_rows = array();
 $child_rows = array();  
 foreach($list as $rows_row => $rows_value){
  //create an array with all the parents
  if($rows_value->parent_id == 0){
   $parent_rows[$rows_value->id] = $rows_value;
  //create an array with all the parent as key and childs as values, and also keep the child node number
  }elseif($rows_value->parent_id > 0){
   //check to see if parent is inside parent array

   //if not add it, must be a parent which is a child for another parent, doesn't have his parent = 0
   if(!isset($parent_rows[$rows_value->parent_id])){
    foreach($list as $rows_value2){
     if($rows_value2->id == $rows_value->parent_id){
      $parent_rows[$rows_value2->id] = $rows_value2;
      break;
     }
    }
   }
   //add the child as key and node munber as values
   if(isset($child_rows[$rows_value->parent_id])){
    $child_rows[$rows_value->parent_id][$rows_value->id] = (int)max($child_rows[$rows_value->parent_id]) +1;     
   }else{
    $child_rows[$rows_value->parent_id][$rows_value->id] = 0;
   }
  }
 }
 //rasio end
	foreach ($list as $i => &$item) :
	require( TEMPLATEPATH.DS."html/mod_menu/yjsg_modhelper.php"); /* top menu only*/
		$id = '';
		if($item->id == $active_id)
		{
			$id = ' id="current"';
		}
		$class = '';
		if(in_array($item->id, $path))
		{
			$class .= 'active ';
		}
		if($item->deeper) {
			$class .= 'haschild ';
		}
		$class = ' class="'.$class.'item'.$item->id.$yj_load_mod_class.'"';
		echo '<li'.$id.$class.'>';
		if($item->deeper) {
			$span_class ='child';
		}else{
			$span_class ='mymarg';
		}
		// Render the menu item.
		switch ($item->type) :
			case 'separator':
			case 'url':
			case 'component':
				require JModuleHelper::getLayoutPath('mod_menu', 'default_'.$item->type);
				break;
	
			default:
				require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
				break;
		endswitch;
		// The next item is deeper.
		if ($item->deeper) {
			$level = 'level'.$item->level.'';
			echo '<ul class="subul_main'.$subul_class.''.$group_holder_class.$group_num_items.$group_holder_id.' '.$level.'"'.$group_holder_style.'><li class="bl"></li><li class="tl"></li><li class="tr"></li>';
		}
		// The next item is shallower.
		elseif ($item->shallower) {
			echo '</li>';
			echo str_repeat('<li class="right"></li><li class="br"></li></ul></li>', $item->level_diff);
		}
		// The next item is on the same level.
		else {
			echo '</li>';
		}
	endforeach;
	?></ul>