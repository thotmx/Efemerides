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

/**
 * Efemerides Model
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class AdminEfemeridesModelBackup extends JModel
{
	function verifyPath()
	{
	   if (!JFolder::exists(JPATH_EFEMERIDES_BACKUPS))
	   {
	 	if (!JFolder::create(JPATH_EFEMERIDES_BACKUPS))
		{
		   return false;		
		}
	   }
	   return true;
	}
	
	function getFullPath($name)
	{
		$fullpath= JPATH_EFEMERIDES_BACKUPS.DS.$name;
		return $fullpath;
	}
	
	function fieldsValues()
	{
		$fields = null;
		$fields[] = 'title';
		$fields[] = 'historicdate';
		$fields[] = 'description';
		$fields[] = 'alias';
		$fields[] = 'published';
		$fields[] = 'ordering';
		$fields[] = 'access';
		return $fields;
	}
	
	
	function delete()
	{
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		if (!$this->verifyPath())
		{
		  return false;
		}
		jimport('joomla.filesystem.file');
		if (count( $cids ))
		{
			foreach($cids as $cid) {
				
				if (!JFile::delete( $this->getFullPath($cid) )) {
					$this->setError( $row->getErrorMsg() );
					return false;
				}
			}						
		}
		return true;
	}

	
	function loadFile($file)
	{
	  $xml= new JSimpleXML();
	  $xml->loadFile($file);
	  $row =& $this->getTable('efemerides');
	  foreach ($xml->document->children() as $child)
	    {
	      $tmp=array();
	      $tmp['id']=0;
	      foreach($child->children() as $field)
		{
		  echo $field->name()." ".$field->data();
		  //print_r($field);
		  $tmp[$field->name()] = $field->data();
		}
	      if (!$row->bind($tmp))
	      	return false;
	      if (!$row->check())
		return false;
	      if (!$row->store())
	        return false;
	    }
	  return true;
	}
	
	function load(&$message)
	{
	  jimport('joomla.filesystem.file');
	  
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
				
		if (count( $cids ))
		{
		        //echo "Viene a revisar los archivos...";
			foreach($cids as $cid) {
			        if (!$cid)
				{
				  $message =  JText::_('No file(s) selected');
				  return false;
				}
				
				$fullpath =  $this->getFullPath($cid);
				if (!JFile::exists( $fullpath )) {
					$this->setError( $row->getErrorMsg() );
					$message = JText::_('Can\'t load file(s)');
					return false;
				}
				else
				{
					$this->loadFile($fullpath);
				}
			}						
		}
		  return true;	
		
	}
	
	function download(&$message)
	{
	  jimport('joomla.filesystem.file');
	  $array = JRequest::getVar('cid',  0, '', 'array');
	  $file = $array[0];
	  
	  $fullpath =  $this->getFullPath($file);
	  if (!JFile::exists( $fullpath )) {
	       $this->setError( $row->getErrorMsg() );
	       $message = JText::_('Can\'t load file(s)');
	      return false;
	  }
	  
	  
	  
	  $len = filesize($fullpath);

	ob_clean(); // Clear any previously written headers in the output buffer
        header("Pragma: public");
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: pre-check=0, post-check=0, max-age=0');
        header('Pragma: no-cache');
        header('Expires: 0');
       
        // Use the desired Content-Type
        header("Content-Type: text/xml");

        // Force the download
        header("Content-Disposition: attachment; filename=\"$file\"");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".$len);
        @readfile($fullpath);
        exit;
	}
	
	function upload(&$message)
	{

	  $file = JRequest::getVar('file_upload', null, 'files', 'array');
 
	  //Import filesystem libraries. Perhaps not necessary, but does not hurt
	  jimport('joomla.filesystem.file');
 
	  //Clean up filename to get rid of strange characters like spaces etc
	  $filename = JFile::makeSafe($file['name']);
 
	  //Set up the source and destination of the file
	  $src = $file['tmp_name'];
	  $dest = $this->getFullPath($filename);
	  
	  if (JFile::exists( $dest )) {
	      $message = JText::_('The file already exists. Please delete before upload');
	      return false;
	  }
	  //First check if the file has the right extension, we need jpg only
	  if ( strtolower(JFile::getExt($filename) ) == 'xml') {
	    if ( JFile::upload($src, $dest) ) {
	      return true;
	    } else {
	     $message = JText::_('Upload failed');
	     return false;
	    }
	  } else {
	    $message = JText::_('You can upload only XML files');
	    return false;
	  }
	  return true;
	}


	function obtainFiles()
	{
	   jimport('joomla.filesystem.file');
	   
	   $files = JFolder::files(JPATH_EFEMERIDES_BACKUPS, $filter = '.', false, true);
	   if (!isset($files)||!($files))
	     return $files;
	   foreach ($files as $file)
	   {
	   	 $tmp['fullpath'] = $file;
	   	 $tmp['filename'] = JFile::getName($file);
	   	 $fileslist[]=$tmp;
	   }	   	   
	   return $fileslist;
	}
	
	
}
?>
