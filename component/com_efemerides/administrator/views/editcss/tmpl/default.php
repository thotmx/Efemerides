<?php defined('_JEXEC') or die('Restricted access'); 
?>
<form action="index.php" method="post" name="adminForm">

		<table class="adminform">
		<tr>
			<th>
				<?php echo $this->filename; ?>
			</th>
		</tr>
		<tr>
			<td>
				<textarea style="width:100%;height:500px" cols="110" rows="25" name="filecontent" class="inputbox"><?php echo $this->content; ?></textarea>
			</td>
		</tr>
		</table>

		<input type="hidden" name="option" value="com_efemerides" />
		<input type="hidden" name="task" value="" />		
		<input type="hidden" name="controller" value="editcss" />		
		<input type="hidden" name="filename" value="<?php echo $this->filename; ?>" />
		
</form>

