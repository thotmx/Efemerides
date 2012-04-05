<?php
/**
 * Efemerides! Module Entry Point
 * 
 * @package    Efemerides
 * @subpackage Modules
 * @link http://revolucionemosoaxaca.org
 * @license        GNU/GPL, see LICENSE.php
 * mod_efemerides is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Include the syndicate functions only once
require_once( dirname(__FILE__).DS.'helper.php' );
jimport('joomla.filesystem.file');

$document =& JFactory::getDocument();

function utilFunctionToSort($a, $b)
{
	if ($a->themonth < $b->themonth)
		return -1;
	if ($a->themonth > $b->themonth)
		return +1;
	if ($a->theday < $b->theday) return -1;
	if ($a->theday > $b->theday) return +1;
	return 0;
}

$efemerides = modEfemeridesHelper::getEfemerides( $params );
$texttoshow = $params->get('text_show');
$formatted = $params->get('formatted_date');
$useCss = $params->get('use_css');
$isGlobalLink = $params->get('islink');
$textGlobalLink = $params->get('text_link');
$isIndividualLink = $params->get('ilinks');
$textIndividualLink = $params->get('text_ilinks');

if ($useCss)
{ 
  $fullpath = dirname(__FILE__).DS.'css'.DS.'efemerides.css';
  if (!JFile::exists( $fullpath )) {
	       $this->setError( $row->getErrorMsg() );
	       $message = JText::_('Can\'t load css');	       
	  }
	  else {
	  	  $path = JURI::base( true ).'/modules/mod_efemerides/css/efemerides.css';
	  	  $document->addStyleSheet($path);
  	  } 
}

require( JModuleHelper::getLayoutPath( 'mod_efemerides' ) );

?>
