<?php
/**
 * @package    Efemerides
 * @subpackage Components
 * @link http://revolucionemosoaxaca.org
 * @license    GNU/GPL
 */

// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

define('JPATH_EFEMERIDES_BACKUPS',JPATH_ROOT.DS."efemeridesbackups");
// Require the base controller

require_once( JPATH_COMPONENT.DS.'controller.php' );

// Require specific controller if requested
if($controller = JRequest::getWord('controller')) {
	$path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
	if (file_exists($path)) {
		require_once $path;
	} else {
		$controller = '';
	}
}

$doc =& JFactory::getDocument();
$href = JURI::base(true).'/components/com_efemerides/css/icon.css';
$attribs = array('type' => 'text/css', 'media' => 'screen'); 
$doc->addHeadLink($href,'stylesheet','rel',$attribs);
$href = JURI::base(true).'/components/com_efemerides/css/style.css';
$doc->addHeadLink($href,'stylesheet','rel',$attribs);

// Create the controller
$classname    = 'AdminEfemeridesController'.$controller;
$controller   = new $classname( );

// Perform the Request task
$controller->execute( JRequest::getVar( 'task' ) );

// Redirect if set by the controller
$controller->redirect();

?>
