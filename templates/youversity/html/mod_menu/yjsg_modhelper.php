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
require_once( TEMPLATEPATH.DS."html/mod_menu/yjsg_helperclass.php");
defined('_JEXEC') or die;?>
<?php
///// item params
$yj_group_holder		 	= $item->params->get('yj_group_holder');
$yj_menu_holder_width	 	= $item->params->get('yj_menu_holder_width');
$yj_menu_groups_count	 	= $item->params->get('yj_menu_groups_count');
$yj_sub_group_width	 		= $item->params->get('yj_sub_group_width');
$yj_group_id 			 	= $item->id;
$yj_group_left_poz	 		= $item->params->get('yj_sub_group_width');
$yj_mod_id 					= $item->params->get('yj_mod_id');
$yj_position				= $item->params->get('yj_position');
$yj_menu_show_title			= $item->params->get('yj_menu_show_title');
$yj_menu_title				= $item->title;
$yj_sub_title 				= $item->params->get('yj_menu_sub_title');
$yj_item_type 				= $item->params->get('yj_item_type');
///// get parents
$db		=& JFactory::getDBO();
if($item->parent_id > 0){
	$parent_sql = 'SELECT params FROM #__menu WHERE id = '.$item->parent_id.' AND params !=""';
	$db->setQuery( $parent_sql );
	$parent_details = $db->loadResult();

	$parent_params = new JRegistry();
	$parent_params->loadJSON( $parent_details );
}else{
	$parent_params = new JRegistry();		
}
///// parent params
if($item->parent_id > 0){
	$yj_pgroup_holder 			= $parent_params->get('yj_group_holder');
	$yj_psub_width		 		= $parent_params->get('yj_sub_group_width');
	$yj_pgroups_count	 		= $parent_params->get('yj_menu_groups_count');
	$yj_sub_group_width_array 	= explode("\n",$yj_psub_width);
}
///// group style and  specific widths
if (!$ie6style && $yj_mega_menus && $yj_group_holder == '1' && $yj_menu_holder_width !=='' && $yj_menu_groups_count !=='0' ){
	$group_holder_class =' group_holder';
	$group_holder_style = ' style="width:'.$yj_menu_holder_width.'px!important;"';
	$group_num_items 	= ' count'.$yj_menu_groups_count.'';
	$group_holder_id = ' group_'.$yj_group_id.'';
	
	if(!$ie6style && $yj_mega_menus && $yj_menu_groups_count == '3' && $yj_sub_group_width == '' ) {
		$group_holder_style = ' style="width:'.($yj_menu_holder_width -1 ).'px!important;"';
	}
}else{
	$group_holder_class ='';
	$group_holder_style ='';
	$group_num_items='';
	$group_holder_id ='';
}
// if no plugin kill groups
if (!JPluginHelper::getPlugin('system', 'YJMegaMenu')) {
		$group_holder_class ='';
		$group_holder_style ='';
		$group_num_items='';
		$group_holder_id ='';
}
///// mega param cases
	if (JPluginHelper::getPlugin('system', 'YJMegaMenu')) {	
			// title only
			if(empty($yj_sub_title) && empty($item->menu_image)){
				$item_link ='<span class="yjm_has_none"><span class="yjm_title">'.$yj_menu_title.'</span></span>';
			// Description and title	
			}elseif(!empty($yj_sub_title) && empty($item->menu_image)){
				$item_link = '<span class="yjm_has_desc"><span class="yjm_title">'.$yj_menu_title.'</span><span class="yjm_desc">'.$yj_sub_title.'</span></span>';
			// Image and title	
			}elseif(empty($yj_sub_title) && !empty($item->menu_image)){
				$item_link = '<span class="yjm_has_image" style="background-image:url('.JURI::base().$item->menu_image.');"><span class="yjm_title">'.$yj_menu_title.'</span></span>';
			}elseif(!empty($yj_sub_title) && !empty($item->menu_image) ){
			// Image title and description	
				$item_link ='<span class="yjm_has_all" style="background-image:url('.JURI::base().$item->menu_image.');"><span class="yjm_title">'.$yj_menu_title.'</span><span class="yjm_desc">'.$yj_sub_title.'</span></span>';	
			}else{
			// No image no description all other cases
				$item_link ='<span class="yjm_has_none"><span class="yjm_title">'.$yj_menu_title.'</span></span>';
			}
	}else{
			if($item->menu_image !=null){
				$item_link = '<span class="yjm_has_image" style="background-image:url('.JURI::base().$item->menu_image.');"><span class="yjm_title">'.$yj_menu_title.'</span></span>';
				}else{
				$item_link ='<span class="yjm_has_none"><span class="yjm_title">'.$yj_menu_title.'</span></span>';
			}
		}
		//Image only no text
		if($item->params->get('menu_text') == 0) {
			$item_link = '<span class="no_text"><span class="yjm_title"><img src="'.$item->menu_image.'" alt="'.$item->title.'" class="imsolo_mega" /></span></span>';
		}
