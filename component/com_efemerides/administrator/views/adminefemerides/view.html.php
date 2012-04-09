<?php
/**
 * Efemerides View for Efemerides Component
 * 
 * @package    Efemerides
 * @subpackage Components
 * @link http://revolucionemosoaxaca.org
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

/**
 * Efemerides View
 *
 * @package    Efemerides
 * @subpackage Components
 */
class AdminEfemeridesViewAdminEfemerides extends JView
{
	/**
	 * Efemerides view display method
	 * @return void
	 **/
	function display($tpl = null)
	{
		#global $mainframe;
		
		JToolBarHelper::title(   JText::_( 'Efemerides Manager' ), 'generic.png' );
		JToolBarHelper::addNewX();
		JToolBarHelper::editListX();
		JToolBarHelper::deleteList();
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		JToolBarHelper::divider();
		JToolBarHelper::custom('editCss', 'css.png', 'css_f2.png', 'Edit CSS', false, false);
		JToolBarHelper::divider();
		JToolBarHelper::custom( 'backupcontroller', 'efemeridesbackups','efemeridesbackups','Restore backups',false,false);
		JToolBarHelper::custom( 'backup', 'export', 'export', 'Make Backup', false, false );
		JToolBarHelper::divider();
		JToolBarHelper::preferences('com_efemerides');

		// get request vars for filter state and search
	#	$filter_state		= $mainframe->getUserStateFromRequest( $this->_context.'.filter_state',	'filter_state',	'',	'word' );
	#	$filter_datesort	= $mainframe->getUserStateFromRequest( $this->_context.'.filter_datesort', 'filter_datesort', '', 'word' );
		#$search				= $mainframe->getUserStateFromRequest($option.$name.'.search', 'search', '', 'string');
		#$search				= JString::strtolower($search);
	
		// search filter
		#$lists['search']	= $search;
		// state filter
		#$lists['state']		= JHTML::_('grid.state', $filter_state );

		// state date order
		$datesort[] = JHTML::_('select.option',  '', '- ' .JText::_( 'Date sort (Default YYYY-MM-DD)' ). ' -' );
		$datesort[] = JHTML::_('select.option',  'DMY', JText::_( 'Sort:') . ' ' .JText::_( 'DAY' ).   ' - ' . JText::_( 'MONTH' ). ' - ' .JText::_ ( 'YEAR' )  );
		$datesort[] = JHTML::_('select.option',  'DYM', JText::_( 'Sort:') . ' ' .JText::_( 'DAY' ).   ' - ' . JText::_( 'YEAR' ).  ' - ' .JText::_ ( 'MONTH' ) );
		$datesort[] = JHTML::_('select.option',  'MYD', JText::_( 'Sort:') . ' ' .JText::_( 'MONTH' ). ' - ' . JText::_( 'YEAR' ).  ' - ' .JText::_( 'DAY' )    );
		$datesort[] = JHTML::_('select.option',  'MDY', JText::_( 'Sort:') . ' ' .JText::_( 'MONTH' ). ' - ' . JText::_( 'DAY' ).   ' - ' .JText::_( 'YEAR' )   );
	#	$lists['datesort']	= JHTML::_('select.genericlist',   $datesort, 'filter_datesort', 'class="inputbox" size="1" onchange="submitform();" title="'.JText::_('Only active if sort on HISTORICDATE').'"', 'value', 'text', $filter_datesort );

		// Get data from the model
		$items				= $this->get('Items');
#		$state 				=& $this->get('state');

		#$lists['order_Dir'] = JRequest::getVar('filter_order_Dir');
		#$lists['order'] 	= JRequest::getVar('filter_order');
		//print_r($lists);
		$pagination 		= $this->get('Pagination');
    $state = $this->get('State');

		//Assign Vars to Template
		$this->assignRef('lists',		$lists);
		$this->assignRef('items',		$items);
		$this->assignRef('pagination',	$pagination);
		$this->assignRef('state',	$state);

		parent::display($tpl);
	}
}
?>
