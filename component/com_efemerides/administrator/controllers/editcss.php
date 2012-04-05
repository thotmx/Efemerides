<?php
/**
 * Backup Controller for Efemerides Component
 * 
 * @package    Efemerides
 * @subpackage Components
 * @link http://revolucionemosoaxaca.org
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();



/**
 * Efemerides Efemerides Controller
 *
 * @package    Efemerides
 * @subpackage Components
 */
class AdminEfemeridesControllerEditCSS extends JController
{
    
	function display()
	{
		global $mainframe;
		$document =& JFactory::getDocument();
		$viewName = JRequest::getVar('task','editcss');
		$viewType = $document->getType();
		$view =& $this->getView($viewName, $viewType);
	
		$model =& $this->getModel($viewName);
		$model2 =& $this->getModel('AdminEfemerides');
		if (!JError::isError($model))
		{
		  $view->setModel($model,true);
		}
		
		$view->setModel($model,true);
		$view->setModel($model2,false);
		
		$view->setLayout('default');
		$view->display();    
	}
	
	function save()
	{
		$model = $this->getModel('editcss');
	   	if(!$model->putFileContent($message)) {
			$msg = JText::_( 'Error: '.$message );
		} else {
			$msg = JText::_( 'CSS saved sucessfully' );
		}
		$this->setRedirect( 'index.php?option=com_efemerides', $msg );
	}
	
	function cancel()
	{
		$msg = 'Action cancelled';
		$this->setRedirect( 'index.php?option=com_efemerides', $msg );
	}
}
?>
