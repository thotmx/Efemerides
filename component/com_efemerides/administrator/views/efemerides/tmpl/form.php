<?php defined('_JEXEC') or die('Restricted access'); ?>

<script language="javascript" type="text/javascript">
function submitbutton(pressbutton) {
        var form = document.adminForm;
        if (pressbutton == 'cancel') {
                submitform( pressbutton );
                return;
        }
 
        <?php
                $editor =& JFactory::getEditor();
                echo $editor->save( 'description' );
        ?>
        submitform(pressbutton);
}
</script>


<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="historicdate">
					<?php echo JText::_( 'Historic Date' ); ?>:
				</label>
			</td>
			<td>
				<?php echo JHTML::_('calendar', $this->efemerides->historicdate, 'historicdate', 'historicdate'); ?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="title">
					<?php echo JText::_( 'Title' ); ?>:
				</label>
			</td>
			<td>
			<input type="text" name="title" id="title" value="<?php echo $this->efemerides->title; ?>" />
			</td>
		</tr>
                 <tr>
			<td  class="key">
				<label for="alias">
					<?php echo JText::_( 'ALIAS' ); ?>:
				</label>
			</td>
			<td>
			<input class="inputbox" type="text" name="alias" id="alias" size="60" value="<?php echo $this->efemerides->alias; ?>" />
			</td>
		</tr>
                 <tr>
			<td width="120" class="key">
				<?php echo JText::_( 'PUBLISHED' ); ?>:
			</td>
			<td>
				<?php echo JHTML::_( 'select.booleanlist',  'published', 'class="inputbox"', $this->efemerides->published ); ?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="description"><?php echo JText::_( 'Description' ); ?>:</label>
			</td>
			<td>
				<?php
				$editor =& JFactory::getEditor();
                echo $editor->display( 'description', $this->efemerides->description, '100%', '300', '44', '9' ) ;
				?>
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_efemerides" />
<input type="hidden" name="id" value="<?php echo $this->efemerides->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="efemerides" />
<?php echo JHTML::_( 'form.token' ); ?>
<button type="button" onclick="submitbutton('save')"><?php echo JText::_('Save') ?></button>
<button type="button" onclick="submitbutton('cancel')"><?php echo JText::_('Cancel') ?></button>
</form>

