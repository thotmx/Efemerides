<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<div class="modefemerides-main">
<?php 
	$n=count($efemerides);
	if ($n<=0)
    {	
  ?>
  <p class="modefemerides-noefemerides"> <?php echo JText::_('There is no important events to show'); ?></p>
<?php 
    } else {
?>
<div class="modefemerides-content">	
	<?php		
		for ($i=0; $i < $n; $i++)
		{
			$row = &$efemerides[$i];
			?>
			<div class="modefemerides-date">
			<p>
			<?php
			if ($formatted=='1')
			{
			  echo $row->formatteddate; 
			}
			else
			{
			  echo $row->theday."/".$row->themonth."/".$row->theyear;
			}
			?></p>
			</div>
			<div class="modefemerides-separator1"></div>
			<div class="modefemerides-title">
			  <p><?php if ($texttoshow=='0'||$texttoshow=='2') echo $row->title; ?></p>
			</div>
			<div class="modefemerides-separator2"></div>
			<div class="modefemerides-description">
			  <p><?php if ($texttoshow=='1'||$texttoshow=='2') echo $row->description; ?></p>
			</div>
			<div class="modefemerides-link">
			<?php
			if ($isIndividualLink=='1') 
			  {
			    $link 		= JRoute::_( 'index.php?option=com_efemerides&event='.$row->id);	
			 ?>
			<a href="<?php echo $link; ?>"><?php echo $textIndividualLink ?></a>
		<?php
		    } 
		?>
			</div>
			<div class="modefemerides-separator"></div>
			<?php
		}
    ?>
</div>

		<?php
		   if ($isGlobalLink=='1') 
		   {
			$link 		= JRoute::_( 'index.php?option=com_efemerides');	
		 ?>
			<a class="efemeridesGlobalLink" href="<?php echo $link; ?>"><?php echo $textGlobalLink ?></a>
		<?php
		    }
	}
?>
</div>
