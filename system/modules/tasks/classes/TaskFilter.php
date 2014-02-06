<?php

/**
 * Contao Open Source CMS
 *
 * @copyright  Leo Feyer 2005-2012
 * @copyright  Cliff Parnitzky 2013
 * @package    Tasks
 * @license    LGPL
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Tasks;

/**
 * Class TaskFilter
 *
 * Provide methods use special filter
 * @copyright  Cliff Parnitzky 2013
 * @author     Cliff Parnitzky
 * @package    Tasks
 */
class TaskFilter extends \Backend
{
	const SPECIAL_FILTER_PARAM_NAME = 'specialfilter';
	
	/**
	 * Returns the drop down for the special filter
	 */
	public static function getSpecialFilterDropDown($url, $label, $class)
	{
		$posFilterParam = strpos($url, self::SPECIAL_FILTER_PARAM_NAME);
		if ($posFilterParam !== FALSE)
		{
			// remove the old param from url
			$posNextParam = strpos($url, '&', $posFilterParam);
			if ($posNextParam === FALSE)
			{
				$posNextParam = strlen($url);
			}
			$url = substr_replace($url, '', $posFilterParam, $posNextParam);
		}
		
		$actFilter = \Input::get(self::SPECIAL_FILTER_PARAM_NAME);
		
		$returnString  = '<strong class=' . $class . '>' . $label . '</strong>';
		$returnString .= '<select onchange="location.href = \'' . $url . '&amp;' . self::SPECIAL_FILTER_PARAM_NAME . '=\' + this.options[this.options.selectedIndex].value + \'\';" style="width: 100px;">';
		$returnString .= '<option value="">---</option>';
		foreach ($GLOBALS['TL_TASK_SPECIALFILTER'] as $filter=>$definition)
		{
			$returnString .= '<option value="' . $filter . '"' . ($actFilter == $filter ? ' selected=""selected' : '') . '>' . $GLOBALS['TL_LANG']['TaskCenter']['specialfilter'][$filter] . '</option>';
		}
		$returnString .= '</select>';

		return $returnString;
	}
	
	/**
	 * Returns all filter definitions (will be connecte with AND)
	 */
	public static function getAllFilterDefinitions()
	{
		$objTaskFilter = new TaskFilter();
		return $objTaskFilter->getFilterDefinitions();
	}
	/**
	 * Returns the filter definitions (will be connecte with AND)
	 */
	private function getFilterDefinitions()
	{
		$this->import('BackendUser', 'User'); 
		
		$filterDefinitions = array();
		
		// TODO add system filters (e.g. for user, group, ...)
		if (!$this->User->isAdmin)
		{
			$filterDefinitions[] = array('(createdBy = ' . $this->User->id . ' OR assignedTo = ' . $this->User->id . ')', 0);
		}
		
		// TODO add HOOK 
		
		// adding special filter definitions
		$arrSpecialFilterDefinition = $this->getSpecialFilterDefinition();
		if (is_array($arrSpecialFilterDefinition))
		{
			$filterDefinitions[] = $arrSpecialFilterDefinition;
		}
		
		return $filterDefinitions;
	}

	/**
	 * Returns the filter definitions
	 */
	private function getSpecialFilterDefinition()
	{
		return $GLOBALS['TL_TASK_SPECIALFILTER'][\Input::get(self::SPECIAL_FILTER_PARAM_NAME)];
	}
}

?>