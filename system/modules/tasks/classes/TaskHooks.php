<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package Tasks
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace Tasks;

/**
 * Class TaskHooks
 *
 * Provide hook implementation for task center
 * @copyright  Cliff Parnitzky 2013
 * @author     Cliff Parnitzky
 * @package    Tasks
 */
class TaskHooks extends \Backend
{
	/**
	 * Initialize the object
	 */
	protected function __construct()
	{
		parent::__construct();
	}

	/**
	 * Modify the status options
	 */
	public function checkStatusOptions($arrOptions, $taskId)
	{
		if (\Input::get('act') == 'edit')
		{
			if ($status = TaskModel::getCurrentStatusForTask($taskId))
			{
				if ($status != 'created')
				{
					unset($arrOptions['created']);
				}
			}
		}
		return $arrOptions;
	}

	/**
	 * Modify the progress options
	 */
	public function checkProgressOptions($arrOptions, $taskId)
	{
		if (\Input::get('act') == 'edit')
		{
			foreach($arrOptions as $k=>$v)
			{
				// nothing to do at the moment
			}
		}
		return $arrOptions;
	}

	/**
	 * Modify the tasktype options
	 */
	public function checkTasktypeOptions($arrOptions, $taskId)
	{
		if (\Input::get('act') == 'edit')
		{
			foreach($arrOptions as $k=>$v)
			{
				// nothing to do at the moment
			}
		}
		return $arrOptions;
	}

	/**
	 * Modify the priority options
	 */
	public function checkPriorityOptions($arrOptions, $taskId)
	{
		if (\Input::get('act') == 'edit')
		{
			foreach($arrOptions as $k=>$v)
			{
				// nothing to do at the moment
			}
		}
		return $arrOptions;
	}

	/**
	 * Modify each task table row
	 */
	public function formatTaskTableRow($arrValues, $row)
	{
		// column 'title'
		$columnIndex = TaskValueFormatter::getTaskTableFieldIndex('tasktitle');
		if ($columnIndex !== FALSE)
		{
			$arrValues[$columnIndex] = '<strong>'.$arrValues[$columnIndex].'</strong>';
		}
		
		// column 'createdAt'
		$columnIndex = TaskValueFormatter::getTaskTableFieldIndex('createdAt');
		if ($columnIndex !== FALSE)
		{
			$strAuthor = \UserModel::findOneById($row['createdBy'])->name;
			$arrValues[$columnIndex] = sprintf($GLOBALS['TL_LANG']['TaskCenter']['created'], $arrValues[$columnIndex], $strAuthor);
		}
		
		// column 'tasktype'
		$columnIndex = TaskValueFormatter::getTaskTableFieldIndex('tasktype');
		if ($columnIndex !== FALSE)
		{
			$arrValues[$columnIndex] = TaskValueFormatter::getTasktypeFormated($row['tasktype'], true);
		}
		
		// column 'priority'
		$columnIndex = TaskValueFormatter::getTaskTableFieldIndex('priority');
		if ($columnIndex !== FALSE)
		{
			$arrValues[$columnIndex] = TaskValueFormatter::getPriorityFormated($row['priority'], true);
		}
		
		// column 'status'
		$columnIndex = TaskValueFormatter::getTaskTableFieldIndex('status');
		if ($columnIndex !== FALSE)
		{
			$arrValues[$columnIndex] = TaskValueFormatter::getStatusFormated($row['status'], true);
		}
		
		// column 'progress'
		$columnIndex = TaskValueFormatter::getTaskTableFieldIndex('progress');
		if ($columnIndex !== FALSE)
		{
			$arrValues[$columnIndex] = TaskValueFormatter::getProgressFormated($row['progress'], true);
		}
		
		// column 'assignedTo'
		$columnIndex = TaskValueFormatter::getTaskTableFieldIndex('assignedTo');
		if ($columnIndex !== FALSE)
		{
			$user = \UserModel::findOneById($row['assignedTo']);
			$arrValues[$columnIndex] = TaskValueFormatter::getAssignedUserFormated($user);
		}
		return $arrValues;
	}
	
	/**
	 * Modify each task table row if the deadline is exceeded
	 */
	public function formatTaskTableRowDeadlineExceeded($arrValues, $row)
	{
		if ($row['deadline'] < time())
		{
			foreach ($GLOBALS['TL_DCA']['tl_task']['list']['label']['fields'] as $field)
			{
				$columnIndex = TaskValueFormatter::getTaskTableFieldIndex($field);
				if ($columnIndex !== FALSE)
				{
					$arrValues[$columnIndex] = '<div class="deadline_exceeded">' . $arrValues[$columnIndex] . '</div>';
				}
			}
		}
		return $arrValues;
	}
	
