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
class AdminEfemeridesViewEditCSS extends JView
{
	/**
	 * display method of Efemerides view
	 * @return void
	 **/
	
	 
	function display($tpl = null)
	{
		//get the hello
		JToolBarHelper::title(JText::_( 'Edit CSS' ), 'default' );
		JToolBarHelper::save();
		JToolBarHelper::cancel();
		
		$model =& $this->getModel();
		
		$filename = $model->getFileName($message);
		$content = $model->getFileContent($message);
		
		$this->assignRef('filename',$filename);
		$this->assignRef('content',$content);
		parent::display($tpl);
	}
	
	
}

?>
