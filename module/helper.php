<?php
/**
 * Helper class for Efemerides module
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
class modEfemeridesHelper
{
	function deleteNullElements($array)
	 {
		 foreach($array as $key => $value) {
			 	if($value == "" || $value == " " || is_null($value)) {
					unset($array[$key]);
				}
				else
					$newarray[] = $value;
	     }
	     return $newarray;
	 }

    function getOrderEfemerides($order_by)
	 {
	   $order_by_length = strlen($order_by);

           for ($i = 0; $i < $order_by_length; ++$i)
	     {
	       switch ($order_by[$i])
		 {
		   case 'm':
		     $order_array[] = 'MONTH';
		     break;
		   case 'd':
		     $order_array[] = 'DAY';
		     break;
		   case 'y':
		     $order_array[] = 'YEAR';
		     break;
		 }
	     }
           return ' ORDER BY '.$order_array[0].'(historicdate), '.$order_array[1].'(historicdate), '.$order_array[2].'(historicdate)';
         }

	function getListEfemerides($date_range, $order_by)
	 {
		$db =& JFactory::getDBO();
		$published = ' published=1';
		$select = 'SELECT id,historicdate as thedate, DAY(historicdate) as theday,MONTH(historicdate) as themonth, YEAR(historicdate) as theyear,title,description'.' FROM #__efemerides WHERE';
		$order = modEfemeridesHelper::getOrderEfemerides($order_by);
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
		$db->setQuery($query);
		$db->query();
		$efemerides = $db->loadObjectList();

		return $efemerides;
	 }

	function filterListEfemerides($list, $random, $count)
	 {
		 srand(time());
		 $listsize = count($list);
		 //print("Tamanio lista: ".$listsize);
		 if ($listsize<=$count)
		    return $list;
		 $positions_array = array();
		 if ($random == '1')
		   {
		     $size_array = count($positions_array);
		     while ($size_array!=$count){
		       $pos = (rand() % $listsize);
		       $positions_array[] = $pos;
		       $positions_array = array_unique($positions_array);
		       $size_array = count($positions_array);
		     }
		   }
		 for ($i=0;$i<$count;$i++)
		 {
			 $listsize = count($list);
			 if ($random=='1')
			   $pos = $positions_array[$i];
			 else
			   $pos = $i;
			 $newlist[] = $list[$pos];
			 //print("Entrada:".$pos);
			 //print_r($list[$pos]);
			 //print_r($newlist);
			 //unset($list[$pos]);
			 //$list = modEfemeridesHelper::deleteNullElements($list);

		 }
		 return $newlist;
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


    function getEfemerides( $params )
    {
		//print_r("Cuenta:".$params->get('count'));
      $efemeridesList = modEfemeridesHelper::getListEfemerides($params->get('date_range'), $params->get('order_by'));
		//print_r($efemeridesList)
		if (!empty($efemeridesList))
		{
		  $efemeridesList = modEfemeridesHelper::filterListEfemerides($efemeridesList, $params->get('use_random'),$params->get('count'));
		  $efemeridesList = modEfemeridesHelper::putFormattedDate($efemeridesList);
		  /*if (!empty($efemeridesList))
		  {
			  usort($efemeridesList,"utilFunctionToSort");
			  }*/
		}
		//print_r($efemeridesList);
        return $efemeridesList;
    }
}
?>
