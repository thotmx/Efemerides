<?php
/**
 * Efemerides Model for Efemerides Component
 * 
 * @package    Efemerides
 * @subpackage Components
 * @link http://revolucionemosoaxaca.org
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );
jimport('joomla.filesystem.file');

/**
 * Efemerides Model
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class AdminEfemeridesModelEditCSS extends JModel
{
	
	function getFileContent(&$message)
	{
	    $array = JRequest::getVar('cid',  0, '', 'array');
	    //print_r ($array);
	    $fullpath = $array[0];
	  
	  
	  if (!JFile::exists( $fullpath )) {
	       //$this->setError( $row->getErrorMsg() );
	       $message = JText::_('Can\'t load file(s)');
	      return null;
	  }
	  $data = JFile::read($fullpath);  
	  return $data;		
	}
 
  function getFileName(&$message)
  {
  	   $array = JRequest::getVar('cid',  0, '', 'array');
	   //print_r ($array);
	   $fullpath = $array[0];
	  
	  if (!JFile::exists( $fullpath )) {
	       //$this->setError( $row->getErrorMsg() );
	       $message = JText::_('Can\'t load file(s)');
	      return null;
	  }
	  return $fullpath;		
  }
  
  function putFileContent(&$message)
	{
	    $filecontent = JRequest::getVar('filecontent');
	    $fullpath = JRequest::getVar('filename');
	    //print_r ($array);
	    	  
	  
	  if (!JFile::exists( $fullpath )) {
	       $this->setError( $row->getErrorMsg() );
	       $message = JText::_('Can\'t load file(s)');
	      return null;
	  }
	  
	  if (!JFile::write($fullpath,$filecontent))
	  {
	  	$message = "Can't write on the file. Check your permissions";
	  	return false;
	  }
	  return true;	
	}
}
?>
