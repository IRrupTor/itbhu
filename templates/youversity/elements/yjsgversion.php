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

class JFormFieldYJSGversion extends JFormField
{
	public function getInput(){
				$document =& JFactory::getDocument();
			
	        /* determine template filepath */
	        $uri = str_replace(DS,"/",str_replace( JPATH_SITE, JURI::base (), dirname(dirname(__FILE__)) ));
			$uri = str_replace("/administrator/", "", $uri);
			$this->template = end( explode( '/', $uri ) );
		// Output	
	$document->addCustomTag('
<!--[if IE 7]>
<style type="text/css">
.elSelect .option{
	margin-top:-1px;
}
.selectsContainer .overDiv{
position:static;
}
</style>
<![endif]--> 
<style type="text/css">
.yj_system_check{
	width:280px;
	overflow:hidden;
	margin:0;
	padding:0;
}
.yj_system_check .yjmm_installed,
.yj_system_check .yjmm_published{
	color:green;
	font-weight:bold;
	margin:5px 0 0 0;
}
.yj_system_check .yjmm_installed_no,
.yj_system_check .yjmm_published_no{
	color:red;
	font-weight:bold;
	background: url('.JURI::root().'templates/'.$this->template.'/images/admin/publish_x.png) no-repeat right center;
	margin:5px 0 0 0;
}
.getyjmplugin{
	color:green;
	font-weight:bold;
	margin:5px 0 0 0;
}
.yj_system_check h2{
	color:#0B55C4;
	margin:0;
	line-height:17px;
}
</style>
');
echo '<div id="option-resut"></div>';
if (!JFile::exists(JPATH_SITE.DS.'plugins'.DS.'system'.DS.'YJMegaMenu/YJMegaMenu.php')){
$plug_installed ="_no";
$installed_word ="not";
$download='<li class="getyjmplugin"><a href="http://www.youjoomla.com/free-joomla-downloads-95.html" target="_blank">Download YJ Mega Menu Plugin</a></li>';
}else{
$plug_installed ="";
$installed_word ="";
$download='';
}

if(!JPluginHelper::getPlugin('system', 'YJMegaMenu') || !JFile::exists(JPATH_SITE.DS.'plugins'.DS.'system'.DS.'YJMegaMenu/YJMegaMenu.php')){
$plug_publihsed ="_no";
$publihsed_word ="not";
}else{
$plug_publihsed ="";
$publihsed_word ="";
}
echo '
<div class="yj_system_check">
<a href="'.JURI::root().'templates/'.$this->template.'/yjsgcore/yjsgversion.php" class="modal" rel="{handler: \'iframe\', size: {x: 350, y: 200}}">Click to Check YJSG Version</a>
	<ul>
		<li class="yjmm_installed'.$plug_installed.'">YJ Mega Menu plugin is '.$installed_word.' installed</li>
		<li class="yjmm_published'.$plug_publihsed.'">YJ Mega Menu plugin is '.$publihsed_word.'  published</li>
		'.$download.'
	</ul>
</div>
';
		
	}

	public function getLabel() {
		return false;
	}
}

?>
<script language="javascript" type="text/javascript">	
	window.addEvent('domready', function() {
		var Selected = $$('#jform_params_component_switch option[selected]');

		if (Selected.length > 0) {
   		 	$('option-resut').set('html', '<div style="color:green;font-weight:bold;font-size:14px;line-height:18px;">Please note that <em style="color:#3A8BC6;">Component disabled</em> switch is on for specific menu items.<br /> Check tab name   <em style="color:#3A8BC6;">Advanced Options</em>, last parameter, <em style="color:#3A8BC6;">Component disabled</em>.</div> <br />');
		}

	});
</script>