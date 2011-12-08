<?php
/**
 * @version		$Id$
 * @package		Joomla.Administrator
 * @subpackage	com_languages
 * @copyright	Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
?>
<script type="text/javascript">
<?php if($this->state->get('cache_expired')): ?>
		window.addEvent('domready', function() {
      document.id('jform_searchstring').addEvent('focus', function() {
        if(!Joomla.overrider.states.refreshed)
        {
          Joomla.overrider.refreshCache();
          Joomla.overrider.states.refreshed = true;
        }
      });
		});
<?php endif; ?>
	Joomla.submitbutton = function(task)
	{
		if (task == 'override.cancel' || document.formvalidator.isValid(document.id('override-form'))) {
			Joomla.submitform(task, document.getElementById('override-form'));
		}
	}
</script>

<form action="<?php echo JRoute::_('index.php?option=com_languages&id='.$this->item->key); ?>" method="post" name="adminForm" id="override-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo empty($this->item->key) ? JText::_('COM_LANGUAGES_VIEW_OVERRIDE_EDIT_NEW_OVERRIDE_LEGEND') : JText::_('COM_LANGUAGES_VIEW_OVERRIDE_EDIT_EDIT_OVERRIDE_LEGEND'); ?></legend>
			<ul class="adminformlist">

        <li><?php echo $this->form->getLabel('key'); ?>
        <?php echo $this->form->getInput('key'); ?>
          <div class="button-holder">
            <div class="button1">
              <div class="next">
                <a href="#" onclick="document.id('jform_searchstring').focus();">
                  <?php echo JText::_('COM_LANGUAGES_VIEW_OVERRIDE_CONSTANT_SEARCH_BUTTON'); ?></a>
              </div>
            </div>
          </div>
        </li>

        <li><?php echo $this->form->getLabel('override'); ?>
        <?php echo $this->form->getInput('override'); ?></li>

			</ul>
		</fieldset>
	</div>

	<div class="width-40 fltrt">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_LANGUAGES_VIEW_OVERRIDE_SEARCH_LEGEND'); ?></legend>
			<ul class="adminformlist">

				<li id="refresh-status" class="overrider-spinner">
          <?php echo JText::_('COM_LANGUAGES_VIEW_OVERRIDE_REFRESHING'); ?></li>
				<li><?php echo $this->form->getInput('searchstring'); ?>
				<button type="submit" onclick="Joomla.overrider.searchStrings(document.id('jform_searchstring').value);return false;">
					<?php echo JText::_('COM_LANGUAGES_VIEW_OVERRIDE_SEARCH_BUTTON'); ?></button></li>

			</ul>
		</fieldset>
		<fieldset id="results-container" class="adminform">
			<legend><?php echo JText::_('COM_LANGUAGES_VIEW_OVERRIDE_RESULTS_LEGEND'); ?></legend>
      <span id="more-results">
        <a href="javascript:Joomla.overrider.searchStrings(document.id('jform_searchstring').value, Joomla.overrider.states.more);">
          <?php echo JText::_('COM_LANGUAGES_VIEW_OVERRIDE_MORE_RESULTS'); ?></a>
      </span>
		</fieldset>
		<input type="hidden" name="task" value="" />
    <input type="hidden" name="id" value="<?php echo $this->item->key; ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
	<div class="clr"></div>
</form>