/////title image and sub for module type links
		if($yj_sub_title !=='' && $yj_menu_show_title == 1){
			$yj_module_sub_title         	= '<span class="yjm_desc">'.$yj_sub_title.'</span>';
		}else{
			$yj_module_sub_title         	= '';
		}
		if (!empty($item->menu_image) && $yj_menu_show_title == 1 ){
			$yj_module_class				='_img';	
			$yj_module_image         		= ' style="background-image:url('.JURI::base().$item->menu_image.');"';
		}else{
			$yj_module_class				='';	
			$yj_module_image         		='';
		}
		if($yj_menu_show_title == 1) {
			$yj_module_link_title 				= '<span class="yjm_title">'.$yj_menu_title.'</span>';
			$yj_module_details						= '<span class="yjm_module_details'.$yj_module_class.'"'.$yj_module_image .'>'.$yj_module_link_title.$yj_module_sub_title.'</span>';
		}else{
			$yj_module_link_title 				='<span class="yjm_title">'.$yj_menu_title.'</span>';
			$yj_module_details						='';
		}
//// module output
		if($yj_item_type == 1  && $item->level > $allow_level ) {
			// CHECK: custom module name is given by the title field, otherwise it's just 'om' ??
			//check if we have multiple modules selected
			if(!is_array($yj_mod_id)){
				$yj_mod_id = array($yj_mod_id);
			}
			$item_link_array = array();
			foreach($yj_mod_id as $yj_mod_id_value){
				//get the module name
				
				$query = 'SELECT module, title '
					. ' FROM #__modules AS m'
					. ' WHERE 1 '//m.published = 1
					. ' AND m.client_id = 0'
					. ' AND m.id = '. (int)$yj_mod_id_value;
				$db->setQuery( $query );
				$module_details = $db->loadObjectList();

				if($module_details[0]->module == 'mod_custom'){
					$yj_module = YJModuleHelper::getModule( 'custom', $module_details[0]->title );
				}else{
					$yj_module = YJModuleHelper::getModule( strtolower(substr( $module_details[0]->module, 4, strlen($module_details[0]->module) )), $module_details[0]->title );			
				}
				$yj_attribs['yj_style'] = 'YJsgxhtml'; 
				$yj_load_mod = YJModuleHelper::renderModule( $yj_module, $yj_attribs );
				$yj_load_mod_class =' has_module';
				$item_link_array[] =''.$yj_module_details.'<div class="yjm_module">'.$yj_load_mod.'</div>';        
				if(!$ie6style && $yj_mega_menus && isset($yj_pgroup_holder) && $yj_pgroup_holder==1 && isset($yj_psub_width) && !empty($yj_psub_width)){
			$subswidth = trim($yj_sub_group_width_array[$child_rows[$item->parent_id][$item->id]]);
 			$yj_load_mod_class = ' has_module" style="width:'.$subswidth.'px!important;';
		}
			}
			if (JPluginHelper::getPlugin('system', 'YJMegaMenu')) {	
				$item_link = implode($item_link_array);
			}
		}elseif($yj_item_type == 2  && $item->level > $allow_level ) {
			if(!is_array($yj_position)){
				$yj_position = array($yj_position);
			}
			$item_link_array = array();
			foreach($yj_position as $yj_position_value){
				$yj_modules = YJModuleHelper::getModules($yj_position_value); 
				$yj_attribs['yj_style'] = 'YJsgxhtml'; 
				foreach($yj_modules as $yj_module){
					$yj_load_mod  = YJModuleHelper::renderModule($yj_module,$yj_attribs);
					$yj_load_mod_class =' has_modpoz';
					$item_link_array[] =''.$yj_module_details.'<div class="yjm_module">'.$yj_load_mod.'</div>';
if(!$ie6style && $yj_mega_menus && isset($yj_pgroup_holder) && $yj_pgroup_holder==1 && isset($yj_psub_width) && !empty($yj_psub_width)){
			$subswidth = trim($yj_sub_group_width_array[$child_rows[$item->parent_id][$item->id]]);
 			$yj_load_mod_class = ' has_modpoz" style="width:'.$subswidth.'px!important;';
		}
				}
			}
			if (JPluginHelper::getPlugin('system', 'YJMegaMenu')) {	
				$item_link = implode($item_link_array);
			}
		}elseif(!$ie6style && $yj_mega_menus && isset($yj_pgroup_holder) && $yj_pgroup_holder==1 && isset($yj_psub_width) && !empty($yj_psub_width)){
			$subswidth = trim($yj_sub_group_width_array[$child_rows[$item->parent_id][$item->id]]);
 			$yj_load_mod_class = '" style="width:'.$subswidth.'px!important;';
		}else{
			$yj_load_mod_class='';
		}
?>