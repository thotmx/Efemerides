<?php
/**
 * Efemerides table class
 * 
 * @package    Efemerides
 * @subpackage Components
 * @link http://revolucionemosoaxaca.org
 * @license		GNU/GPL
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.database.table');

/**
 * Efemerides Table class
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class TableEfemerides extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;

	/**
	 * @var string
	 */
	var $title = null;
	
	/**
	 * @var date
	 */
	var $historicdate = null;
		
	
	/**
	 * @var string
	 */
	var $description = null;

	/**
	 * @var string
	 */
	var $published = null;

	/**
	 * @var string
	 */
	var $alias = null;

	/**
	 * @var string
	 */
	var $ordering = null;

	/**
	 * @var string
	 */
	var $access = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableEfemerides(& $db) {
		parent::__construct('#__efemerides', 'id', $db);
	}
}
?>
