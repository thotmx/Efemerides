<?php defined('_JEXEC') or die('Restricted access'); ?>
<form id="adminForm" action="<?php echo JRoute::_('index.php');?>" method="post" name="adminForm">

<table>
<tr>
	<td align="left" width="100%" colspan="2">
		<?php echo JText::_('Backup File Name:');?><input type="text" name="backupname" id="backupname" value="" /><br/>&nbsp;
	</td>
</tr>
<tr>
	<td align="left" width="100%">
		<?php echo JText::_( 'Filter' ); ?>:
		<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
		<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
		<button onclick="document.getElementById('search').value='';this.form.getElementById('filter_state').value='';this.form.getElementById('filter_datesort').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
	</td>
	<td nowrap="nowrap">
		<?php
			echo $this->lists['datesort'];
			echo $this->lists['state'];
		?>
	</td>
</tr>
</table>

<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr class="sortable">
			<th width="5">
				<?php echo JText::_( 'NUM' ); ?>
            </th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>
			<th>
				<a href="javascript:tableOrdering('historicdate','asc','');">
					<?php echo JHTML::_( 'grid.sort', 'Date', 'historicdate', $this->lists['order_Dir'], $this->lists['order']); ?> 
				</a>
			</th>
			<th>
				<?php echo JHTML::_( 'grid.sort', 'Title', 'title', $this->lists['order_Dir'], $this->lists['order']); ?>
			</th>							
			<th>
				<?php echo JHTML::_( 'grid.sort', 'Description', 'description', $this->lists['order_Dir'], $this->lists['order']); ?>
			</th>
			<th width="15%" align="center">
				<?php echo JHTML::_('grid.sort',   'PUBLISHED', 'published', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</th>
			<th width="80">
				<?php echo JHTML::_('grid.sort', 'REORDER', 'ordering', $this->lists['order_Dir'], $this->lists['order'] ); ?> <?php echo JHTML::_('grid.order', $this->items, 'filesave.png', 'saveorder' ); ?>
			</th>
			<th width="20">
				<a href="javascript:tableOrdering('id','asc','');"><?php echo JHTML::_( 'grid.sort', 'ID', 'id', $this->lists['order_Dir'], $this->lists['order']); ?></a>
			</th>
		</tr>			
	</thead>
	<tfoot>
		<tr>
			<td colspan="9"><?php echo $this->pagination->getListFooter(); ?></td>
		</tr>
	</tfoot>

	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
		$link 		= JRoute::_( 'index.php?option=com_efemerides&controller=efemerides&task=edit&cid[]='. $row->id );
		$published  = JHTML::_('grid.published', $row, $i );
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $i + 1 + $this->pagination->limitstart;?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>			
			<td>
				<?php echo $row->historicdate; ?>
			</td>
			<td>
				<a href="<?php echo $link; ?>"><?php echo $row->title; ?></a>
			</td>
			<td>
											     <?php echo strip_tags($row->description); ?>
			</td>
			<td align="center">
				<?php echo $published;?>
			</td>
			<td class="order">
				<span><?php echo $this->pagination->orderUpIcon( $i, true, 'orderup', 'Move Up', $row->ordering ); ?></span>
				<span><?php echo $this->pagination->orderDownIcon( $i, $n, true, 'orderdown', 'Move Down', $row->ordering );?></span>
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering; ?>" class="text_area" style="text-align: center" />
			</td>
			<td>
				<?php echo $row->id; ?>
			</td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>

	</table>
</div>

<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir'];?>" />

<input type="hidden" name="option" value="com_efemerides" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="efemerides" />

</form>
