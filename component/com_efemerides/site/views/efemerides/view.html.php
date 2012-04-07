<?php
/**
* @package    Efemerides
* @subpackage Components
* @link http://revolucionemosoaxaca.org
* @license    GNU/GPL
*/

// no direct access

defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view');
//jimport('joomla.filesystem.file');
/**
* HTML View class for the Efemerides Component
*
* @package    Efemerides
*/
class EfemeridesViewEfemerides extends JView
{	

	function display($tpl = null)
	{
		$params = &JComponentHelper::getParams( 'com_efemerides' );
    $items = $this->get('Items');
    $pagination = $this->get('Pagination');
    // Check for errors.
    if (count($errors = $this->get('Errors'))) 
    {
      JError::raiseError(500, implode('<br />', $errors));
      return false;
    }

    $title = $params->get('optional_title');
    $useCss = $params->get('use_css');
    $document =& JFactory::getDocument();
    if ($useCss)
    { 
      $fullpath = JPATH_COMPONENT.DS.'css'.DS.'efemerides.css';
      if (!JFile::exists( $fullpath )) {
        $this->setError( $row->getErrorMsg() );
        $message = JText::_('Can\'t load css');	       
      }
      else {
        $path = JURI::base( true ).'/components/com_efemerides/css/efemerides.css';
        $document->addStyleSheet($path);
      } 
    } 
    /*	if (strcmp($title,"") == 0){
        $tile = 'Efemerides Today';
        }*/
    //$items =& $this->get('Data');      
    /*  $pagination =& $model->getPagination($params->get('date_range'));

    // push data into the template*/
    $this->assignRef('items', $items);     

    //$this->assignRef('pagination', $pagination);
    $this->assignRef( 'efemerides', $items );
    $this->assignRef( 'formatted', $params->get('formatted_date'));
    $this->assignRef( 'title', $title);
    parent::display($tpl);
  }
}

?>
