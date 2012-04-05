<?php
/**
 * AdminEfemerides Model for Efemerides Component
 * 
 * @package    Efemerides
 * @subpackage Components
 * @link http://revolucionemosoaxaca.org
 * @license        GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

/**
 * AdminEfemerides Model
 *
 * @package    Efemerides
 * @subpackage Components
 */
class AdminEfemeridesModelAdminEfemerides extends JModel
{
    /**
     * AdminEfemerides data array
     *
     * @var array
     */
     var $_total = null;
     var $_pagination = null;


    var $_data;

	function __construct()
	{
		parent::__construct();

		global $mainframe, $option;
 
		// Get pagination request variables
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
		$limitstart = JRequest::getVar('limitstart', 0, '', 'int');
 
		// In case limit has been changed, adjust it
		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
 
		// Get Filter
		$filter_state		= $mainframe->getUserStateFromRequest($option.$this->getName().'.filter_state', 'filter_state', '', 'cmd');
		$filter_datesort	= $mainframe->getUserStateFromRequest($option.$this->getName().'.filter_datesort', 'filter_datesort', '', 'cmd');
        // get search request variable
		$search				= $mainframe->getUserStateFromRequest($option.$this->getName().'.search', 'search', '', 'string');
		// convert search to lower case
		$search				= JString::strtolower($search);
        
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitstart);
		$this->setState('search', $search);
		$this->setState('filter_state', $filter_state);
		$this->setState('filter_datesort', $filter_datesort);	
	}

	function getTotal()
	{
        // Load the content if it doesn't already exist
        if (empty($this->_total)) {
            $query = $this->_buildQuery();
            $this->_total = $this->_getListCount($query);    
        }
        return $this->_total;
	}


    /**
     * Returns the query
     * @return string The query to be used to retrieve the rows from the database
     */
    function _buildQuery()
    {
      //	$order = ' ORDER BY MONTH(historicdate),DAY(historicdate)';

    	$where = $this->_buildContentWhere();
		$order = $this->_buildContentOrderBy();
		
        $query = ' SELECT * '
			   . ' FROM #__efemerides '
			   . $where
			   . $order
        ;
        return $query;
    }

	/**
     * Returns the WHERE statement created by the filters
     * @return string  
     */
	function _buildContentWhere() {
		global $mainframe, $option;

		$db			=& JFactory::getDBO();
		$search		= $this->getState('search');
		$state 		= $this->getState('filter_state');
		$where  = array();
		
		// search filter
		if ($search) {
			$where[] = 'LOWER(title) LIKE '.$db->Quote('%'.$db->getEscaped($search, true).'%', false);
		}
		
		// state filter
		if ( $state ) {
			if ( $state == 'P' ) {
				$where[] = 'published = 1';
			} else if ($state == 'U' ) {
				$where[] = 'published = 0';
			}
		}
		
		$where = (count($where) ? ' WHERE '. implode(' AND ', $where) : '');

		return $where;
	}
	
	
	function _buildContentOrderBy()
	{
		global $mainframe, $option;
 
		$filter_order     = $mainframe->getUserStateFromRequest( $option.'filter_order', 'filter_order', 'id', 'cmd' );
		$filter_order_Dir = $mainframe->getUserStateFromRequest( $option.'filter_order_Dir', 'filter_order_Dir', 'asc', 'word' );
		$datesort		  = $this->getState('filter_datesort');

		$orderby = '';
		if ($filter_order || $filter_order_Dir)
		{
			if( $filter_order == 'historicdate' && $datesort != '') {
				if ($datesort == 'DMY') {
					$orderby = ' ORDER BY DAYOFMONTH(historicdate) '.$filter_order_Dir.', MONTH(historicdate)'.$filter_order_Dir.', YEAR(historicdate) '.$filter_order_Dir;
				} else if ($datesort == 'DYM') {
					$orderby = ' ORDER BY DAYOFMONTH(historicdate) '.$filter_order_Dir.', YEAR(historicdate)'.$filter_order_Dir.', MONTH(historicdate) '.$filter_order_Dir;
				} else if ($datesort == 'MYD') {
					$orderby = ' ORDER BY MONTH(historicdate) '.$filter_order_Dir.', YEAR(historicdate) '.$filter_order_Dir.', DAYOFMONTH(historicdate) '.$filter_order_Dir;
				} else if ($datesort == 'MDY') {
					$orderby = ' ORDER BY MONTH(historicdate) '.$filter_order_Dir.', DAYOFMONTH(historicdate) '.$filter_order_Dir.', YEAR(historicdate) '.$filter_order_Dir;
				}
			} else {
				$orderby = ' ORDER BY '.$filter_order.' '.$filter_order_Dir;
			}
			
		}

		return $orderby;
	}

	function getPagination()
	{
        // Load the content if it doesn't already exist
        if (empty($this->_pagination)) {
            jimport('joomla.html.pagination');
            $this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );
        }
        return $this->_pagination;
	}


    /**
     * Retrieves the Efemerides data
     * @return array Array of objects containing the data from the database
     */
    function getData()
    {
        // Lets load the data if it doesn't already exist
        if (empty( $this->_data ))
        {
            $query = $this->_buildQuery();
            $this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
	    // $this->_data = $this->_getList( $query );
        }

        return $this->_data;
    }
}
?>