	/**
	 * Modify the task status table rows ... removes all values which have no value.
	 */
	public function cleanTaskStatusTableRows($tableRows)
	{
		foreach($tableRows as $key=>$tableRow)
		{
			if (strlen($tableRow['value']) == 0)
			{
				unset($tableRows[$key]);
			}
		}
		unset($tableRows['createdAt']);
		unset($tableRows['createdBy']);
		
		return $tableRows;
	}

	/**
	 * Modify the task status table rows ... formats some values. 
	 */
	public function formatTaskStatusTableRows($tableRows)
	{
		if (array_key_exists('status', $tableRows))
		{
			$tableRows['status']['valueFormatted'] = TaskValueFormatter::getStatusFormated($tableRows['status']['value']);
		}
		if (array_key_exists('progress', $tableRows))
		{
			$tableRows['progress']['valueFormatted'] = TaskValueFormatter::getProgressFormated($tableRows['progress']['value']);
		}
		if (array_key_exists('assignedTo', $tableRows))
		{
			$user = \UserModel::findOneById($tableRows['assignedTo']['value']);
			$tableRows['assignedTo']['valueFormatted'] = TaskValueFormatter::getAssignedUserFormated($user);
		}
		return $tableRows;
	}
	
	/**
	 * Modify the task status header fields ... format the default values.
	 */
	public function formatTaskStatusHeaderFields($arrHeaderFields, $taskId)
	{
		if (array_key_exists($GLOBALS['TL_LANG']['tl_task']['tasktype'][0], $arrHeaderFields))
		{
			$arrHeaderFields[$GLOBALS['TL_LANG']['tl_task']['tasktype'][0]] = TaskValueFormatter::getTasktypeFormatedByLabel($arrHeaderFields[$GLOBALS['TL_LANG']['tl_task']['tasktype'][0]], true, true);
		}
		if (array_key_exists($GLOBALS['TL_LANG']['tl_task']['priority'][0], $arrHeaderFields))
		{
			$arrHeaderFields[$GLOBALS['TL_LANG']['tl_task']['priority'][0]] = TaskValueFormatter::getPriorityFormatedByLabel($arrHeaderFields[$GLOBALS['TL_LANG']['tl_task']['priority'][0]], true, true);
		}
		if (array_key_exists($GLOBALS['TL_LANG']['tl_task']['status'][0], $arrHeaderFields))
		{
			$arrHeaderFields[$GLOBALS['TL_LANG']['tl_task']['status'][0]] = TaskValueFormatter::getStatusFormatedByLabel($arrHeaderFields[$GLOBALS['TL_LANG']['tl_task']['status'][0]], true, true);
		}
		if (array_key_exists($GLOBALS['TL_LANG']['tl_task']['progress'][0], $arrHeaderFields))
		{
			$arrHeaderFields[$GLOBALS['TL_LANG']['tl_task']['progress'][0]] = TaskValueFormatter::getProgressFormatedByLabel($arrHeaderFields[$GLOBALS['TL_LANG']['tl_task']['progress'][0]], true, true);
		}
		if (array_key_exists($GLOBALS['TL_LANG']['tl_task']['assignedTo'][0], $arrHeaderFields))
		{
			if (strlen($arrHeaderFields[$GLOBALS['TL_LANG']['tl_task']['assignedTo'][0]]) == 0 || $arrHeaderFields[$GLOBALS['TL_LANG']['tl_task']['assignedTo'][0]] == '0')
			{
				$arrHeaderFields[$GLOBALS['TL_LANG']['tl_task']['assignedTo'][0]] = $GLOBALS['TL_LANG']['TaskCenter']['notAssigned'];
			}
		}
		
		return $arrHeaderFields;
	}
	
	// TODO remove after testing
	public function assignLoggedUserToBugs ($currentValue, $valueType)
	{
		if ($valueType == 'assignedUser')
		{
			$objTask = TaskModel::getCurrentTaskById(\Input::get('id'));
			if ($objTask != null && $objTask->tasktype == 'bug')
			{
				$currentValue = \BackendUser::getInstance()->id;
			}
			
		}
		return $currentValue;
	}
}

?>