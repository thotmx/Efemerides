<?php defined('_JEXEC') or die('Restricted access'); 
?>
<p><?php echo JText::_('Upload File'); ?>
<form action="index.php" name="upload" method="post" enctype="multipart/form-data">
<input type="file" name="file_upload" />
<input type="submit" value="Submit" />
<input type="hidden" name="option" value="com_efemerides" />
<input type="hidden" name="task" value="upload" />
<input type="hidden" name="controller" value="backup" />
</form>
</p>
<hr />
<form action="index.php" method="post" name="adminForm">
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>
			<th>
				<?php echo JText::_( 'File' ); ?>
			</th>
		</tr>			
	</thead>
	<?php
	$k = 0;
	$i = 0;
        if (!isset($this->files)||!($this->files))
	  echo '<tr class="row0"><td colspan="2"><h2>'. JText::_('There is no backups yet'). "</h2></td></tr>";
        else {
	foreach ($this->files as $row)
	{
		$checked 	= JHTML::_('grid.id',   $i, $row['filename'] );
		$link   = JRoute::_( 'index.php?option=com_efemerides&controller=backup&task=download&cid[]='. $row['filename'] );
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $checked; ?>
			</td>			
			    <td><a href="<?php echo $link; ?>"><?php echo $row['filename']; ?></a>
			</td>
		</tr>
		<?php
		$i = $i + 1;
		$k = 1 - $k;
	}
        }
	?>
	</table>
</div>

<input type="hidden" name="option" value="com_efemerides" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="backup" />
</form>

