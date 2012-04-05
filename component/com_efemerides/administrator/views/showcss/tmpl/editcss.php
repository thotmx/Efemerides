<?php defined('_JEXEC') or die('Restricted access'); 
?>
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
	  echo '<tr class="row0"><td colspan="2"><h2>'. JText::_('There was an unexpected error'). "</h2></td></tr>";
        else {
	foreach ($this->files as $row)
	{
		$checked 	= JHTML::_('grid.id',   $i, $row['fullpath'] );		
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td><?php echo $checked; ?></td>			
			<td><?php echo $row['filename']; ?>	</td>
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
<input type="hidden" name="controller" value="editcss" />
</form>

