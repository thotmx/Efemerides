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
class AdminEfemeridesModelEfemerides extends JModel
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
	
	function getBackupFileName($backupname)
	{
		$filename= JFile::makeSafe($backupname);
		if ($filename=='')
		    $filename = JFile::makeSafe("efemeridesbackup-".date("YmdGis").".xml");
		if (preg_match('/[\w\d\-\.]+.xml\b/i',$filename)==0)
		{
			$filename.=".xml";
		}
		return $filename;
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
	
	/**
	 * Constructor that retrieves the ID from the request
	 *
	 * @access	public
	 * @return	void
	 */
	function __construct()
	{
		jimport('joomla.filesystem.file');
		parent::__construct();

		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
	}

	/**
	 * Method to set the Efemerides identifier
	 *
	 * @access	public
	 * @param	int Efemerides identifier
	 * @return	void
	 */
	function setId($id)
	{
		// Set id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}


	/**
	 * Method to get a hello
	 * @return object with data
	 */
	function &getData()
	{
		// Load the data
		if (empty( $this->_data )) {
			$query = ' SELECT * FROM #__efemerides '.
					'  WHERE id = '.$this->_id;
			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObject();
		}
		if (!$this->_data) {
			$this->_data = new stdClass();
			$this->_data->id = 0;
			$this->_data->historicdate = '0000-00-00';
			$this->_data->description = '';
		}
		return $this->_data;
	}

	/**
	 * Method to store a record
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function store($data)
	{
		$row =& $this->getTable();

  	   // Bind the form fields to the hello table
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Make sure the hello record is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		
		// Store the web link table to the database
		if (!$row->store()) {
			$this->setError( $row->getErrorMsg() );
			return false;
		}

		return true;
	}

	/**
	 * Method to delete record(s)
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function delete()
	{
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );

		$row =& $this->getTable();

		if (count( $cids ))
		{
			foreach($cids as $cid) {
				if (!$row->delete( $cid )) {
					$this->setError( $row->getErrorMsg() );
					return false;
				}
			}						
		}
		return true;
	}

	function publish($task,&$message)
	{
	  $cids    = JRequest::getVar( 'cid', array(), '', 'array' );
	  $publish  = ( $task == 'publish' ? 1 : 0 );
	  $row =& $this->getTable();
       	  if (count( $cids ) < 1) {
	    $action = $publish ? 'publish' : 'unpublish';
	    JError::raiseError(500, JText::_( 'Select an item to' .$action, true ) );
	    return false;
	  }
	  if (count( $cids ))
	    {
		foreach($cids as $cid) {
		 if ($cid == 0)
			{
				  $message =  JText::_('No data selected');
				  return false;
			}
		 $row->load($cid);	
	  	 $row->published = $publish;
		 // Make sure the hello record is valid
		 if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		 }
		
		 // Store the web link table to the database
		 if (!$row->store()) {
			$this->setError( $row->getErrorMsg() );
			return false;
		 }		 
	        }						
	   }
	  return true;
	}
	

	function backup(&$message)
	{
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$backupname = JRequest::getVar('backupname','', 'post', 'string');
		$row =& $this->getTable();

		$doc = new DomDocument('1.0');
		$efemeridesbackup = $doc->createElement('efemeridesbackup');
		$efemeridesbackup = $doc->appendChild($efemeridesbackup);
		
		if (count( $cids ))
		{
			foreach($cids as $cid) {
				if ($cid == 0)
				{
				  $message =  JText::_('No data selected');
				  return false;
				}
				$occ = $doc->createElement('efemerides');
				$occ = $efemeridesbackup->appendChild($occ);

				$row->load($cid);				
				foreach ($row as $fieldname => $fieldvalue) 
				{
					$fields = $this->fieldsValues();
					if (in_array($fieldname,$fields))
					{
						echo $fieldname."\n";
						$child = $doc->createElement($fieldname);
						$child = $occ->appendChild($child);
						if ($fieldname=='description')
						  $value = $doc->createCdataSection($fieldvalue);
					  	else
					  	  $value = $doc->createTextNode($fieldvalue);
						$value = $child->appendChild($value);
					}
				}

			}						
		}
		
		if ($this->verifyPath())
		{
		  $filename = $this->getBackupFilename($backupname);
		  if (JFile::exists(JPATH_EFEMERIDES_BACKUPS."/".$filename))
		  {
		    $message = JText::_('There is a Backup File with the same name');
		  	  return false;
		  }
		  if (!$doc->save(JPATH_EFEMERIDES_BACKUPS."/".$filename))
		  {
		    $message = JText::_('Can\'t create the backup file:').$filename;
		  	  return false;
		  }
		  $message = $filename;
		  return true;
		}else
		{
		  $message = JText::_('Can\'t create backups folder');
		  return false;
		}
		//$this->setError( $cadena );
		
	}
	
}
?>
