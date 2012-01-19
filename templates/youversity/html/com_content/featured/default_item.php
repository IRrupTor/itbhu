<?php
/**
 * @package   YJSimpleGrid Joomla! Template Framework
 * @author    Youjoomla LLC
 * @websites  http://www.youjoomla.com, http://www.yjsimplegrid.com
 * @license - PHP files are licensed under  GNU/GPL V2
 * @license - CSS  - JS - IMAGE files  are Copyrighted material
 * @bound by Proprietary License of Youjoomla LLC
*/
 // no direct access
defined('_JEXEC') or die('Restricted access'); 
$app = JFactory::getApplication();
$yjsg_params = $app->getTemplate(true)->params;
//print_r($yjsg_params);
$fp_controll_switch      = $yjsg_params->get('fp_controll_switch');
$fp_chars_limit          = $yjsg_params->get('fp_chars_limit');
$fp_after_text           = $yjsg_params->get('fp_after_text');


$params = &$this->item->params;
$canEdit	= $this->item->params->get('access-edit');
//JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
//JHtml::_('behavior.tooltip');
//JHtml::core();

$author = $params->get('link_author', 0) ? JHTML::_('link',JRoute::_('index.php?option=com_users&amp;view=profile&amp;member_id='.$this->item->created_by),$this->item->author) : $this->item->author; 
$author	=($this->item->created_by_alias ? $this->item->created_by_alias : $author);

$newsitemTools = (($params->get('show_author')) or ($params->get('show_category')) or ($params->get('show_create_date')) or ($params->get('show_modify_date')) or ($params->get('show_publish_date')) or ($params->get('show_parent_category')) or ($params->get('show_hits') or $params->get('show_print_icon') or $params->get('show_email_icon')));
?>
<div class="news_item_f">
	<?php /*Edit option*/if ($canEdit) : ?>
	<div class="contentpaneopen_edit<?php echo $params->get( 'pageclass_sfx' ); ?>" style="float: left;">
		<?php echo JHtml::_('icon.edit', $this->item, $params); ?>
	</div>
	<?php endif; ?>
	
	<?php /* Title*/if ($params->get('show_title')) : ?>
	<div class="title<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
		<h2>
			<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
			<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid)); ?>"> 
				<?php echo $this->escape($this->item->title); ?>
			</a>
			<?php else : ?>
			<?php echo $this->escape($this->item->title); ?>
			<?php endif; ?>
		</h2>
	</div>
	<?php endif; ?>
	
	<?php  
		if (!$params->get('show_intro')) :
			echo $this->item->event->afterDisplayTitle;
		endif; 
	?>
	<?php echo $this->item->event->beforeDisplayContent; ?>
	<?php if ($newsitemTools) : ?>
	<div class="newsitem_tools">
		<div class="newsitem_info">
			<?php /* Create date*/if ($params->get('show_create_date')) : ?>
			<span class="createdate">
				<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHTML::_('date',$this->item->created, JText::_('DATE_FORMAT_LC3'))); ?>
			</span>
			<?php endif; ?>

			<?php /* Author*/if ($params->get('show_author') && !empty($this->item->author)) : ?>
			<span class="createby">
				<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?> 
			</span>
			<?php endif; ?>
			
			<?php /* Parent category*/if ($params->get('show_parent_category')) : ?>
					<div class="clr"></div>
					<span class="newsitem_parent_category">
						<?php $title = $this->escape($this->item->parent_title);
							$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->parent_slug)) . '">' . $title . '</a>'; ?>
						<?php if ($params->get('link_parent_category') AND $this->item->parent_slug) : ?>
							<?php echo $url ?>
							<?php else : ?>
							<?php echo $title ?>&raquo;
						<?php endif; ?>
					</span>
			<?php endif; ?>		
				
			<?php /*Category title*/if ($params->get('show_category')) : ?>
			<span class="newsitem_category">
			<?php 	$title = $this->escape($this->item->category_title);
					$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($this->item->catslug)).'">'.$title.'</a>';
					if ($params->get('link_category') AND $this->item->catslug) :
						echo JText::sprintf('COM_CONTENT_CATEGORY', $url);
					else:
						echo JText::sprintf('COM_CONTENT_CATEGORY', $title);
					endif;
					?>
			</span>
			<?php endif; ?>
			<div class="clr"></div>
			<?php /* Published date*/ if ($params->get('show_publish_date')) : ?>
			<span class="newsitem_published">
			<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE', JHTML::_('date',$this->item->publish_up, JText::_('DATE_FORMAT_LC3'))); ?>
			</span>
			<?php endif; ?>	
			<?php /* Hits*/if ($params->get('show_hits')) : ?>
			<span class="newsitem_hits">
				<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $this->item->hits); ?>
			</span>
			<?php endif; ?>
		</div>
		
		<?php /* Email and Print*/ if ($params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
		<div class="buttonheading">
			<?php if ($params->get('show_email_icon')) : ?>
			<span class="email"> <?php echo JHtml::_('icon.email',  $this->item, $params); ?> </span>
			<?php endif; ?>
			<?php if ($params->get('show_print_icon')) : ?>
			<span class="print"> <?php echo JHtml::_('icon.print_popup',  $this->item, $params); ?> </span>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	
	<div class="newsitem_text"> 
	<?php /*Intro text*/
	 if ($fp_controll_switch == 1 ){
	 echo  $fp_intro_text = substr(strip_tags($this->item->introtext,
	 '<br><img><p><div><ul><li><a><strong><b><h1><h2><h3><h4><h5><h6><span>'),0,$fp_chars_limit)."$fp_after_text";
	 }else{
		echo $this->item->introtext; 
	 } 
	 ?>
	 </div>
	 
	<?php /*Modify date*/ if ($params->get('show_modify_date')) : ?>
	<span class="modifydate"> 
		<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHTML::_('date',$this->item->modified, JText::_('DATE_FORMAT_LC3'))); ?>
	</span>
	<?php endif; ?>
	
	<?php /* Read more link*/ if ($params->get('show_readmore') && $this->item->readmore) :
	if ($params->get('access-view')) :
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
	else :
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$itemId = $active->id;
		$link1 = JRoute::_('index.php?option=com_users&amp;view=login&amp;Itemid='. $itemId);
		$returnURL = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid));
		$link = new JURI($link1);
		$link->setVar('return', base64_encode($returnURL));
	endif;
	?>
	<a class="readon" href="<?php echo $link; ?>"> 
		<span>
		<?php 
		if (!$params->get('access-view')) :
			echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
		elseif ($readmore = $this->item->alternative_readmore) :
			echo $readmore;
			echo JHTML::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
		elseif ($params->get('show_readmore_title', 0) == 0) :
			echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');	
		else :
			echo JText::_('COM_CONTENT_READ_MORE');
			echo JHTML::_('string.truncate', ($this->item->title), $params->get('readmore_limit'));
		endif; 
		?>
		</span> 
	</a>
	<?php endif; ?>
</div>
<span class="article_separator">&nbsp;</span> 
<?php echo $this->item->event->afterDisplayContent; ?> 