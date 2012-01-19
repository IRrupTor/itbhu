<?php
/**
 * @version		$Id: default_children.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_content
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
$counter=0;
?>

<?php if (count($this->children[$this->category->id]) > 0) : ?>
	<div class="YjsubCategoryBlock">
	<?php foreach($this->children[$this->category->id] as $id => $child) : 
		
	$childcat_params = new JRegistry();
	$childcat_params->loadJSON( $child->params );
	$child_image = $childcat_params->get('image');
	$child_title = $childcat_params->get('title');
	$subs_per_row = $this->params->get('num_subc_row');
	if (isset($subs_per_row)):
		$subs_width = number_format((100/$subs_per_row) ,2, '.', '') ;
		$subs_width = ' style="width:'.$subs_width.'%;"';
	else:
		$subs_width='';
	endif;
	?>

		<div class="YjsubCategoryRow"<?php echo $subs_width ?>>		
		<?php
		if (isset($subs_per_row) && $counter % $subs_per_row == 0){
			$item_order = ' first';
		}elseif (isset($subs_per_row) && $counter % $subs_per_row == $subs_per_row -1){
			$item_order=' last';
		}else{
			$item_order='';
		}
		?>
			<div class="YjsubCategory<?php echo $item_order ?>">
			
<h2>
					<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id));?>">
						<?php echo $this->escape($child->title); ?>
							<?php if ( $this->params->get('show_cat_num_articles',1)) : ?>
								(<?php echo $child->getNumItems(true); ?>)
							<?php endif ; ?>
					</a>
				</h2>
				<?php /* subcat image */ if($this->params->get('show_subcat_image')==1) : ?>
				<div class="YjsubCategoryImage">
					<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id));?>">
						<img src="<?php echo $child_image; ?>" alt="<?php echo $child_title ?>" />
					</a>
				</div>
				<?php endif; ?>
		
				
			
				<?php /* sub desc*/if ($this->params->get('show_subcat_desc') == 1 && ($child->description)) :?>
					<div class="YjsubCategoryDesc">
						<?php echo JHtml::_('content.prepare', $child->description); ?>
					</div>
				<?php endif; ?>
					
				<?php /* read more */if ($this->params->get('show_subcat_readon') == 1 && $this->params->get('subcat_readon_txt')): ?>
				<a class="YjReadmore" href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id));?>">
					<span><?php echo $this->params->get('subcat_readon_txt'); ?></span>
				</a>
				<?php endif; ?>
			</div>
			<?php if(isset($subs_per_row)):$counter++;endif; ?>
			

			
			
		<?php if (count($child->getChildren()) > 0 ) :
			$this->children[$child->id] = $child->getChildren();
			$this->category = $child;
			$this->maxLevel--;
			if ($this->maxLevel != 0) :
				echo $this->loadTemplate('children');
			endif;
			$this->category = $child->getParent();
			$this->maxLevel++;
		endif; ?>
			
		</div>
		<?php 
		$rowcount=( ((int)$id) %	(int) $subs_per_row) +1;
		if (isset($subs_per_row) && ($rowcount == $subs_per_row)): ?>
			<span class="row-separator"></span>
		<?php endif; ?>
		
	<?php endforeach; ?>
	</div>
<?php endif; ?>