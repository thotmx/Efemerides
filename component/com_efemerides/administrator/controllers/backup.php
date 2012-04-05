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
class AdminEfemeridesControllerBackup extends JController
{

	function display()
	{
		global $mainframe;
		$document =& JFactory::getDocument();
		$viewName = JRequest::getVar('task','backup');
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
	
	function load()
	{
	     	$model = $this->getModel('backup');
	   	if(!$model->load($message)) {
			$msg = JText::_( 'Error: '.$message );
		} else {
			$msg = JText::_( 'Data Loaded sucessfully' );
		}

		$this->setRedirect( 'index.php?option=com_efemerides&controller=backup', $msg );
	}
	
	function remove()
	{
		$model = $this->getModel('backup');
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or More Backups Files Could not be Deleted' );
		} else {
			$msg = JText::_( 'Backup(s) File(s) Deleted' );
		}

		$this->setRedirect( 'index.php?option=com_efemerides&controller=backup', $msg );
	}

	function download()
	{
	  $model = $this->getModel('backup');
	  if(!$model->download($message)) {
	    $msg = JText::_( 'Error:').$message; 
    	    $this->setRedirect( 'index.php?option=com_efemerides&controller=backup', $msg );
	  }
	}
	
	function upload()
	{
	   $model = $this->getModel('backup');
	   if(!$model->upload($message)) {
			$msg = JText::_( 'Error: '.$message );
		} else {
			$msg = JText::_( 'File upload Successfully. Now you can restore the file' );
		}
	   $this->setRedirect( 'index.php?option=com_efemerides&controller=backup', $msg );
	}

}
?>
