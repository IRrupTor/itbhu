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
JHTML::_('behavior.modal');
JHTML::_('behavior.keepalive');

/** 
 * Renders a text element
 *
 * @package 	Joomla.Framework
 * @subpackage		Parameter
 * @since		1.5
 */
class JFormFieldYJSGMultitext extends JFormField
{	
	public function getInput()
	{
		// process element properties		
		$items 		= $this->element['items'];
		$default 	= explode('|', $this->element['default']);
		$values 	= is_array( $this->value ) ? $this->value : explode('|', $this->value);
				
		$size 		 = $this->element['size'];
		$css_class 	 = $this->element['class'];
		$labels 	 = explode('|', $this->element['labels']);
		$unique_id 	 = $this->element['name'];
		$turnof		 = $this->element['turnof'];
		$turnoflabel = $this->element['turnoflabel'];
		
		if ($turnof == 1){
			$disableme = 'disabled="disabled';
			$disabletext='<div class="disabled_text">'.$turnoflabel.'</div>';
		}else{
			$disableme='';
			$disabletext='';
		}
		
		$chk_name = str_replace($this->element['name'], $this->element['name'].'_locked', $this->name).'[]';	
		
		// create input text elements
        $div 	= array(); 
		$new_div= array();

		for ( $i=0; $i < $items; $i++ ){	
			$div[$i] = array();
			$cell_css = $i % 2 == 0 ? 'even':'odd';
			$div[$i][] = '<div class="'.$cell_css.'"><label for="'.$labels[$i].'">'.$labels[$i].'</label></div>';		
			$div[$i][] = '<div class="'.$cell_css.'"><input type="text" id="'.$labels[$i].'" class="'.$css_class.' YJSlider '.$unique_id.'" name="'.$this->name.'[]" value="'.( isset($values[$i]) ? $values[$i] : $default[$i] ).'" size="'.$size.'" '.$disableme.'/></div>';		
			
			if( array_key_exists( ($i+$items), $values ) )
				$checked = $values[$i+$items] == 1 ? 'checked="checked"' : '';			
			else 
				$checked = '';

			$div[$i][] = <<<HTML
<div class="$cell_css">
	<div class="option check $unique_id">			
		<div class="check">
			<input type="checkbox" name="$chk_name" class="YJSG_checkbox $unique_id" $checked />
		</div>
		Lock
	</div>
</div>			
HTML;
		}

		foreach($div as $div_row => $div_value){
			if(is_array($div_value)){
				$new_div[] = "<div class='box_".$div_row."'>".implode("\n", $div_value)."</div>";
			}else{
				$new_div[] = "<div class='box_".$div_row."'>".$div_value."</div>";
			}
		}

		$output = '<div class="YJSG_sbox_large"><div class="YJSG_multiple"><div id="'.$unique_id.'">';
		$output.= implode("\n", $new_div);		
		$output.= '<div><a class="YJSG_reset-values" id="'.$unique_id.'" href="#" rel="'.$this->element['default'].'">Reset to default</a></div>';
		$output.= '</div>'.$disabletext.'</div></div>';
		
		if( !defined('SCRIPTS_ON') ){
			$this->addScripts();
			define('SCRIPTS_ON', 1);
		}
		// return HTML
		return $output; 		
	}	
	
	
	
	private function addScripts(){
		
		$document =& JFactory::getDocument();
			
        // determine template filepath 
        $uri = str_replace(DS,"/",str_replace( JPATH_SITE, JURI::base (), dirname(dirname(__FILE__)) ));
		$uri = str_replace("/administrator/", "", $uri);
		$this->template = end( explode( '/', $uri ) );
		
		// add scripts 
	    $document->addScript($uri.'/src/admin/yjsg_admin.js');
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
		');
		
		// add css 
		$document->addStyleSheet($uri.'/css/admin/yjsg_admin.css');		
	}
	
}
