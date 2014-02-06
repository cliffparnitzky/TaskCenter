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

use \Contao\UserModel;

/**
 * Reads and writes tasks
 */
class TaskModel extends \Model
{
	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_task';
	
	public function getCurrentTaskStatus($ignoredTaskStatusId = null)
	{
		$arrParams = array();
		$arrParams[] = $this->id;
		
		$ignoredTaskStatusIdQuery = "";
		
		if ($ignoredTaskStatusId != null)
		{
			$ignoredTaskStatusIdQuery = "AND id != ?";
			$arrParams[] = $ignoredTaskStatusId;
		}
		
		$objResult = \Database::getInstance()->prepare("SELECT * FROM tl_task_status WHERE pid = ? AND tstamp > 0 " . $ignoredTaskStatusIdQuery . " ORDER BY createdAt DESC")
									 ->limit(1)
									 ->execute($arrParams);

		if ($objResult->numRows == 1)
		{
			return $objResult;
		}

		return null;
	}
	
	/* STATIC functions */
	
	public static function getCurrentTaskById($id)
	{
		return static::findByPk($id);
	}

	public static function getCurrentTaskStatusForTask($id)
	{
		if ($taskStatus = static::findOneById($id)->getCurrentTaskStatus())
		{
			return $taskStatus;
		}
		return null;
	}

	public static function getLastActiveTaskStatusForTask($id, $ignoredTaskStatusId)
	{
		if ($taskStatus = static::findOneById($id)->getCurrentTaskStatus($ignoredTaskStatusId))
		{
			return $taskStatus;
		}
		else if ($taskStatus = static::findOneById($id)->getCurrentTaskStatus())
		{
			return $taskStatus;
		}
		return null;
	}

	public static function getCurrentStatusForTask($id)
	{
		if ($taskStatus = static::findOneById($id)->getCurrentTaskStatus())
		{
			return $taskStatus->status;
		}
		return null;
	}

	public static function getCurrentProgressForTask($id)
	{
		if ($taskStatus = static::findOneById($id)->getCurrentTaskStatus())
		{
			return $taskStatus->progress;
		}
		return null;
	}

	public static function getCurrentAssignedUserForTask($id)
	{
		if ($taskStatus = static::findOneById($id)->getCurrentTaskStatus())
		{
			return UserModel::findOneById($taskStatus->assignedTo);
		}
		return null;
	}
	
	public static function getDefaultValue($valueType)
	{
		$value = $GLOBALS['TL_TASK_DEFAULT'][$valueType];
		
		if (isset($GLOBALS['TL_HOOKS']['tasksModifyDefaultValue']) && is_array($GLOBALS['TL_HOOKS']['tasksModifyDefaultValue']))
		{
			foreach ($GLOBALS['TL_HOOKS']['tasksModifyDefaultValue'] as $callback)
			{
				$value = \System::importStatic($callback[0])->$callback[1]($value, $valueType);
			}
		}
		
		return $value;
	}
}