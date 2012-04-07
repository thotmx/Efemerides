<?php
/**
 * Efemerides View for Efemerides Component
 * 
 * @package    Efemerides
 * @subpackage Components
 * @link http://revolucionemosoaxaca.org
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

/**
 * Efemerides View
 *
 * @package    Efemerides
 * @subpackage Components
 */
class AdminEfemeridesViewEfemerides extends JView
{
	/**
	 * display method of Efemerides view
	 * @return void
	 **/
	function display($tpl = null)
	{
		//get the hello
		$efemerides		=& $this->get('Data');
		$isNew		= ($efemerides->id < 1);

		$text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
		JToolBarHelper::title(   JText::_( 'Efemerides' ).': <small><small>[ ' . $text.' ]</small></small>' );
		//JToolBarHelper::save();
		if ($isNew)  {
			JToolBarHelper::cancel();
		} else {
			// for existing items the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		}

		$this->assignRef('efemerides',	$efemerides);

		parent::display($tpl);
	}
}

?>
