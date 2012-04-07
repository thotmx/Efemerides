<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<h1>Salida</h1>
<form id="adminForm" action="<?php echo JRoute::_('index.php');?>" method="post" name="adminForm">
<h1 class="componentheading"><?php echo JText::_($this->title); ?></h1>
<div class="comefemerides-main">
<?php
/*	$n=count($this->efemerides);
	if ($n<=0)
    {	*/
  ?>
  <div class="comefemerides-noefemerides">
  	<h2> <?php // echo JText::_('There is no important events to show'); ?></h2>
  </div>
<?php 
/*    } else {  */
   ?>
<div class="comefemerides-content">
   <div class="comefemerides-head">
     <div class="comefemerides-head-historicdate">
		<p><?php // echo JText::_( 'Historic Date' ); ?></p>
	 </div>
	 <div class="comefemerides-head-title">
		<p><?php //echo JText::_( 'Title' ); ?></p>
	 </div>
	<div class="comefemerides-head-description">
		<p><?php //echo JText::_( 'Description' ); ?></p>
	 </div>
	</div>
	<div class="comefemerides-list">
	<?php		
/*		for ($i=0; $i < $n; $i++)
		{
			$row = &$this->efemerides[$i];
			?>
			<div class="comefemerides-historicdate">
				<p>
	
						<?php
						if ($this->formatted=='1')
						{
						  echo $row->formatteddate; 
						}
						else
						{
						  echo $row->theday."/".$row->themonth."/".$row->theyear;						  
						}							
							?>
				</p>
			</div>
			<div class="comefemerides-separator1"></div>
			<div class="comefemerides-title">
				<p>	<?php echo $row->title; ?> </p>		
			</div>
			<div class="comefemerides-separator2"></div> 
			<div class="comefemerides-description">
			    <p><?php echo $row->description; ?></p>
			</div>				
			<div class="comefemerides-separator"></div>
			<?php
		}*/
    ?>
    
    <?php //echo $this->pagination->getListFooter(); ?>
    
<?php
//	}
	?>
	</div>
<input type="hidden" name="option" value="com_efemerides" />
<input type="hidden" name="task" value="" />

</div>
</div>
</form>


