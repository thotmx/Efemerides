<?php
/**
 * @package    Efemerides
 * @subpackage Components
 * components/com_efemerides/efemerides.php
 * @link http://revolucionemosoaxaca.org
 * @license    GNU/GPL
*/
// no direct access
defined('_JEXEC') or die( 'Restricted access' );

jimport ('joomla.application.component.controller');
/*
// Require the base controller
//require_once( JPATH_COMPONENT.DS.'controller.php' );

// Require specific controller if requested
//if($controller = JRequest::getWord('controller')) {
//    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
//    if (file_exists($path)) {
//        require_once $path;
//    } else {
//        $controller = '';
//    }
//}
*/
// Create the controller
//$classname    = 'EfemeridesController'.$controller;
//$controller   = new $classname( );
$controller = JController::getInstance('Efemerides');
// Perform the Request task
echo get_class($controller);
echo "Cargado el controlador<br />";
$controller->execute(JRequest::getCmd('task'));
echo "Paso el request<br />";
// Redirect if set by the controller
$controller->redirect();
echo "Paso la redireccion<br />";
