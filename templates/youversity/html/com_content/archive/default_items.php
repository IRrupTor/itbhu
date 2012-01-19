<?php
/**
 * @version		$Id: default_items.php 20209 2011-01-09 17:23:07Z chdemko $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.DS.'helpers');
$params = &$this->params;

?>

<div id="archive-items">
<?php foreach ($this->items as $i => $item) : ?>



			<h2 class="pagetitle">
			<?php if ($params->get('link_titles')): ?>
				<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($item->slug,$item->catslug)); ?>">
					<?php echo $this->escape($item->title); ?></a>
			<?php else: ?>
					<?php echo $this->escape($item->title); ?>
			<?php endif; ?>
			</h2>
			
			
	<div class="newsitem_tools">
		<div class="newsitem_info">
			<?php if ($params->get('show_create_date')) : ?>
			<span class="createdate">
				<?php echo JText::sprintf('COM_CONTENT_CREATED_DATE_ON', JHTML::_('date',$item->created, JText::_('DATE_FORMAT_LC2'))); ?>
			</span>
			<?php endif; ?>
			
			
			<?php if ($params->get('show_author') && !empty($item->author )) : ?>
			<span class="createby">
			<?php $author =  $item->author; ?>
			<?php $author = ($item->created_by_alias ? $item->created_by_alias : $author);?>
		
				<?php if (!empty($item->contactid ) &&  $params->get('link_author') == true):?>
					<?php 	echo JText::sprintf('COM_CONTENT_WRITTEN_BY' , 
					 JHTML::_('link',JRoute::_('index.php?option=com_contact&view=contact&id='.$item->contactid),$author)); ?>
		
				<?php else :?>
					<?php echo JText::sprintf('COM_CONTENT_WRITTEN_BY', $author); ?>
				<?php endif; ?>
			</span>
			<?php endif; ?>	
			
			
			<?php if ($params->get('show_parent_category')) : ?>
			<span class="newsitem_category">
				<?php	$title = $this->escape($item->parent_title);
						$url = '<a href="'.JRoute::_(ContentHelperRoute::getCategoryRoute($item->catslug)).'">'.$title.'</a>';?>
				<?php if ($params->get('link_parent_category') && $item->parent_slug) : ?>
					<?php echo JText::sprintf('COM_CONTENT_PARENT', $url); ?>
					<?php else : ?>
					<?php echo JText::sprintf('COM_CONTENT_PARENT', $title); ?>
				<?php endif; ?>
			</span>
			<?php endif; ?>
		
			<?php if ($params->get('show_category')) : ?>
			<span class="newsitem_category">
				<?php	$title = $this->escape($item->category_title);
						$url = '<a href="' . JRoute::_(ContentHelperRoute::getCategoryRoute($item->catslug)) . '">' . $title . '</a>'; ?>
				<?php if ($params->get('link_category') && $item->catslug) : ?>
					<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $url); ?>
					<?php else : ?>
					<?php echo JText::sprintf('COM_CONTENT_CATEGORY', $title); ?>
				<?php endif; ?>
			</span>
			<?php endif; ?>
			
		
			<?php if ($params->get('show_hits')) : ?>
			<span class="newsitem_hits">
				<?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', $item->hits); ?>
			</span>
			<?php endif; ?>
		</div>
	</div>


		<?php if ($params->get('show_intro')) :?>
			<div class="newsitem_text"> 
				<?php echo JHTML::_('string.truncate', $item->introtext, $params->get('introtext_limit')); ?>
			</div>		
		<?php endif; ?>
		
		
		
		<?php if ($params->get('show_modify_date')) : ?>
		<span class="modifydate"> 
			<?php echo JText::sprintf('COM_CONTENT_LAST_UPDATED', JHTML::_('date',$item->modified, JText::_('DATE_FORMAT_LC2'))); ?>
		</span>
		<?php endif; ?>
		
		
				

		<?php if ($params->get('show_publish_date')) : ?>
		<span class="createdate">
			<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE', JHTML::_('date',$item->publish_up, JText::_('DATE_FORMAT_LC2'))); ?>
		</span>
		<?php endif; ?>
	
	
<?php endforeach; ?>
</div>

<div class="yjsg-pagination">
	<p class="counter">
		<?php echo $this->pagination->getPagesCounter(); ?>
	</p>
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>