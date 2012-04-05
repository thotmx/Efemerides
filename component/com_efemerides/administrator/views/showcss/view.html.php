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
class AdminEfemeridesViewShowCSS extends JView
{
	/**
	 * display method of Efemerides view
	 * @return void
	 **/
	
	 
	function display($tpl = null)
	{
		//get the hello
		JToolBarHelper::title(   JText::_( 'Edit CSS' ), 'default' );
		JToolBarHelper::back();
		JToolBarHelper::custom( 'editcss', 'edit.png','edit_f2.png','Editar',true);
		
		// Add Files of CSS
		$modulecss['fullpath'] = JPATH_ROOT.DS.'modules'.DS.'mod_efemerides'.DS.'css'.DS.'efemerides.css';
		$modulecss['filename'] = 'Module';
		$modulecss['writeable'] = is_writeable($modulecss['fullpath']);
		
		$componentcss['fullpath'] = JPATH_ROOT.DS.'components'.DS.'com_efemerides'.DS.'css'.DS.'efemerides.css';
		$componentcss['filename'] = 'Component';
		$componentcss['writeable'] = file_exists($componentcss['fullpath'])&&is_writeable($componentcss['fullpath']);
		
		$files[] = $modulecss;
		$files[] = $componentcss;
		
		$this->assignRef('files',$files);
		
		parent::display($tpl);
	}
	
	
}

?>
