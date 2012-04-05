<?php
/**
 * Efemerides Controller for Efemerides Component
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
class AdminEfemeridesControllerEfemerides extends AdminEfemeridesController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();

		// Register Extra tasks
		$this->registerTask( 'add'  , 	'edit' );
		$this->registerTask('unpublish', 'publish');
	}

	/**
	 * display the edit form
	 * @return void
	 */
	function edit()
	{
		JRequest::setVar( 'view', 'efemerides' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}

	function editcss()
	{
		JRequest::setVar( 'view', 'showcss');		
		parent::display();
	}
	
	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */

	function save()
	{
        // Check for request forgeries
        JRequest::checkToken() or jexit( 'Invalid Token' );

		$model = $this->getModel('efemerides');

        //get data from request
        $post = JRequest::get('post');
        $post['description'] = JRequest::getVar('description', '', 'post', 'string', JREQUEST_ALLOWRAW);

		if ($model->store($post)) {
			$msg = JText::_( 'Efemerides Saved!' );
		} else {
			$msg = JText::_( 'Error Saving Efemerides' );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_efemerides';
		$this->setRedirect($link, $msg);
	}

	/**
	 * remove record(s)
	 * @return void
	 */
	function remove()
	{
		$model = $this->getModel('efemerides');
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or More Efemerides Could not be Deleted' );
		} else {
			$msg = JText::_( 'Efemerides Deleted' );
		}

		$this->setRedirect( 'index.php?option=com_efemerides', $msg );
	}
	
	function backup()
	{
		$model = $this->getModel('efemerides');
		$valid =$model->backup($message); 
		if(!$valid) {
			$msg = JText::_( 'Error: ').$message;
			$typemsg = 'error';
			$this->setRedirect( 'index.php?option=com_efemerides', $msg, $typemsg);
		} else {
			$msg = JText::_( 'Backup successfully, filename: ').$message;
			
			$this->setRedirect( 'index.php?option=com_efemerides', $msg);
		}

					
	}

	function publish() {
	         $model = $this->getModel('efemerides');
		 $task = $this->getTask();
		 if(!$model->publish($task,$message)) {		      
			$msg = JText::_( 'Error: One or More Efemerides could not be (un)published' )." ".$message;
		} else {
			$msg = JText::_( 'Efemerides (un)published correctly' )." ".$message;
		}

		$this->setRedirect( 'index.php?option=com_efemerides', $msg );
	}


	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_efemerides', $msg );
	}
	
	
	function backupcontroller()
	{
	  $this->setRedirect( 'index.php?option=com_efemerides&controller=backup');	
	}
}
?>
