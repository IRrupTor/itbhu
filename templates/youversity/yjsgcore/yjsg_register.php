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
defined('_JEXEC') or die('Restricted access'); 
$document = JFactory::getDocument();
?>
<script type="text/javascript" src="<?php echo JURI::base() ?>media/system/js/validate.js"></script>
				<form action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" id="josForm" name="josForm" class="form-validate">
			<div class="yjreg">	
			         <div class="yjreg_ins">
						<label id="namemsg" for="name">
							*&nbsp;<?php echo JText::_( 'NAME' ); ?>:
						</label>
				
				  		<input type="text" name="jform[name]" id="name" size="40" value="" class="inputbox required" maxlength="50" />
				     </div>
                     <div class="yjreg_ins">
						<label id="usernamemsg" for="username">
							*&nbsp;<?php echo JText::_( 'USERNAME' ); ?>:
						</label>
				
						<input type="text" id="username" name="jform[username]" size="40" value="" class="inputbox required validate-username" maxlength="25" />
				    </div>
                    <div class="yjreg_ins">
						<label id="emailmsg" for="email">
							*&nbsp;<?php echo JText::_( 'EMAIL' ); ?>:
						</label>
					
						<input type="text" id="email" name="jform[email1]" size="40" value="" class="inputbox required validate-email" maxlength="100" />
				     </div>
					   <div class="yjreg_ins">
						<label id="emailmsg2" for="email2">
							*&nbsp;<?php echo JText::_( 'VERIFY_EMAIL' ); ?>:
						</label>
					
						<input type="text" id="email2" name="jform[email2]" size="40" value="" class="inputbox required validate-email" maxlength="100" />
				     </div>
                     <div class="yjreg_ins">
						<label id="pwmsg" for="password">
							*&nbsp;<?php echo JText::_( 'PASSWORD' ); ?>:
						</label>
				
				  		<input class="inputbox required validate-password" type="password" id="password" name="jform[password1]" size="40" value="" />
				  </div>
                  <div class="yjreg_ins">
						<label id="pw2msg" for="password2">
							*&nbsp;<?php echo JText::_( 'VERIFY_PASSWORD' ); ?>:
						</label>
					
						<input class="inputbox required validate-passverify" type="password" id="password2" name="jform[password2]" size="40" value="" />
                 </div>
				 </div> 
						<p class="information_td"><?php echo JText::_( 'REGISTER_REQUIRED' ); ?></p>
			
					<button class="button validate" type="submit"><?php echo JText::_('REGISTER'); ?></button>
					<input type="hidden" name="option" value="com_users" />
					<input type="hidden" name="task" value="registration.register" />
					<?php echo JHtml::_('form.token');?>
				</form>