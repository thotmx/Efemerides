<?php
/**
 * Efemerides Model for Efemerides Component
 * 
 * @package    Efemerides
 * @subpackage Components
 * @link http://revolucionemosoaxaca.org
 * @license    GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.modelitem' );

/**
 * Efemerides Model
 *
 * @package    Efemerides
 * @subpackage Components
 */
echo "Cargando Modelo<br />";
class EfemeridesModelEfemerides extends JModelItem
{
    /**
    * Gets the greeting
    * @return string The greeting to be displayed to the user
    */
   protected $total = null;
   protected $pagination = null;
   protected $data;

   function __construct()
  {
        parent::__construct();
 
        global $mainframe, $option;
 
        // Get pagination request variables
        //$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');
	//$limit = JRequest::getUInt('limit', $app->getCfg('list_limit',0));
        //$limitstart = JRequest::getUInt('limitstart', 0);
 
        // In case limit has been changed, adjust it
        //$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);
 
        //$this->setState('limit', $limit);
        //$this->setState('limitstart', $limitstart);
  }

  public function getData($date_range) 
  {
        // if data hasn't already been obtained, load it
        if (empty($this->data)) {
            $query = $this->_buildQuery($date_range);
            $this->data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit')); 
	    $this->data = $this->putFormattedDate($this->data);
        }
        return $this->data;
  }


  public function getTotal($date_range)
  {
        // Load the content if it doesn't already exist
        if (empty($this->_total)) {
            $query = $this->_buildQuery($date_range);
            $this->total = $this->_getListCount($query);    
        }
        return $this->total;
  }
	
	function putFormattedDate($list)
	{
		jimport( 'joomla.utilities.date' );
  	        $config =& JFactory::getConfig();
                $offset = $config->getValue('config.offset' );
		foreach ($list as $l)
		{
			$date = new JDate( $l->thedate, $config->getValue('config.offset' ));
			$l->formatteddate = JHTML::_('date', $date->toFormat(), JText::_('DATE_FORMAT_LC'));
			$newlist[] = $l;
		}
		return $newlist;
	}

	function getPagination($date_range)
	  {
        // Load the content if it doesn't already exist
        if (empty($this->pagination)) {
            jimport('joomla.html.pagination');
            $this->pagination = new JPagination($this->getTotal($date_range), $this->getState('limitstart'), $this->getState('limit') );
        }
        return $this->pagination;
	  }


	function _buildQuery($date_range)
    {
	$published = ' published=1';
		$select = 'SELECT DAY(historicdate) as theday,MONTH(historicdate) as themonth, YEAR(historicdate) as theyear, historicdate as thedate,title,description'.' FROM #__efemerides WHERE';
		$order = ' ORDER BY MONTH(historicdate),DAY(historicdate),YEAR(historicdate)';
		$query = ''.$select.$published.$order;
		switch($date_range)
		{
			case 'by_day':
				$query = $select.' DAY(NOW())=DAY(historicdate) '.
				 ' AND MONTH(NOW())=MONTH(historicdate) AND'.$published.$order;
				 break;
			 case 'by_month':
				 $query = $select.' MONTH(NOW())=MONTH(historicdate) AND'.$published.$order;
				 break;
			case 'by_year':
				$query = ''.$select.$published.$order;
				break;
	    }
	    return $query;		
    } 
}
echo "Fin de carga de Modelo<br />";
?>
