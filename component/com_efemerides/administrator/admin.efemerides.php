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

$mainframe->addCustomHeadTag ('<link rel="stylesheet" href="'.$this->baseurl.'components/com_efemerides/css/icon.css" type="text/css" media="screen" />');
$mainframe->addCustomHeadTag ('<link rel="stylesheet" href="'.$this->baseurl.'components/com_efemerides/css/style.css" type="text/css" media="screen" />');

// Create the controller
$classname    = 'AdminEfemeridesController'.$controller;
$controller   = new $classname( );

// Perform the Request task
$controller->execute( JRequest::getVar( 'task' ) );

// Redirect if set by the controller
$controller->redirect();

?>
