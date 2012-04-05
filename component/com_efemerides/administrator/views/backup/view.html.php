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
class AdminEfemeridesViewBackup extends JView
{
	/**
	 * display method of Efemerides view
	 * @return void
	 **/
	
	 
	function display($tpl = null)
	{
		//get the hello
		JToolBarHelper::title(   JText::_( 'Backup Efemerides' ), 'generic.png' );
		JToolBarHelper::back();
		JToolBarHelper::custom( 'load', 'efemeridesbackups','efemeridesbackups','Restore backup',false,false);
		JToolBarHelper::deleteList();
		
		$model =& $this->getModel();

		$files = $model->obtainFiles();
		
		$this->assignRef('files',$files);
		
		parent::display($tpl);
	}
	
	
}

?>
