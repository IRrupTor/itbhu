<?php
/**
 * @version		$Id: default.php 20196 2011-01-09 02:40:25Z ian $
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
$this->form->reset( true ); // to reset the form xml loaded by the view
$this->form->loadFile( dirname(__FILE__) . DS . "registration.xml"); // to load in our own version of login.xml
?>
<div id="userregister_wrap<?php echo $this->pageclass_sfx?>">
	<div id="userpages<?php echo $this->pageclass_sfx?>">
		<?php if ($this->params->get('show_page_heading')) : ?>
			<h1 class="pagetitle"><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
		<?php endif; ?>
		
			<form id="member-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" class="form-validate">
		<?php foreach ($this->form->getFieldsets() as $fieldset): // Iterate through the form fieldsets and display each one.?>
			<?php $fields = $this->form->getFieldset($fieldset->name);?>
			<?php if (count($fields)):?>
				<fieldset class="input">
				<?php foreach($fields as $field):// Iterate through the fields in the set and display them.?>
					<?php if ($field->hidden):// If the field is hidden, just display the input.?>
						<?php echo $field->input;?>
					<?php else:?>
						<?php echo $field->label; ?>
						<?php if (!$field->required && (!$field->type == "spacer")): ?>
							<span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL');?></span>
						<?php endif; ?>
							<?php echo $field->input;?>	
					<?php endif;?>
				<?php endforeach;?>
				</fieldset>
			<?php endif;?>
		<?php endforeach;?>
				<div>
					<button type="submit" class="validate"><?php echo JText::_('JREGISTER');?></button>
					<?php echo JText::_('COM_USERS_OR');?>
					<a href="<?php echo JRoute::_('');?>" title="<?php echo JText::_('JCANCEL');?>"><?php echo JText::_('JCANCEL');?></a>
					<input type="hidden" name="option" value="com_users" />
					<input type="hidden" name="task" value="registration.register" />
					<?php echo JHtml::_('form.token');?>
				</div>
			</form>
	</div>
</div>
